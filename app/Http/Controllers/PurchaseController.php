<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = Purchase::with('supplier')->get();
        return view('purchases.index',compact('purchases'));
    }

    public function create()
    {
        $suppliers = Supplier::select('id', 'name')->get();
        $items = Item::all();
        return view('purchases.create', compact('suppliers', 'items'));
    }

    public function store(Request $request)
    {
        $purchaseData = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'date' => 'required',
            'purchase_no' => 'required',
            'discount' => 'nullable',
            'total_amount' => 'nullable',
        ]);

        $purchaseData['status'] = 1;
        $purchaseData['total_amount'] = str_replace(',', '', $purchaseData['total_amount']);
        $purchase = Purchase::create($purchaseData);

        // Validate purchase details
        $request->validate([
            'item_id' => 'required|array',
            'item_id.*' => 'exists:items,id',
            'quantity' => 'required|array',
            'quantity.*' => 'required|min:1',
            'unit_price' => 'required|array',
            'unit_price.*' => 'required|min:0',
            'total' => 'nullable|array',
            'total.*' => 'nullable',
        ]);

        // Prepare purchase details array
        $purchaseDetails = [];
        foreach ($request->item_id as $key => $item_id) {
            $purchaseDetails[] = [
                'purchase_id' => $purchase->id,
                'item_id' => $item_id,
                'quantity' => $request->quantity[$key],
                'unit_price' => str_replace(',', '', $request->unit_price[$key]),
                'total' => isset($request->total[$key]) ? str_replace(',', '', $request->total[$key]) : null,
            ];
        }

        // Insert purchase details
        PurchaseDetail::insert($purchaseDetails);

        return redirect()->route('purchases.index')
            ->with('success', 'Purchase created successfully');
    }

    public function edit($id)
    {
        $suppliers = Supplier::select('id', 'name')->get();
        $items = Item::all();

        $purchase = Purchase::with('details')->find($id);
        return view('purchases.edit', compact('purchase', 'suppliers', 'items'));
    }

    public function update(Request $request, $id)
    {
        $purchaseData = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'date' => 'required',
            'purchase_no' => 'required',
            'discount' => 'nullable',
            'total_amount' => 'nullable',
        ]);

        $purchaseData['total_amount'] = str_replace(',', '', $purchaseData['total_amount']);

        // Update the purchase
        $purchase = Purchase::findOrFail($id);
        $purchase->update($purchaseData);

        // Validate purchase details
        $request->validate([
            'item_id' => 'required|array',
            'item_id.*' => 'exists:items,id',
            'quantity' => 'required|array',
            'quantity.*' => 'required|min:1',
            'unit_price' => 'required|array',
            'unit_price.*' => 'required|min:0',
            'total' => 'nullable|array',
            'total.*' => 'nullable',
        ]);

        // Prepare purchase details array
        $purchaseDetails = [];
        foreach ($request->item_id as $key => $item_id) {
            $purchaseDetails[] = [
                'purchase_id' => $id,
                'item_id' => $item_id,
                'quantity' => $request->quantity[$key],
                'unit_price' => str_replace(',', '', $request->unit_price[$key]),
                'total' => isset($request->total[$key]) ? str_replace(',', '', $request->total[$key]) : null,
            ];
        }

        // Delete existing purchase details
        $purchase->details()->delete();

        // Insert updated purchase details
        $purchase->details()->createMany($purchaseDetails);

        return redirect()->route('purchases.index')
            ->with('success', 'Purchase updated successfully');
    }


}

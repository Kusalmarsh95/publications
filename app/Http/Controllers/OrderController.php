<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Service;
use App\Models\Worker;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('customer')->get();
        return view('orders.index',compact('orders'));
    }

    public function create()
    {
        $customers = Customer::select('id', 'name')->get();
        $workers = Worker::select('id', 'name')->get();
        $services = Service::all();
        return view('orders.create', compact('customers', 'services', 'workers'));
    }

    public function store(Request $request)
    {
        $orderData = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'date' => 'required',
            'order_no' => 'required',
            'discount' => 'nullable',
            'total_amount' => 'nullable',
        ]);

        $orderData['status'] = 1;
        $orderData['created_by'] = Auth::user()->name;
        $orderData['total_amount'] = str_replace(',', '', $orderData['total_amount']);
        $order = Order::create($orderData);

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

        $orderDetails = [];
        foreach ($request->item_id as $key => $item_id) {
            $orderDetails[] = [
                'order_id' => $order->id,
                'item_id' => $item_id,
                'quantity' => $request->quantity[$key],
                'unit_price' => str_replace(',', '', $request->unit_price[$key]),
                'total' => isset($request->total[$key]) ? str_replace(',', '', $request->total[$key]) : null,
            ];
        }

        OrderDetail::insert($orderDetails);

        return redirect()->route('orders.index')
            ->with('success', 'Order created successfully');
    }

    public function edit($id)
    {
        $suppliers = Supplier::select('id', 'name')->get();
        $items = Item::all();

        $purchase = Purchase::with('details')->find($id);
        if ($purchase->status == 0){
            return redirect()->route('purchases.index')->with('success', 'Already Approved, do not have permission to edit this purchase');
        }
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

        $purchaseData['update_by'] = Auth::user()->name;
        $purchaseData['total_amount'] = str_replace(',', '', $purchaseData['total_amount']);

        $purchase = Purchase::findOrFail($id);
        $purchase->update($purchaseData);

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

        $purchase->details()->delete();

        $purchase->details()->createMany($purchaseDetails);

        return redirect()->route('purchases.index')
            ->with('success', 'Purchase updated successfully');
    }

    public function show($id)
    {
        $suppliers = Supplier::select('id', 'name')->get();
        $items = Item::all();

        $purchase = Purchase::with('details')->find($id);
        return view('purchases.show', compact('purchase', 'suppliers', 'items'));
    }
    public function approve(Request $request, $id)
    {
        $purchase = Purchase::findOrFail($id);
        if ($request->input('approval') == "approve"){
            $purchase->status = '0';
            $purchase->save();

            foreach ($purchase->details as $detail) {
                $item = Item::find($detail->item_id);

                if ($item) {
                    $item->quantity += $detail->quantity;
                    $item->save();
                }
            }

            return redirect()->route('purchases.index')->with('success', 'Purchase approved successfully');

        } elseif ($request->input('approval') == "reject"){
            $purchase->status = '2';
            $purchase->save();

            return redirect()->route('purchases.index')->with('success', 'Purchase rejected successfully');
        } else {
            return redirect()->route('purchases.index')->with('success', 'Oops!, Something went wrong');
        }
    }

    public function destroy($id)
    {
        $purchase = Purchase::findOrFail($id);
        $purchase->details()->delete();

        $purchase->delete();

        return redirect()->route('purchases.index')
            ->with('success', 'Purchase deleted successfully');
    }
}

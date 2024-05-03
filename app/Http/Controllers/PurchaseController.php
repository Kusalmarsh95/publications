<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = Purchase::all();
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
//        dd($request);
        $request->validate([
//            'project_id' => 'required|exists:projects,id',
//            'task_id.*' => 'required|exists:appointments,id',
//            'device_id.*' => 'required|exists:devices,id',
//            'qty.*' => 'required',
//            'allocated_hrs.*' => 'required',
//            'device_name.*' => 'required',
//            'power_consume.*' => 'required',
//            'device_qty.*' => 'required',
//            'depreciation_cost' => 'required',
//            'electricity_cost' => 'required',
        ]);

        Supplier::create($validatedData);

        return redirect()->route('suppliers.index')
            ->with('success', 'Supplier created successfully');
    }
}

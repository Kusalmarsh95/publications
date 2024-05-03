<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::all();
        return view('suppliers.index',compact('suppliers'));
    }

    public function create()
    {
        return view('suppliers.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'nullable',
            'phone' => 'required',
            'address' => 'required',
            'shop_name' => 'required',
            'type' => 'required',
            'status' => 'required',
            'account_no' => 'nullable',
            'bank' => 'nullable',
            'bank_branch' => 'nullable',
        ]);

        Supplier::create($validatedData);

        return redirect()->route('suppliers.index')
            ->with('success', 'Supplier created successfully');
    }

    public function edit($id)
    {
        $supplier = Supplier::find($id);
        return view('suppliers.edit',compact('supplier'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'nullable',
            'phone' => 'required',
            'address' => 'required',
            'shop_name' => 'required',
            'status' => 'required',
            'type' => 'required',
            'account_no' => 'nullable',
            'bank' => 'nullable',
            'bank_branch' => 'nullable',
        ]);

        $supplier = Supplier::find($id);
        $supplier->update($validatedData);

        return redirect()->route('suppliers.index')
            ->with(['success' => 'Supplier updated successfully']);
    }

    public function destroy($id)
    {
        Supplier::find($id)->delete();
        return redirect()->route('suppliers.index')
            ->with('success','Supplier deleted successfully');
    }
}

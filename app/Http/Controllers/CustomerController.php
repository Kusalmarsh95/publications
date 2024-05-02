<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return view('customers.index',compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'nullable',
            'mobile' => 'required',
            'address' => 'required',
            'type' => 'required',
            'account_no' => 'nullable',
            'bank' => 'nullable',
            'bank_branch' => 'nullable',
        ]);

        Customer::create($validatedData);

        return redirect()->route('customers.index')
            ->with('success', 'Customer created successfully');
    }

    public function edit($id)
    {
        $customer = Customer::find($id);
        return view('customers.edit',compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'nullable',
            'mobile' => 'required',
            'address' => 'required',
            'type' => 'required',
            'account_no' => 'nullable',
            'bank' => 'nullable',
            'bank_branch' => 'nullable',
        ]);

        $customer = Customer::find($id);
        $customer->update($validatedData);

        return redirect()->route('customers.index')
            ->with(['success' => 'Customer updated successfully']);
    }

    public function destroy($id)
    {
        Customer::find($id)->delete();
        return redirect()->route('customers.index')
            ->with('success','Customer deleted successfully');
    }
}

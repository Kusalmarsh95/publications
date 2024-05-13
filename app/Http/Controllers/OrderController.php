<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderAssign;
use App\Models\OrderDetail;
use App\Models\Service;
use App\Models\User;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('customer')->get();

        foreach ($orders as $order) {
            $latestAssignment = $order->assigns->sortByDesc('created_at')->first();
            if (!$latestAssignment){
                $order->assignee = 'Not Assigned';
            }else {
                    $order->assignee = $latestAssignment->fwd_to;
            }
        }

        return view('orders.index',compact('orders'));
    }

    public function create()
    {
        $customers = Customer::select('id', 'name')->get();
        $workers = Worker::select('id', 'name')->get();
        $services = Service::all();

        $last = DB::table('orders')->max('order_no');
        $next = str_pad($last + 1, 8, '0', STR_PAD_LEFT);

        return view('orders.create', compact('customers', 'services', 'workers', 'next'));
    }

    public function store(Request $request)
    {
        $orderData = $request->validate([
            'customer_id' => 'required|exists:suppliers,id',
            'date' => 'required',
            'order_no' => 'required',
            'discount' => 'nullable',
            'total_amount' => 'nullable',
        ]);

        $file = "";
        if ($request->hasFile('files')) {
            $file = $request->file('files')->store('uploads', 'public');
        }

        $orderData['files'] = $file;
        $orderData['remarks'] = $request->remarks;
        $orderData['status'] = 1;
        $orderData['created_by'] = Auth::user()->name;
        $orderData['total_amount'] = str_replace(',', '', $orderData['total_amount']);

        $order = Order::create($orderData);

        $request->validate([
            'service_id' => 'required|array',
            'service_id.*' => 'exists:services,id',
            'quantity' => 'required|array',
            'quantity.*' => 'required|min:1',
            'unit_price' => 'required|array',
            'unit_price.*' => 'required|min:0',
            'total' => 'nullable|array',
            'total.*' => 'nullable',
        ]);

        $orderDetails = [];
        foreach ($request->service_id as $key => $service_id) {
            $orderDetails[] = [
                'order_id' => $order->id,
                'service_id' => $service_id,
                'quantity' => $request->quantity[$key],
                'unit_price' => str_replace(',', '', $request->unit_price[$key]),
                'total' => isset($request->total[$key]) ? str_replace(',', '', $request->total[$key]) : null,
            ];
        }

        OrderDetail::insert($orderDetails);

        OrderAssign::create([
            'order_id' => $order->id,
            'fwd_to' => 'Publication OC',
            'fwd_by' => 'Customer',
            'notes' => 'Initial order',
        ]);

        return redirect()->route('orders.index')->with('success', 'Order created successfully');
    }

    public function edit($id)
    {
        $customers = Customer::select('id', 'name')->get();
        $workers = Worker::select('id', 'name')->get();
        $services = Service::all();

        $order = Order::with('details')->find($id);
        if ($order->status == 0){
            return redirect()->route('orders.index')->with('success', 'Already Completed, do not have permission to edit this order');
        }
        return view('orders.edit', compact('order','customers', 'services', 'workers'));
    }

    public function update(Request $request, $id)
    {

        $orderData = $request->validate([
            'customer_id' => 'required|exists:suppliers,id',
            'date' => 'required',
            'order_no' => 'required',
            'discount' => 'nullable',
            'total_amount' => 'nullable',
        ]);

        $file = "";
        if ($request->hasFile('files')) {
            $file = $request->file('files')->store('uploads', 'public');
            $orderData['files'] = $file;
        }

        $orderData['remarks'] = $request->remarks;
        $orderData['status'] = 1;
        $orderData['created_by'] = Auth::user()->name;
        $orderData['total_amount'] = str_replace(',', '', $orderData['total_amount']);

        $order = Order::findOrFail($id);
        $order->update($orderData);

        $request->validate([
            'service_id' => 'required|array',
            'service_id.*' => 'exists:services,id',
            'quantity' => 'required|array',
            'quantity.*' => 'required|min:1',
            'unit_price' => 'required|array',
            'unit_price.*' => 'required|min:0',
            'total' => 'nullable|array',
            'total.*' => 'nullable',
        ]);

        $orderDetails = [];
        foreach ($request->service_id as $key => $service_id) {
            $orderDetails[] = [
                'order_id' => $order->id,
                'service_id' => $service_id,
                'quantity' => $request->quantity[$key],
                'unit_price' => str_replace(',', '', $request->unit_price[$key]),
                'total' => isset($request->total[$key]) ? str_replace(',', '', $request->total[$key]) : null,
            ];
        }
        $order->details()->delete();

        $order->details()->createMany($orderDetails);

        return redirect()->route('orders.index')
            ->with('success', 'Order updated successfully');
    }

    public function show($id)
    {
        $customers = Customer::select('id', 'name')->get();
        $workers = Worker::select('id', 'name')->get();
        $services = Service::all();
        $users = User::all();

        $order = Order::with('details')->find($id);
        $note = $order->assigns->sortByDesc('created_at')->first();

        if ($order->status == 0){
            return redirect()->route('orders.index')->with('success', 'Already Completed, do not have permission');
        }
        return view('orders.show', compact('order','customers',
            'services', 'workers', 'users', 'note'));
    }
    public function approve(Request $request, $id)
    {

        $order = Order::findOrFail($id);
        if ($request->input('approval') == "approve"){
            $order->status = '0';
            $order->save();

            foreach ($order->details as $detail) {
                $service = Service::find($detail->item_id);

                if ($service) {
                    $service->quantity += $detail->quantity;
                    $service->save();
                }
            }
            $validatedAssign = $request->validate([
                'fwd_to' => 'required',
            ]);
            $validatedAssign['order_id'] = $order->id;
            $validatedAssign['fwd_by'] = Auth::user()->id;
            $validatedAssign['notes'] = $request->input('notes');

            OrderAssign::create($validatedAssign);

            return redirect()->route('orders.index')->with('success', 'Order approved successfully');

        } elseif ($request->input('approval') == "forward"){

            $validatedAssign = $request->validate([
                'fwd_to' => 'required',
            ]);
            $validatedAssign['order_id'] = $order->id;
            $validatedAssign['fwd_by'] = Auth::user()->id;
            $validatedAssign['notes'] = $request->input('notes');

            OrderAssign::create($validatedAssign);

            return redirect()->route('orders.index')->with('success', 'Order forwarded successfully');

        } elseif ($request->input('approval') == "reject"){
            $order->status = '2';
            $order->save();
            $validatedAssign = $request->validate([
                'fwd_to' => 'required',
            ]);
            $validatedAssign['order_id'] = $order->id;
            $validatedAssign['fwd_by'] = Auth::user()->name;
            $validatedAssign['notes'] = $request->input('notes');

            OrderAssign::create($validatedAssign);

            return redirect()->route('order.index')->with('success', 'Order rejected successfully');
        } else {
            return redirect()->route('orders.index')->with('success', 'Oops!, Something went wrong');
        }

    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->details()->delete();

        $order->delete();

        return redirect()->route('orders.index')
            ->with('success', 'Order deleted successfully');
    }
}

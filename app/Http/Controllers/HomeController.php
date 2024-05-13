<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Item;
use App\Models\ItemCategory;
use App\Models\Order;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $orders = Order::where('status','=','1')->get();
        $customers = Customer::all();
        $services = Service::all();
        $items = Item::all();
        $serviceCategories = ServiceCategory::all();
        $itemCategories = ItemCategory::all();

        return view('home', compact('orders', 'customers', 'services', 'items',
            'serviceCategories', 'itemCategories'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::with('serviceCategory')->get();
        return view('services.index',compact('services'));
    }

    public function create()
    {
        $categories = ServiceCategory::all();
        return view('services.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category_id' => 'required|exists:service_categories,id',
//            'unit_id' => 'required|exists:service_categories,id',
            'name' => 'required',
            'code' => 'nullable',
            'unit_price' => 'required',
        ]);

        Service::create($validatedData);

        return redirect()->route('services.index')
            ->with('message', 'Service created successfully');
    }

    public function edit($id)
    {
        $service = Service::find($id);
        $categories = ServiceCategory::all();
        return view('services.edit',compact('service', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'category_id' => 'required|exists:service_categories,id',
//            'unit_id' => 'required|exists:service_categories,id',
            'name' => 'required',
            'code' => 'nullable',
            'unit_price' => 'required',
        ]);

        $service = Service::find($id);
        $service->update($validatedData);

        return redirect()->route('services.index')
            ->with(['message' => 'service updated successfully']);
    }

    public function destroy($id)
    {
        Service::find($id)->delete();
        return redirect()->route('services.index')
            ->with('success','Service deleted successfully');
    }
}

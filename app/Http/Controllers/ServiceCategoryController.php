<?php

namespace App\Http\Controllers;

use App\Models\ServiceCategory;
use Illuminate\Http\Request;

class ServiceCategoryController extends Controller
{
    public function index()
    {
        $serviceCategories = ServiceCategory::all();
        return view('services-category.index',compact('serviceCategories'));
    }

    public function create()
    {
        return view('services-category.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'remark' => 'nullable',
        ]);

        ServiceCategory::create($validatedData);

        return redirect()->route('services-category.index')
            ->with('success', 'Service category created successfully');
    }

    public function edit($id)
    {
        $serviceCategory = ServiceCategory::find($id);

        return view('services-category.edit',compact('serviceCategory'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'remark' => 'nullable',
        ]);

        $serviceCategory = ServiceCategory::find($id);
        $serviceCategory->update($validatedData);

        return redirect()->route('services-category.index')
            ->with(['success' => 'Service category updated successfully']);
    }

    public function destroy($id)
    {
        ServiceCategory::find($id)->delete();
        return redirect()->route('services-category.index')
            ->with('success','Service category deleted successfully');
    }
}

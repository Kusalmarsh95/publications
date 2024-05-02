<?php

namespace App\Http\Controllers;

use App\Models\ItemCategory;
use Illuminate\Http\Request;

class ItemCategoryController extends Controller
{
    public function index()
    {
        $itemCategories = ItemCategory::all();
        return view('items-category.index',compact('itemCategories'));
    }

    public function create()
    {
        return view('items-category.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'remark' => 'nullable',
        ]);

        ItemCategory::create($validatedData);

        return redirect()->route('items-category.index')
            ->with('message', 'Item category created successfully');
    }

    public function edit($id)
    {
        $itemCategory = ItemCategory::find($id);

        return view('items-category.edit',compact('itemCategory'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'remark' => 'nullable',
        ]);

        $itemCategory = ItemCategory::find($id);
        $itemCategory->update($validatedData);

        return redirect()->route('items-category.index')
            ->with(['message' => 'Item category updated successfully']);
    }

    public function destroy($id)
    {
        ItemCategory::find($id)->delete();
        return redirect()->route('items-category.index')
            ->with('success','Item category deleted successfully');
    }
}

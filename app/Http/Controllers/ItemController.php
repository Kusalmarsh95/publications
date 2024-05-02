<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemCategory;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::with('itemCategory')->get();
        return view('items.index',compact('items'));
    }

    public function create()
    {
        $categories = ItemCategory::all();
        return view('items.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category_id' => 'required|exists:item_categories,id',
//            'unit_id' => 'required|exists:item_categories,id',
            'name' => 'required',
            'code' => 'nullable',
            'quantity' => 'required',
            'buying_price' => 'required',
            'selling_price' => 'required',
            'quantity_alert' => 'required',
            'remark' => 'nullable',
        ]);

        Item::create($validatedData);

        return redirect()->route('items.index')
            ->with('message', 'Item created successfully');
    }

    public function edit($id)
    {
        $item = Item::find($id);
        $categories = ItemCategory::all();
        return view('items.edit',compact('item', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'category_id' => 'required|exists:item_categories,id',
//            'unit_id' => 'required|exists:item_categories,id',
            'name' => 'required',
            'code' => 'nullable',
            'quantity' => 'required',
            'buying_price' => 'required',
            'selling_price' => 'required',
            'quantity_alert' => 'required',
            'remark' => 'nullable',
        ]);

        $item = Item::find($id);
        $item->update($validatedData);

        return redirect()->route('items.index')
            ->with(['message' => 'Item updated successfully']);
    }

    public function destroy($id)
    {
        Item::find($id)->delete();
        return redirect()->route('items.index')
            ->with('success','Item deleted successfully');
    }
}

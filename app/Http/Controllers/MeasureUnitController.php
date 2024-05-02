<?php

namespace App\Http\Controllers;

use App\Models\MeasureUnit;
use Illuminate\Http\Request;

class MeasureUnitController extends Controller
{
    public function index()
    {
        $units = MeasureUnit::all();
        return view('units.index',compact('units'));
    }

    public function create()
    {
        return view('units.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'short_name' => 'required',
        ]);

        MeasureUnit::create($validatedData);

        return redirect()->route('units.index')
            ->with('message', 'Measure unit created successfully');
    }

    public function edit($id)
    {
        $unit = MeasureUnit::find($id);

        return view('units.edit',compact('unit'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'short_name' => 'required',
        ]);

        $unit = MeasureUnit::find($id);
        $unit->update($validatedData);

        return redirect()->route('units.index')
            ->with(['message' => 'Measure unit updated successfully']);
    }

    public function destroy($id)
    {
        MeasureUnit::find($id)->delete();
        return redirect()->route('units.index')
            ->with('success','Measure unit deleted successfully');
    }
}

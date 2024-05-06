<?php

namespace App\Http\Controllers;

use App\Models\Worker;
use Illuminate\Http\Request;

class WorkerController extends Controller
{public function index()
{
    $workers = Worker::all();
    return view('workers.index',compact('workers'));
}

    public function create()
    {
        return view('workers.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'service_no' => 'required',
            'rank' => 'nullable',
            'name' => 'required',
            'mobile' => 'required',
            'regiment' => 'nullable',
            'status' => 'required',
        ]);

        Worker::create($validatedData);

        return redirect()->route('workers.index')
            ->with('success', 'Worker created successfully');
    }

    public function edit($id)
    {
        $worker = Worker::find($id);
        return view('workers.edit',compact('worker'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'service_no' => 'required',
            'rank' => 'nullable',
            'name' => 'required',
            'mobile' => 'required',
            'regiment' => 'nullable',
            'status' => 'required',
        ]);

        $worker = Worker::find($id);
        $worker->update($validatedData);

        return redirect()->route('workers.index')
            ->with(['success' => 'Worker updated successfully']);
    }

    public function destroy($id)
    {
        Worker::find($id)->delete();
        return redirect()->route('workers.index')
            ->with('success','Worker deleted successfully');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Models\IssueDetails;
use App\Models\Item;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IssueController extends Controller
{
    public function index()
    {
        $issues = Issue::with('worker')->get();
        return view('issues.index',compact('issues'));
    }

    public function create()
    {
        $workers = Worker::select('id', 'name')->get();
        $items = Item::all();
        return view('issues.create', compact('workers', 'items'));
    }

    public function store(Request $request)
    {
        $issueData = $request->validate([
            'worker_id' => 'required|exists:workers,id',
            'date' => 'required',
            'issue_no' => 'required',
            'total_items' => 'nullable',
        ]);

        $issueData['status'] = 1;
        $issueData['created_by'] = Auth::user()->name;;
        $issue = Issue::create($issueData);

        $request->validate([
            'item_id' => 'required|array',
            'item_id.*' => 'exists:items,id',
            'quantity' => 'required|array',
            'quantity.*' => 'required|min:1',
            'unit_price' => 'required|array',
            'unit_price.*' => 'required|min:0',
            'total' => 'nullable|array',
            'total.*' => 'nullable',
        ]);

        $issueDetails = [];
        foreach ($request->item_id as $key => $item_id) {
            $issueDetails[] = [
                'issue_id' => $issue->id,
                'item_id' => $item_id,
                'quantity' => $request->quantity[$key],
                'unit_price' => str_replace(',', '', $request->unit_price[$key]),
                'total' => isset($request->total[$key]) ? str_replace(',', '', $request->total[$key]) : null,
            ];
        }

        IssueDetails::insert($issueDetails);

        return redirect()->route('issues.index')
            ->with('success', 'Issue created successfully');
    }

    public function edit($id)
    {
        $workers = Worker::select('id', 'name')->get();
        $items = Item::all();

        $issue = Issue::with('details')->find($id);
        if ($issue->status == 0){
            return redirect()->route('issues.index')->with('success', 'Already Approved, do not have permission to edit this issue');
        }
        return view('issues.edit', compact('issue', 'workers', 'items'));
    }

    public function update(Request $request, $id)
    {
        $issueData = $request->validate([
            'worker_id' => 'required|exists:workers,id',
            'date' => 'required',
            'issue_no' => 'required',
            'total_items' => 'nullable',
        ]);
        $issueData['updated_by'] = Auth::user()->name;;

        $issue = issue::findOrFail($id);
        $issue->update($issueData);

        $request->validate([
            'item_id' => 'required|array',
            'item_id.*' => 'exists:items,id',
            'quantity' => 'required|array',
            'quantity.*' => 'required|min:1',
            'unit_price' => 'required|array',
            'unit_price.*' => 'required|min:0',
            'total' => 'nullable|array',
            'total.*' => 'nullable',
        ]);

        $issueDetails = [];
        foreach ($request->item_id as $key => $item_id) {
            $issueDetails[] = [
                'issue_id' => $id,
                'item_id' => $item_id,
                'quantity' => $request->quantity[$key],
                'unit_price' => str_replace(',', '', $request->unit_price[$key]),
                'total' => isset($request->total[$key]) ? str_replace(',', '', $request->total[$key]) : null,
            ];
        }

        $issue->details()->delete();

        $issue->details()->createMany($issueDetails);

        return redirect()->route('issues.index')
            ->with('success', 'Issues updated successfully');
    }

    public function show($id)
    {
        $workers = Worker::select('id', 'name')->get();
        $items = Item::all();

        $issue = Issue::with('details')->find($id);
        return view('issues.show', compact('issue', 'workers', 'items'));
    }
    public function approve(Request $request, $id)
    {
        $issue = Issue::findOrFail($id);
        if ($request->input('approval') == "approve"){
            $issue->status = '0';
            $issue->save();

            foreach ($issue->details as $detail) {
                $item = Item::find($detail->item_id);

                if ($item) {
                    $item->quantity -= $detail->quantity;
                    $item->save();
                }
            }

            return redirect()->route('issues.index')->with('success', 'Issue approved successfully');

        } elseif ($request->input('approval') == "reject"){
            $issue->status = '2';
            $issue->save();

            return redirect()->route('issues.index')->with('success', 'Issue rejected successfully');
        } else {
            return redirect()->route('issues.index')->with('success', 'Oops!, Something went wrong');
        }
    }

    public function destroy($id)
    {
        $issue = Issue::findOrFail($id);
        $issue->details()->delete();

        $issue->delete();

        return redirect()->route('issues.index')
            ->with('success', 'Issue deleted successfully');
    }
}

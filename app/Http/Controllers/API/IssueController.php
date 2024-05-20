<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Issue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IssueController extends Controller
{
    public function get_issue()
    {
        $data = Issue::get();
        return response()->json(['success' => 1, 'data' => $data]);
    }

    public function create_issue(Request $request)
    {
        $issue = new Issue();
        $issue->issue_note = $request->issue_note;
        $issue->user_id = Auth::id();
        $issue->task_id = $request->task_id;
        $issue->status = 0;
        $issue->save();

        return response()->json(['success' => 1, 'message' => 'Issue created successfully.']);
    }

    public function update_issue(Request $request, $id)
    {
        $issue = Issue::where('id', $id);
        $issue->issue_note = $request->issue_note;
        $issue->user_id = Auth::id();
        $issue->task_id = $request->user_id;
        $issue->status = 0;
        $issue->update();

        return response()->json(['success' => 1, 'message' => 'Issue created successfully.']);
    }
}

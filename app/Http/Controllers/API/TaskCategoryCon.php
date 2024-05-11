<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Issue;
use App\Models\TaskCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskCategoryCon extends Controller
{
    public function get_task_category()
    {
        $data = TaskCategory::get();
        return response()->json(['succeaa' => 1, 'data' => $data]);
    }

    public function create_task_category(Request $request)
    {
        $taskCateroty = new TaskCategory();

        $taskCateroty->name = $request->name;
        $taskCateroty->save();

        return response()->json(['success' => 1, 'message' => 'Categoty created successfully.'], 200);
    }


    public function update_task_category(Request $request, $id)
    {
        $taskCateroty = TaskCategory::where('id', $id)->first();

        $taskCateroty->name = $request->name;
        $taskCateroty->update();

        return response()->json(['success' => 1, 'message' => 'Categoty updated successfully.'], 200);
    }


    public function create_task_issue(Request $request)
    {
        $issue = new Issue();

        $issue->user_id = $request->user_id;
        $issue->issue_note = $request->issue_note;
        $issue->task_id = $request->task_id;
        $issue->status = 0;
        $issue->save();

        return response()->json(['success' => 1, 'message' => 'Issue created successfully.'], 200);
    }

    public function resolve_task_issue($id)
    {
        $issue = Issue::whereId($id)->first();
        $issue->status = 1;
        $issue->save();

        return response()->json(['success' => 1, 'message' => 'Issue resolved successfully.'], 200);
    }

    public function get_issue_for_admin()
    {
        $issues = Issue::with('getUser', 'getTask')->whereStatus('0')->get();
        return response()->json(['success' => 1, 'data' => $issues], 200);
    }

    public function get_issue_for_user($user_id)
    {
        $issues = Issue::whereUserId($user_id)->whereStatus('0')->with('getTask')->get();
        return response()->json(['success' => 1, 'data' => $issues], 200);
    }
}

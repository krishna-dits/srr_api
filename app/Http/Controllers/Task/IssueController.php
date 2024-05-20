<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Models\Issue;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IssueController extends Controller
{
    public function create_issue(Request $request, $task_id)
    {
        $task = Task::whereId($task_id)->first();
        if (empty($task)) {
            return redirect()->back()->with('error', 'Task not found.');
        }

        if (Request()->isMethod('POST')) {
            $request->validate([
                'issue_note'        => 'required'
            ]);

            $issue = new Issue();
            $issue->issue_note = $request->issue_note;
            $issue->user_id = Auth::id();
            $issue->task_id = $task_id;
            $issue->status = 0;
            $issue->save();

            return redirect()->back()->with('success', 'Issue created successfully.');
        }

        return view('task.issue_create');
    }

    public function update_issue(Request $request, $issue_id)
    {
        $issue = Issue::whereId($issue_id)->first();
        if (empty($issue)) {
            return redirect()->back()->with('error', 'Issue not found.');
        }

        if (Request()->isMethod('POST')) {
            $request->validate([
                'issue_note'        => 'required'
            ]);

            $issue->issue_note = $request->issue_note;
            $issue->update();

            return redirect(route('my_issue'))->with('success', 'Issue updated successfully.');
        }

        return view('task.issue_create', compact('issue'));
    }


    public function issue_list()
    {
        $issue = Issue::with('getUser', 'getTask')->whereStatus('0')->get();
        return view('task.issue_list', compact('issue'));
    }

    public function my_issue()
    {
        $issue = Issue::whereUserId(Auth::id())->whereStatus('0')->with('getUser', 'getTask')->get();
        return view('task.my_issue', compact('issue'));
    }

    public function resolve_issue($id)
    {
        $task = Issue::whereId($id)->first();
        if (empty($task)) {
            return redirect()->back()->with('error', 'Task not found.');
        }

        $issue = Issue::whereId($id)->first();
        $issue->status = 1;
        $issue->save();

        return redirect()->back()->with('success', 'Issue resolved successfully.');
    }
}

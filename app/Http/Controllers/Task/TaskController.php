<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function create_task(Request $request)
    {

        if (Request()->isMethod('POST')) {

            $request->validate([
                'title'         => 'required',
                'description'   => 'nullable|max:2000',
                'start_date'    => 'required',
                'end_date'      => 'required',
                'user_ids'      => 'required',
                'priority'      => 'required',
                'category_id'   => 'required',
                'document'      => 'nullable',
            ]);

            $filename = null;
            if ($request->hasfile('document')) {
                $file = $request->file('document');
                $filename = rand() . '.' . $file->getClientOriginalExtension();
                $file->move("public/assets/task/document/", $filename);
            }

            $data = [
                'title'          => $request->title,
                'description'    => $request->description,
                'start_date'     => $request->start_date,
                'end_date'       => $request->end_date,
                'user_ids'       => json_encode($request->user_ids),
                'assign_user_id' => Auth::id(),
                'priority'       => $request->priority,
                'category_id'    => $request->category_id,
                'project_id'     => $request->project_id,
                'status'         => 'pending',
                'document'       => $filename,
            ];

            $task = Task::create($data);

            if ($task) {
                return redirect()->back()->with('message', 'Task created successfully.');
            } else {
                return redirect()->back()->with('message', 'Something went wrong.');
            }

            return view('task.add_task');
        }

        $users = User::get();
        return view('task.create_task', compact('users'));
    }

    public function task_list()
    {
    }
}

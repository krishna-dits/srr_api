<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
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
                'user_ids.*'    => 'exists:users,id',
                'priority'      => 'required',
                'category_id'   => 'required',
                'document'      => 'nullable',
            ]);

            // dd($request->all());

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
                'status'         => 'Yet to start',
                'document'       => $filename,
            ];

            $task = Task::create($data);

            if ($task) {
                return redirect(route('task_list'))->with('success', 'Task created successfully.');
            } else {
                return redirect()->back()->with('success', 'Something went wrong.');
            }

            return view('task.add_task');
        }

        $task = null;
        $users = User::get();
        return view('task.create_task', compact('users'));
    }


    public function update_task(Request $request, $id)
    {
        $task = Task::whereId($id)->first();

        if (empty($task)) {
            return redirect()->back()->with('error', 'Task not found.');
        }

        if (Request()->isMethod('POST')) {

            $request->validate([
                'title'         => 'required',
                'description'   => 'nullable|max:2000',
                'start_date'    => 'required',
                'end_date'      => 'required',
                'user_ids'      => 'required',
                'user_ids.*'    => 'exists:users,id',
                'priority'      => 'required',
                'category_id'   => 'required',
                'document'      => 'nullable',
            ]);

            // dd($request->all());

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
                'status'         => 'Yet to start',
                'document'       => $filename,
            ];

            $task = Task::create($data);

            if ($task) {
                return redirect(route('task_list'))->with('success', 'Task created successfully.');
            } else {
                return redirect()->back()->with('success', 'Something went wrong.');
            }

            return view('task.add_task');
        }

        $users = User::get();
        return view('task.create_task', compact('users', 'task'));
    }



    public function task_list($type = null, $user_id = null)
    {
        $tasks = Task::get();

        foreach ($tasks as $value) {
            $users = json_decode($value['user_ids'], true);
            $value['user_names'] = User::select('name')->whereIn('id', $users)->get()->toArray();
        }

        // dd($tasks->toArray());
        return view('task.task_list', compact('tasks'));
    }

    public function task_status($id, $status)
    {
        $task = Task::whereId($id)->first();

        if (empty($task)) {
            return response()->json(['success' => 0, 'message' => 'Task not found.']);
        }

        $statuses = ['Yet to start', 'In progress', 'Completed'];

        if (in_array($status, $statuses)) {

            $task->status = $status;
            $task->update();

            return response()->json(['success' => 1, 'message' => 'Task status updated successfully..']);
        } else {
            return response()->json(['success' => 0, 'message' => 'Invalid status.']);
        }
    }
}

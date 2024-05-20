<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Models\Leave;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
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


            foreach ($request->user_ids as $user) {
                // Parse the dates
                $startDate = Carbon::parse($request->start_date);
                $endDate = Carbon::parse($request->end_date);

                $leave = Leave::where('user_id', $user)
                    ->where(function ($query) use ($startDate, $endDate) {
                        $query->whereBetween('from_date', [$startDate, $endDate])
                            ->orWhereBetween('to_date', [$startDate, $endDate])
                            ->orWhereDate('to_date', $startDate)
                            ->orWhere(function ($query) use ($startDate, $endDate) {
                                $query->where('from_date', '<=', $endDate)
                                    ->where('to_date', '>=', $startDate);
                            });
                    })->exists();


                if ($leave) {
                    $user = User::whereId($user)->first();
                    // return response()->json(['success' => 0, 'message' => "$user->name is on leave during the specified period"], 400);
                    return redirect()->back()->with('error', "$user->name is on leave during the specified period");
                }
            }



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
                return redirect()->back()->with('error', 'Something went wrong.');
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
                return redirect()->back()->with('error', 'Something went wrong.');
            }

            return view('task.add_task');
        }

        $users = User::get();
        return view('task.create_task', compact('users', 'task'));
    }



    public function task_list(Request $request)
    {

        if ($request->category_id && $request->status && $request->priority) {

            $tasks = Task::whereCategoryId($request->category_id)->whereStatus($request->status)->wherePriority($request->priority)->get();
        } elseif ($request->category_id && $request->priority) {

            $tasks = Task::whereCategoryId($request->category_id)->wherePriority($request->priority)->get();
        } elseif ($request->status && $request->priority) {

            $tasks = Task::wherePriority($request->priority)->whereStatus($request->status)->get();
        } elseif ($request->category_id && $request->status) {

            $tasks = Task::whereCategoryId($request->category_id)->whereStatus($request->status)->get();
        } elseif ($request->category_id) {

            $tasks = Task::whereCategoryId($request->category_id)->get();
        } elseif ($request->status) {

            $tasks = Task::whereStatus($request->status)->get();
        } elseif ($request->priority) {

            $tasks = Task::wherePriority($request->priority)->get();
        } else {
            $tasks = Task::get();
        }


        foreach ($tasks as $value) {
            $users = json_decode($value['user_ids'], true);
            $value['user_names'] = User::select('name')->whereIn('id', $users)->get()->toArray();
            $value['document'] = $value['document'] ? url('/') . '/public/assets/task/document/' . $value['document'] : null;
        }

        // dd($tasks->toArray());
        return view('task.task_list', compact('tasks', 'request'));
    }

    public function task_status($id, $status)
    {
        $task = Task::whereId($id)->first();

        if (empty($task)) {
            return response()->json(['success' => '0', 'message' => 'Task not found.']);
        }

        $statuses = ['Yet to start', 'In progress', 'Completed'];

        if (in_array($status, $statuses)) {

            $task->status = $status;
            $task->update();

            return response()->json(['success' => '1', 'message' => 'Task status updated successfully..']);
        } else {
            return response()->json(['success' => '0', 'message' => 'Invalid status.']);
        }
    }

    public function delete_task($id)
    {
        $task = Task::whereId($id)->first();

        if (empty($task)) {
            return redirect()->back()->with('error', 'Task not found.');
        }

        $task->forceDelete();

        return redirect()->back()->with('success', 'Task deleted successfully.');
    }

    public function my_task(Request $request)
    {
        $request['user_id'] = (string) Auth::id();

        if ($request->category_id && $request->status && $request->priority) {

            $tasks = Task::whereArchive(0)->whereJsonContains('user_ids', $request->user_id)->whereCategoryId($request->category_id)->whereStatus($request->status)->wherePriority($request->priority)->get();
        } elseif ($request->category_id && $request->priority) {

            $tasks = Task::whereArchive(0)->whereJsonContains('user_ids', $request->user_id)->whereCategoryId($request->category_id)->wherePriority($request->priority)->get();
        } elseif ($request->status && $request->priority) {

            $tasks = Task::whereArchive(0)->whereJsonContains('user_ids', $request->user_id)->wherePriority($request->priority)->whereStatus($request->status)->get();
        } elseif ($request->category_id && $request->status) {

            $tasks = Task::whereArchive(0)->whereJsonContains('user_ids', $request->user_id)->whereCategoryId($request->category_id)->whereStatus($request->status)->get();
        } elseif ($request->category_id) {

            $tasks = Task::whereArchive(0)->whereJsonContains('user_ids', $request->user_id)->whereCategoryId($request->category_id)->get();
        } elseif ($request->status) {

            $tasks = Task::whereArchive(0)->whereJsonContains('user_ids', $request->user_id)->whereStatus($request->status)->get();
        } elseif ($request->priority) {

            $tasks = Task::whereArchive(0)->whereJsonContains('user_ids', $request->user_id)->wherePriority($request->priority)->get();
        } else {
            $tasks = Task::whereArchive(0)->whereJsonContains('user_ids', $request->user_id)->get();
        }

        foreach ($tasks as $value) {
            $users = json_decode($value['user_ids'], true);
            $value['user_names'] = User::select('name')->whereIn('id', $users)->get()->toArray();
            $value['document'] = $value['document'] ? url('/') . '/public/assets/task/document/' . $value['document'] : null;
        }

        // dd($tasks->toArray());
        return view('task.my_task', compact('tasks', 'request'));
    }

    public function archive_task($id, $status)
    {
        $task = Task::whereId($id)->withTrashed()->first();

        if (empty($task)) {
            return redirect()->back()->with('error', 'Task not found.');
        }

        if ($status == '0') {
            $task->archive = '0';
            $task->update();
            return redirect()->back()->with('success', 'Task unarchived successfully.');
        } else {
            $task->archive = '1';
            $task->update();
            return redirect()->back()->with('success', 'Task archived successfully.');
        }
    }

    public function my_archive_task()
    {
        $tasks = Task::whereArchive(1)->whereJsonContains('user_ids', (string) Auth::id())->get();

        foreach ($tasks as $value) {
            $users = json_decode($value['user_ids'], true);
            $value['user_names'] = User::select('name')->whereIn('id', $users)->get()->toArray();
            $value['document'] = $value['document'] ? url('/') . '/public/assets/task/document/' . $value['document'] : null;
        }

        return view('task.my_task', compact('tasks'));
    }
}

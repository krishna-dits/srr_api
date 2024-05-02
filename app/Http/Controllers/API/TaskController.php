<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TaskController extends Controller
{
    public function create_task(Request $request)
    {
        try {
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
                return response()->json(['success' => 1, 'message' => 'Task created successfully.', 'data' => $task], 200);
            } else {
                return response()->json(['success' => 0, 'message' => 'Something went wrong.'], 400);
            }
        } catch (\Throwable $th) {
            return response()->json(['success' => 0, 'message' => 'Internal server errors.'], 500);
        }
    }


    public function update_task(Request $request, $id)
    {
        try {
            $task = Task::where('id', $id)->withTrashed()->first();

            $filename = $task->document;
            if ($request->hasfile('document')) {
                $file = $request->file('document');
                $filename = rand() . '.' . $file->getClientOriginalExtension();
                $file->move("public/assets/task/document/", $filename);
            }

            $task->title          = $request->title;
            $task->description    = $request->description;
            $task->start_date     = $request->start_date;
            $task->end_date       = $request->end_date;
            $task->user_ids       = json_encode($request->user_ids);
            $task->assign_user_id = Auth::id();
            $task->priority       = $request->priority;
            $task->category_id    = $request->category_id;
            $task->project_id     = $request->project_id;
            $task->status         = 'pending';
            $task->document       = $filename;;

            $task->update();

            if ($task) {
                return response()->json(['success' => 1, 'message' => 'Task updated successfully.', 'data' => $task], 200);
            } else {
                return response()->json(['success' => 0, 'message' => 'Something went wrong.'], 400);
            }
        } catch (\Throwable $th) {
            return response()->json(['success' => 0, 'message' => 'Internal server errors.'], 500);
        }
    }


    public function get_task(Request $request)
    {
        try {
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

            return response()->json(['success' => 1, 'task' => TaskResource::collection($tasks)], 200);
        } catch (\Throwable $th) {
            return response()->json(['success' => 0, 'message' => 'Internal server errors.'], 500);
        }
    }


    public function task_status_update($id, $status)
    {
        $task = Task::whereId($id)->first();

        if (empty($task)) {
            return response()->json(['success' => 0, 'message' => 'Task not found.'], 400);
        }

        $task->update(['status' => $status]);

        return response()->json(['success' => 1, 'message' => 'Status updated successfully.'], 200);
    }


    public function get_task_for_user(Request $request)
    {
        try {
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
                $tasks = Task::whereJsonContains('user_ids', $request->user_id)->get();
            }

            return response()->json(['success' => 1, 'task' => TaskResource::collection($tasks)], 200);
        } catch (\Throwable $th) {
            return response()->json(['success' => 0, 'message' => 'Internal server errors.'], 500);
        }
    }
}

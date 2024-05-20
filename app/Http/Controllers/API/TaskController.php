<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Models\Issue;
use App\Models\Leave;
use App\Models\Task;
use App\Models\TaskReview;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TaskController extends Controller
{
    public function create_task(Request $request)
    {
        try {
            $users = json_decode($request->user_ids, true);

            foreach ($users as $user) {
                // Parse the dates
                $startDate = Carbon::parse($request->start_date);
                $endDate = Carbon::parse($request->end_date);

                $leave = Leave::where('user_id', $user)
                    ->where('status', '1')
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
                    return response()->json(['success' => 0, 'message' => "$user->name is on leave during the specified period"], 400);
                }
            }

            // return response()->json(['task created.']);

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
                'user_ids'       => $request->user_ids,
                'assign_user_id' => Auth::id(),
                'priority'       => $request->priority,
                'category_id'    => $request->category_id,
                'project_id'     => $request->project_id,
                'status'         => 'Yet to start',
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

            $users = json_decode($request->user_ids, true);
            foreach ($users as $user) {
                // Parse the dates
                $startDate = Carbon::parse($request->start_date);
                $endDate = Carbon::parse($request->end_date);

                $leave = Leave::where('user_id', $user)
                    ->where('status', '1')
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
                    return response()->json(['success' => 0, 'message' => "$user->name is on leave during the specified period"], 400);
                }
            }

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
            $task->user_ids       = $request->user_ids;
            $task->priority       = $request->priority;
            $task->category_id    = $request->category_id;
            $task->project_id     = $request->project_id;
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


    public function get_task_by_id(Request $request)
    {
        $data = Task::whereId($request->task_id)->withTrashed()->first();
        $data = new TaskResource($data);
        return response()->json(['success' => 1, 'task' => $data], 200);
    }


    public function task_status_update($id, $status)
    {
        $task = Task::whereId($id)->withTrashed()->first();

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

                $tasks = Task::whereJsonContains('user_ids', $request->user_id)->whereCategoryId($request->category_id)->whereStatus($request->status)->wherePriority($request->priority)->whereArchive('0')->get();
            } elseif ($request->category_id && $request->priority) {

                $tasks = Task::whereJsonContains('user_ids', $request->user_id)->whereCategoryId($request->category_id)->wherePriority($request->priority)->whereArchive('0')->get();
            } elseif ($request->status && $request->priority) {

                $tasks = Task::whereJsonContains('user_ids', $request->user_id)->wherePriority($request->priority)->whereStatus($request->status)->whereArchive('0')->get();
            } elseif ($request->category_id && $request->status) {

                $tasks = Task::whereJsonContains('user_ids', $request->user_id)->whereCategoryId($request->category_id)->whereStatus($request->status)->whereArchive('0')->get();
            } elseif ($request->category_id) {

                $tasks = Task::whereJsonContains('user_ids', $request->user_id)->whereCategoryId($request->category_id)->whereArchive('0')->get();
            } elseif ($request->status) {

                $tasks = Task::whereJsonContains('user_ids', $request->user_id)->whereStatus($request->status)->whereArchive('0')->get();
            } elseif ($request->priority) {

                $tasks = Task::whereJsonContains('user_ids', $request->user_id)->wherePriority($request->priority)->whereArchive('0')->get();
            } else {
                $tasks = Task::whereJsonContains('user_ids', $request->user_id)->whereArchive('0')->get();
            }

            return response()->json(['success' => 1, 'task' => TaskResource::collection($tasks)], 200);
        } catch (\Throwable $th) {
            return response()->json(['success' => 0, 'message' => 'Internal server errors.'], 500);
        }
    }

    public function delete_task(Request $request)
    {
        Issue::whereTaskId($request->id)->withTrashed()->delete();
        TaskReview::whereTaskId($request->id)->delete();
        Task::whereId($request->id)->delete();
        return response()->json(['success' => 1, 'message' => 'Task deleted successfully.'], 200);
    }

    public function task_arcrived(Request $request)
    {
        $task = Task::whereId($request->id)->withTrashed()->first();

        if ($request->archive == '0') {
            $task->archive = '0';
            $task->update();
            return response()->json(['success' => 1, 'message' => 'Task unarchived successfully.'], 200);
        } else {
            $task->archive = '1';
            $task->update();
            return response()->json(['success' => 1, 'message' => 'Task archived successfully.'], 200);
        }
    }

    public function get_archive_task_for_user(Request $request)
    {
        $tasks = Task::whereJsonContains('user_ids', $request->user_id)->whereArchive('1')->get();
        return response()->json(['success' => 1, 'task' => TaskResource::collection($tasks)], 200);
    }

    public function get_today_task_for_user(Request $request)
    {
        $tasks = Task::whereJsonContains('user_ids', $request->user_id)->whereDate('start_date', Carbon::today())->whereArchive('0')->get();
        return response()->json(['success' => 1, 'task' => TaskResource::collection($tasks)], 200);
    }

    public function get_today_task_for_admin(Request $request)
    {
        $tasks = Task::whereDate('start_date', Carbon::today())->get();
        return response()->json(['success' => 1, 'task' => TaskResource::collection($tasks)], 200);
    }

    public function task_count($user_id)
    {
        $yet_to_start_task = Task::whereJsonContains('user_ids', $user_id)->whereStatus('Yet to start')->count();
        $in_progress_task = Task::whereJsonContains('user_ids', $user_id)->whereStatus('In progress')->count();
        $completed_task = Task::whereJsonContains('user_ids', $user_id)->whereStatus('Completed')->count();
        $failed_task = Task::whereJsonContains('user_ids', $user_id)->whereDate('end_date', '<',  Carbon::today()->toDateString())->where('status', '!=', 'Completed')->count();

        return response()->json(['success' => 1, 'yet_to_start_task' => $yet_to_start_task, 'in_progress_task' => $in_progress_task, 'completed_task' => $completed_task, 'failed_task' => $failed_task]);
    }

    public function failed_task($user_id)
    {
        $failed_task = Task::whereJsonContains('user_ids', $user_id)->whereDate('end_date', '<',  Carbon::today()->toDateString())->where('status', '!=', 'Completed')->get();

        return response()->json(['success' => 1, 'failed_task' => TaskResource::collection($failed_task)]);
    }
}

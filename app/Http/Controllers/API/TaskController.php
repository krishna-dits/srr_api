<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function create(Request $request)
    {
        try {
            $validation = Validator::make($request->all(), [
                'title'         => 'required|max:255',
                'description'   => 'nullable',
                'start_date'    => 'required|date|after_or_equal:now',
                'end_date'      => 'required|date|after_or_equal:start_date',
                'user_ids'      => 'required',
                'user_ids.*'    => 'required|exists:users,id',
                'priority'      => 'required|in:high,medium,low,high urgent',
                'category_id'   => 'required|numeric',
                'document'      => 'nullable'
                // 'project_id'    => 'required|numeric',
            ]);

            if ($validation->fails()) {
                return response()->json([
                    'status'    => false,
                    'message'   => 'Validation fail',
                    'errors'    => $validation->errors(),
                ], 400);
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
                // 'project_id'     => $request->project_id,
                'status'         => 'pending',
                'document'       => $filename,
            ];

            $task = Task::create($data);

            if ($task) {
                return response()->json([
                    'status'    => true,
                    'message'   => 'Task created successfully.',
                    'errors'    => null,
                ], 201);
            } else {
                return response()->json([
                    'status'    => false,
                    'message'   => 'Fail',
                    'errors'    => null,
                ], 400);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status'    => false,
                'message'   => 'Internal server errors.',
                'errors'    => $th,
            ], 500);
        }
    }


    public function update(Request $request, $id)
    {
        try {
            $task = Task::where('id', $id)->withTrashed()->first();
            $validation = Validator::make($request->all(), [
                'title'         => 'required|max:255',
                'description'   => 'nullable',
                'start_date'    => 'required|date|after_or_equal:now',
                'end_date'      => 'required|date|after_or_equal:start_date',
                'user_ids'      => 'required',
                'user_ids.*'    => 'required|exists:users,id',
                'priority'      => 'required|in:high,medium,low,high urgent',
                'category_id'   => 'required|numeric',
                'document'      => 'nullable'
                // 'project_id'    => 'required|numeric',
            ]);

            if ($validation->fails()) {
                return response()->json([
                    'status'    => false,
                    'message'   => 'Validation fail',
                    'errors'    => $validation->errors(),
                ], 400);
            }

            $filename = $task->document;
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
                // 'project_id'     => $request->project_id,
                'status'         => 'pending',
                'document'       => $filename,
            ];

            $task = Task::create($data);

            if ($task) {
                return response()->json([
                    'status'    => true,
                    'message'   => 'Task updated successfully.',
                    'errors'    => null,
                ], 201);
            } else {
                return response()->json([
                    'status'    => false,
                    'message'   => 'Fail',
                    'errors'    => null,
                ], 400);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status'    => false,
                'message'   => 'Internal server errors.',
                'errors'    => $th,
            ], 500);
        }
    }
}

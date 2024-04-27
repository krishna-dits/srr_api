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
                'timeline'      => 'date',
                'user_id'       => 'required|exists:users,id',
                'priority'      => 'required|in:high,medium,low,high urgent',
                'project_id'    => 'required|numeric',
            ]);

            if ($validation->fails()) {
                return response()->json([
                    'status'    => false,
                    'message'   => 'Validation fail',
                    'errors'    => $validation->errors(),
                ], 400);
            }

            $data = [
                'title'          => $request->title,
                'description'    => $request->description,
                'timeline'       => $request->timeline,
                'user_id'        => $request->user_id,
                'assign_user_id' => Auth::id(),
                'priority'       => $request->priority,
                'project_id'     => $request->project_id,
                'status'         => 'pending'
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
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\TaskReview;
use Illuminate\Http\Request;

class TaskReviewController extends Controller
{
    public function create_review(Request $request)
    {
        try {
            $TaskReview = new TaskReview();
            $TaskReview->task_id = $request->task_id;
            $TaskReview->user_id = $request->user_id;
            $TaskReview->rating = $request->rating;
            $TaskReview->review = $request->review;
            $TaskReview->save();

            return response()->json(['success' => 1, 'message' => 'Task created successfully.', 'data' => $TaskReview], 200);
        } catch (\Throwable $th) {
            return response()->json(['success' => 0, 'message' => 'Internal server errors.'], 500);
        }
    }

    public function get_task_review(Request $request)
    {
        $TaskReview = TaskReview::whereUserId($request->user_id)->with('get_task')->get();
        return response()->json(['success' => 1, 'data' => $TaskReview], 200);
    }
}

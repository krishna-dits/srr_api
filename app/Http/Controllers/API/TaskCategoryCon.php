<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\TaskCategory;
use Illuminate\Http\Request;

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
}

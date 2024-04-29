<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\TaskCategory;
use Illuminate\Http\Request;

class TaskCategoryCon extends Controller
{
    public function get_task_category()
    {
        try {
            return TaskCategory::get();
            //code...
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function create_task_category(Request $request)
    {
    }
}

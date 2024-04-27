<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function add_task(Request $request)
    {

        if (Request()->isMethod('POST')) {

            $request->validate([
                'title'         => 'required',
                'description'   => 'required',
            ]);

            return view('task.add_task');
        }

        return view('task.add_task');
    }
}

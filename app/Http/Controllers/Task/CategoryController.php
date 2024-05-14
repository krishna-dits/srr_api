<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Models\TaskCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request, $id = null)
    {
        if ($id) {
            $category = TaskCategory::whereId($id)->first();
        } else {
            $category = null;
        }

        if (Request()->isMethod('POST')) {
            $request->validate([
                'name'      => 'required'
            ]);

            if ($id) {
                $category->update(['name' => $request->name]);
                return redirect()->back()->with('success', 'Category updated successfully.');
            } else {
                TaskCategory::create(['name' => $request->name]);
                return redirect()->back()->with('success', 'Category created successfully.');
            }
        }

        $data = TaskCategory::get();
        return view('task.create_task_category', compact('data', 'category'));
    }


    public function delete_category($id)
    {
        $category = TaskCategory::whereId($id)->first();

        if (empty($category)) {
            return redirect()->back()->with('message', 'Category not found.');
        }

        $category->delete();
    }
}

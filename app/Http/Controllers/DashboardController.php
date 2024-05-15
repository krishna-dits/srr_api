<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Task;
use App\Models\User;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $all_user = User::count();
        $yet_to_start_task = Task::whereStatus('Yet to start')->count();
        $in_progress_task = Task::whereStatus('In progress')->count();
        $completed_task = Task::whereStatus('Completed')->count();

        return view('appPages.dashboard', compact('all_user', 'yet_to_start_task', 'in_progress_task', 'completed_task'));
    }
}

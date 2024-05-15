<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\CoilMaster;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\GradeMaster;
use App\Models\IsMaster;
use App\Models\PoDoMaster;
use App\Models\SizeMaster;
use App\Models\Task;
use App\Models\TcMaster;
use App\Models\ThicknessMaster;
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

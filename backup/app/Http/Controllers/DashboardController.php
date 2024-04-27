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
use App\Models\TcMaster;
use App\Models\ThicknessMaster;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $all_customers = Customer::count();

        $is_no = IsMaster::count();
        $size_no = SizeMaster::count();
        $thickness_no = ThicknessMaster::count();
        $grade_no = GradeMaster::count();
        $podo_no = PoDoMaster::count();
        $coil_no = CoilMaster::count();
        $batch_no = Batch::count();
        $tc_no = TcMaster::count();

        return view('appPages.dashboard', compact('all_customers', 'size_no', 'is_no', 'thickness_no', 'grade_no', 'podo_no', 'coil_no', 'batch_no', 'tc_no'));
    }
}

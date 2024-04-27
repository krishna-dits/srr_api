<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Customer;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $all_customers = Customer::count();

        return view('appPages.dashboard', compact('all_customers'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\TcMaster;
use App\Models\Customer;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function batch_report()
    {
        $batch_report = Batch::all();

        return view('report.batch-report', compact('batch_report'));
    }

    public function show_batch_report(Request $request)
    {
        $all_search_data = $request->all();
        $request_type = $request->request_type;

        if ($request_type == 'all') {
            $batch_reports = Batch::all();
        } else {
            $batch_reports = Batch::where(function ($query) use ($request) {

                if ($request->batch_id != '') {
                    $query->where('batch_id', '=', $request->batch_id);
                }
                if ($request->is_name != '') {
                    $query->where('is_name', '=', $request->is_name);
                }
                if ($request->cus_id != '') {
                    $query->where('cus_id', '=', $request->cus_id);
                }
            })
                ->get();
        }
        $batch_report = Batch::all();

        return view('report.batch-report', compact('batch_reports', 'all_search_data', 'batch_report'));
    }

    public function tc_report()
    {
        $tc_report = TcMaster::all();
        $customer  = Customer::all();
        return view('report.tc-report', compact('tc_report', 'customer'));
    }

    public function show_tc_report(Request $request)
    {
        $all_search_data = $request->all();
        $request_type = $request->request_type;

        if ($request_type == 'all') {
            $tc_reports = TcMaster::all();
        } else {
            $tc_reports = TcMaster::where(function ($query) use ($request) {

                if ($request->is_no != '') {
                    $query->where('is_no', '=', $request->is_no);
                }
                if ($request->invoice_no != '') {
                    $query->where('invoice_no', '=', $request->invoice_no);
                }
                if ($request->tc_id != '') {
                    $query->where('tc_id', '=', $request->tc_id);
                }
                if ($request->cus_id != '') {
                    $query->where('company', '=', $request->cus_id);
                }
            })
                ->get();
        }
        $tc_report = TcMaster::all();
        $customer  = Customer::all();

        return view('report.tc-report', compact('tc_reports', 'all_search_data', 'tc_report', 'customer'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    public function get_leaves()
    {
        $leave = Leave::with('getUser')->get();
        return response()->json(['success' => 1, 'data' => $leave], 200, [], JSON_NUMERIC_CHECK);
    }

    public function save_leaves(Request $request)
    {
        $requestedData = (object)$request->all();
        $leave = new Leave();
        $leave->leave_type = $requestedData->leave_type;
        $leave->user_id = $requestedData->user_id;
        $leave->from_date = $requestedData->from_date;
        $leave->to_date = $requestedData->to_date;
        $leave->total_days = $requestedData->total_days;
        $leave->leave_desc = $requestedData->leave_desc;
        $leave->save();
        return response()->json(['success' => 1, 'data' => $leave], 200, [], JSON_NUMERIC_CHECK);
    }

    public function update_leave(Request $request)
    {
        $requestedData = (object)$request->all();
        $leave = Leave::find($requestedData->id);
        $leave->leave_type = $requestedData->leave_type;
        $leave->user_id = $requestedData->user_id;
        $leave->from_date = $requestedData->from_date;
        $leave->to_date = $requestedData->to_date;
        $leave->total_days = $requestedData->total_days;
        $leave->leave_desc = $requestedData->leave_desc;
        $leave->update();
        return response()->json(['success' => 1, 'data' => $leave], 200, [], JSON_NUMERIC_CHECK);
    }

    public function delete_leave($id)
    {
        $leave = Leave::find($id);
        $leave->delete();
        return response()->json(['success' => 1, 'data' => $leave], 200, [], JSON_NUMERIC_CHECK);
    }

    public function update_status($id, $status)
    {
        $leave = Leave::find($id);
        $leave->status = $status;
        $leave->update();
        return response()->json(['success' => 1, 'data' => $leave], 200, [], JSON_NUMERIC_CHECK);
    }

    public function user_wise_leave(Request $request)
    {
        $leave = Leave::whereUserId($request->user()->id)->get();
        return response()->json(['success' => 1, 'data' => $leave], 200, [], JSON_NUMERIC_CHECK);
    }

    public function user_wise_leave_with_id($id)
    {
        $leave = Leave::whereId($id)->whereUserId(Auth::id())->get();
        return response()->json(['success' => 1, 'data' => $leave], 200, [], JSON_NUMERIC_CHECK);
    }

    public function get_leave_report($user_id)
    {
        // $totalLeave = Leave::whereUserId($user_id)->groupby('')->sum('total_days');

        $totalLeave = Leave::whereUserId($user_id)->selectRaw('YEAR(from_date) as year, MONTH(from_date) as month, SUM(total_days) as total_days')
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        return response()->json(['success' => 1, 'data' => $totalLeave], 200, [], JSON_NUMERIC_CHECK);
    }
}

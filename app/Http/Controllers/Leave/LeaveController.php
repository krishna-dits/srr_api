<?php

namespace App\Http\Controllers\Leave;

use App\Http\Controllers\Controller;
use App\Models\Leave;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    public function apply_leave(Request $request)
    {
        if (Request()->isMethod('POST')) {

            $request->validate([
                'leave_type'        => "required|in:Annual Leave,Sick Leave,Maternity Leave,Paternity Leave, Unpaid Leave",
                'from_date'         => 'required|before_or_equal:to_date',
                'to_date'           => 'required|after_or_equal:from_date',
                'total_days'        => 'required|numeric',
                'leave_desc'        => 'required|max:2000',
            ]);


            $requestedData = (object)$request->all();
            $leave = new Leave();
            $leave->leave_type = $requestedData->leave_type;
            $leave->user_id = Auth::id();
            $leave->from_date = $requestedData->from_date;
            $leave->to_date = $requestedData->to_date;
            $leave->total_days = $requestedData->total_days;
            $leave->leave_desc = $requestedData->leave_desc;
            $leave->save();

            return redirect(route('my_leaves'))->with('success', 'Leave created successfully.');
        }

        return view('leave.create_update');
    }


    public function update_leave(Request $request, $id)
    {
        $leave = Leave::whereId($id)->first();
        if (empty($leave)) {
            return redirect()->back()->with('error', 'Leave not found.');
        }

        if (Request()->isMethod('POST')) {

            $request->validate([
                'leave_type'        => "required|in:Annual Leave,Sick Leave,Maternity Leave,Paternity Leave, Unpaid Leave",
                'from_date'         => 'required|before_or_equal:to_date',
                'to_date'           => 'required|after_or_equal:from_date',
                'total_days'        => 'required|numeric',
                'leave_desc'        => 'required|max:2000',
            ]);

            $requestedData = (object)$request->all();
            $leave->leave_type = $requestedData->leave_type;
            $leave->user_id = Auth::id();
            $leave->from_date = $requestedData->from_date;
            $leave->to_date = $requestedData->to_date;
            $leave->total_days = $requestedData->total_days;
            $leave->leave_desc = $requestedData->leave_desc;
            $leave->update();

            return redirect(route('my_leaves'))->with('success', 'Leave update successfully.');
        }

        return view('leave.create_update', compact('leave'));
    }


    public function my_leaves()
    {
        $leaves = Leave::whereUserId(Auth::id())->get();
        return view('leave.my_leave', compact('leaves'));
    }


    public function leave_status($id, $status)
    {
        $leave = Leave::whereId($id)->first();
        if (empty($leave)) {
            return response()->json(['success' => '0', 'message' => 'Leave not found.']);
        }

        $leave->status = $status;
        $leave->update();
        return response()->json(['success' => '1', 'message' => 'Leave status successfully.']);
    }


    public function all_leaves(Request $request)
    {
        $users = User::get();
        $leaves = Leave::with('getUser')->get();

        if (Request()->isMethod('POST')) {
            if ($request->status && $request->user) {
                $leaves = Leave::with('getUser')->whereUserId($request->user)->whereStatus($request->status)->get();
            } elseif (isset($request->status)) {
                $leaves = Leave::with('getUser')->whereStatus($request->status)->get();
            } elseif ($request->user) {
                $leaves = Leave::with('getUser')->whereUserId($request->user)->get();
            }
        }

        // dd($leaves->toArray());
        return view('leave.all_leave', compact('leaves', 'users', 'request'));
    }

    public function leaves_details($id)
    {
        $leave = Leave::whereId($id)->with('getUser')->first();
        if (empty($leave)) {
            return redirect()->back()->with('error', 'Leave not found.');
        }

        // dd($leave->toArray());
        return view('leave.details', compact('leave'));
    }
}

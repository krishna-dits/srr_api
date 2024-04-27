<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApplyLeaveResource;
use App\Models\ApplyLeave;
use App\Models\LeaveAllocation;
use Illuminate\Http\Request;

class ApplyLeaveController extends Controller
{
    public function get_leaves()
    {
        $leave = ApplyLeave::get();
        return response()->json(['success' => 1, 'data' =>ApplyLeaveResource::collection($leave)], 200, [], JSON_NUMERIC_CHECK);
    }

    public function get_leave_by_user(Request $request)
    {
        $leave = ApplyLeave::whereUserId($request->user()->id)->get();
        return response()->json(['success' => 1, 'data' =>ApplyLeaveResource::collection($leave)], 200, [], JSON_NUMERIC_CHECK);
    }

    public function save_leaves(Request $request)
    {
        $requestedData = (object)$request->json()->all();

        $leaveAllocation = LeaveAllocation::whereLeaveTypeId($requestedData->leave_type_id)
            ->whereUserId($requestedData->user_id ?? $request->user()->id)->first();
        if (!$leaveAllocation) {
            return response()->json(['success' => 0, 'data' => null, 'message' => 'Leave not allocated'], 200, [], JSON_NUMERIC_CHECK);
        }
        if ($leaveAllocation->total < $requestedData->total_days) {
            return response()->json(['success' => 0, 'data' => null, 'message' => 'Leave not available'], 200, [], JSON_NUMERIC_CHECK);
        }

        $leave = new ApplyLeave();
        $leave->user_id = $requestedData->user_id ?? $request->user()->id;
        $leave->leave_type_id = $requestedData->leave_type_id;
        $leave->from_date = $requestedData->from_date;
        $leave->to_date = $requestedData->to_date;
        $leave->total_days = $requestedData->total_days;
        $leave->status = $requestedData->status;
        $leave->applied_by = $request->user()->id ?? $requestedData->user_id;
        $leave->save();

        $leaveAllocation->total = $leaveAllocation->total - $requestedData->total_days;
        $leaveAllocation->save();

        return response()->json(['success' => 1, 'data' =>new ApplyLeaveResource($leave)], 200, [], JSON_NUMERIC_CHECK);
    }

    public function update_leaves(Request $request)
    {
        $requestedData = (object)$request->json()->all();

        $leaveAllocation = LeaveAllocation::whereLeaveTypeId($requestedData->leave_type_id)
            ->whereUserId($requestedData->user_id ?? $request->user()->id)->first();

        $leave = ApplyLeave::find($requestedData->id);
        $leave->leave_type_id = $requestedData->leave_type_id;
        $leave->from_date = $requestedData->from_date;
        $leave->to_date = $requestedData->to_date;

        if ($leave->total_days > $requestedData->total_days) {
            $remaining = $leave->total_days - $requestedData->total_days;
            $leaveAllocation->total += $remaining;
            $leaveAllocation->update();
        } else {
            $remaining = $requestedData->total_days - $leave->total_days;
            if ($leaveAllocation->total < $remaining) {
                return response()->json(['success' => 0, 'data' => null, 'message' => 'Leave not available'], 200, [], JSON_NUMERIC_CHECK);
            }
            $leaveAllocation->total -= $remaining;
            $leaveAllocation->update();
        }

        $leave->total_days = $requestedData->total_days;
        $leave->status = $requestedData->status;
        $leave->update();

        return response()->json(['success' => 1, 'data' =>new ApplyLeaveResource($leave)], 200, [], JSON_NUMERIC_CHECK);
    }

    public function delete_leaves($id)
    {
        $leave = ApplyLeave::find($id);
        $leave->delete();
        return response()->json(['success' => 1, 'data' =>new ApplyLeaveResource($leave)], 200, [], JSON_NUMERIC_CHECK);
    }


}

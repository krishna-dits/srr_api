<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\LeaveAllocation;
use Illuminate\Http\Request;

class LeaveAllocationController extends Controller
{
    public function get_leave_allocation(){
        $leaveAllocation = LeaveAllocation::get();
        return response()->json(['success'=>1, 'data'=>$leaveAllocation], 200,[],JSON_NUMERIC_CHECK);
    }

    public function save_leave_allocation(Request $request){
        $requestedData = (object)$request->json()->all();
        $leaveAllocation = new LeaveAllocation();
        $leaveAllocation->leave_type_id = $requestedData->leave_type_id;
        $leaveAllocation->total = $requestedData->total;
        $leaveAllocation->save();
        return response()->json(['success'=>1, 'data'=>$leaveAllocation], 200,[],JSON_NUMERIC_CHECK);
    }

    public function update_leave_allocation(Request $request){
        $requestedData = (object)$request->json()->all();
        $leaveAllocation = LeaveAllocation::find($requestedData->id);
        $leaveAllocation->leave_type_id = $requestedData->leave_type_id;
        $leaveAllocation->total = $requestedData->total;
        $leaveAllocation->update();
        return response()->json(['success'=>1, 'data'=>$leaveAllocation], 200,[],JSON_NUMERIC_CHECK);
    }

    public function delete_leave_allocation($id){
        $leaveAllocation = LeaveAllocation::find($id);
        $leaveAllocation->delete();
        return response()->json(['success'=>1, 'data'=>$leaveAllocation], 200,[],JSON_NUMERIC_CHECK);
    }
}

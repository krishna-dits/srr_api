<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\LeaveType;
use Illuminate\Http\Request;

class LeaveTypeController extends Controller
{
    public function get_leave_type(){
        $data = LeaveType::get();
        return response()->json(['success'=>1, 'data'=>$data], 200,[],JSON_NUMERIC_CHECK);
    }

    public function save_leave_type(Request $request){
        $requestedData = (object)$request->json()->all();
        $leaveType = new LeaveType();
        $leaveType->name = $requestedData->name;
        $leaveType->save();
        return response()->json(['success'=>1, 'data'=>$leaveType], 200,[],JSON_NUMERIC_CHECK);
    }

    public function update_leave_type(Request $request){
        $requestedData = (object)$request->json()->all();
        $leaveType = LeaveType::find($requestedData->id);
        $leaveType->name = $requestedData->name;
        $leaveType->update();
        return response()->json(['success'=>1, 'data'=>$leaveType], 200,[],JSON_NUMERIC_CHECK);
    }

    public function delete_leave_type($id){
        $leaveType = LeaveType::find($id);
        $leaveType->delete();
        return response()->json(['success'=>1, 'data'=>$leaveType], 200,[],JSON_NUMERIC_CHECK);
    }
}

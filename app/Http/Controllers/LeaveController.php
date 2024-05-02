<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    public function get_leaves(){
        $leave = Leave::get();
        return response()->json(['success'=>1,'data'=>$leave], 200,[],JSON_NUMERIC_CHECK);
    }

    public function save_leaves(Request $request){
        $requestedData = (object)$request->json()->all();
        $leave = new Leave();
        $leave->leave_type = $requestedData->leave_type;
        $leave->user_id = $requestedData->user_id;
        $leave->from_date = $requestedData->from_date;
        $leave->to_date = $requestedData->to_date;
        $leave->total_days = $requestedData->total_days;
        $leave->save();
        return response()->json(['success'=>1,'data'=>$leave], 200,[],JSON_NUMERIC_CHECK);
    }

    public function update_leave(Request $request){
        $requestedData = (object)$request->json()->all();
        $leave = Leave::find($requestedData->id);
        $leave->leave_type = $requestedData->leave_type;
        $leave->user_id = $requestedData->user_id;
        $leave->from_date = $requestedData->from_date;
        $leave->to_date = $requestedData->to_date;
        $leave->total_days = $requestedData->total_days;
        $leave->update();
        return response()->json(['success'=>1,'data'=>$leave], 200,[],JSON_NUMERIC_CHECK);
    }

    public function delete_leave($id){
        $leave = Leave::find($id);
        $leave->delete();
        return response()->json(['success'=>1,'data'=>$leave], 200,[],JSON_NUMERIC_CHECK);
    }

    public function update_status($id,$status){
        $leave = Leave::find($id);
        $leave->approved = $status;
        $leave->update();
        return response()->json(['success'=>1,'data'=>$leave], 200,[],JSON_NUMERIC_CHECK);
    }

    public function user_wise_leave(Request $request){
        $leave = Leave::whereUserId($request->user()->id)->get();
        return response()->json(['success'=>1,'data'=>$leave], 200,[],JSON_NUMERIC_CHECK);
    }

}

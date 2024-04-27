<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IsMaster;
use App\Models\GradeMaster;
use Illuminate\Support\Facades\DB;

class GradeMasterController extends Controller
{
    public function grade_master_Create(Request $request)
    {
        $is_number_list  = IsMaster::get();

        $last_number = GradeMaster::latest()->first();;
        $is_number = $last_number->grade_id;
        $originalString = $is_number;
        $numericPart = preg_replace('/[^0-9]/', '', $originalString);
        $is_numbers = intval($numericPart) + 1;
        $formattedNumber = str_pad($is_numbers, strlen($numericPart), '0', STR_PAD_LEFT);
        $GradeNumber = "G" . $is_numbers;

        return view('setup.grade-master.create-grade-master', compact('is_number_list', 'GradeNumber'));
    }

    public function grade_master_list()
    {
        $size_master  = GradeMaster::get();

        return view('setup.grade-master.grade-master-list', compact('size_master'));
    }

    public function grade_master_save(Request $request)
    {

        $request->validate([
            'grade_id' => "required|",
            'is_name' => 'required',
            'grade' => "required|",

        ]);

        try {

            DB::beginTransaction();
            // dd('hi');
            $master = new GradeMaster();
            $master->grade_id =  $request->grade_id;
            $master->is_name = $request->is_name;
            $master->grade = $request->grade;

            $master->save();
            DB::commit();
            return redirect()->route('GradeMasterList')->with('success', 'Grade Master Created Sucessfully');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('GradeMasterList')->with('error', $th->getMessage());
        }
    }

    public function grade_master_delete($id)
    {
        try {
            DB::beginTransaction();
            $u_id = base64_decode($id);
            $user = GradeMaster::find($u_id);
            $user->delete();
            DB::commit();
            return redirect()->route('GradeMasterList')->with('success', 'Grade Master Deleted Sucessfully');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('GradeMasterList')->with('error', $th->getMessage());
        }
    }

    public function grade_master_edit(Request $request, $id)
    {
        $u_id = base64_decode($id);
        $is_number_list  = IsMaster::get();
        $editThicknessMaster = GradeMaster::where('id', $u_id)->first();

        return view('setup.grade-master.edit-grade-master', compact('editThicknessMaster', 'is_number_list'));
    }

    public function grade_master_update(Request $request)
    {

        $request->validate([
            'grade_id' => "required|",
            'is_name' => 'required',
            'grade' => "required|",

        ]);
        try {

            DB::beginTransaction();

            $master = GradeMaster::where('id', $request->id)->first();
            $master->grade_id =  $request->grade_id;
            $master->is_name = $request->is_name;
            $master->grade = $request->grade;
            $master->save();

            DB::commit();

            return redirect()->route('GradeMasterList')->with('success', 'Grade Updated Sucessfully');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('GradeMasterList')->with('error', $th->getMessage());
        }
    }
}

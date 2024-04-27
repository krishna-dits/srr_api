<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\IsMaster;
use Validator;

class IsMasterController extends Controller
{
    public function is_master_Create(Request $request)
    {
        // dd('hi');
        $last_number =  IsMaster::latest()->first();
        $is_number = $last_number->is_name;
        $originalString =  $is_number;
        $numericPart = preg_replace('/[^0-9]/', '', $originalString);
        $is_number = $numericPart + 1;
        $IsName = "IS " . $is_number;

        // $last_number =  IsMaster::latest()->first();
        // $is_number = $last_number->is_name;
        // $originalString = $is_number;
        // $numericPart = preg_replace('/[^0-9]/', '', $originalString);
        // $is_numbers = intval($numericPart) + 1;
        // $formattedNumber = str_pad($is_numbers, strlen($numericPart), '0', STR_PAD_LEFT);
        // dd($is_numbers);
        // $IsName = "IS " . $is_number;

        return view('setup.is-master.create-is-master', compact('IsName'));
    }

    public function is_master_list()
    {
        $is_master  = IsMaster::get();
        return view('setup.is-master.is-master-list', compact('is_master'));
    }

    public function is_master_save(Request $request)
    {

        $request->validate([
            'is_name' => "required|",
            'year' => 'required',
            'cml_no' => "required|",
            'hp' => 'required',
            'type' => "required|",
            'yst' => 'required',
            'drift_exp' => "required|",
            'grade' => 'required',
        ]);

        try {

            DB::beginTransaction();
            // dd('hi');
            $master = new IsMaster();
            $master->is_name =  $request->is_name;
            $master->year = $request->year;
            $master->cml_no = $request->cml_no;
            $master->hp = $request->hp;
            $master->type = $request->type;
            $master->thickness = $request->thickness;
            $master->yst = $request->yst;
            $master->uniformity_test = $request->uniformity_test;
            $master->addition_test = $request->addition_test;
            $master->free_board_test = $request->free_board_test;
            $master->drift_exp = $request->drift_exp;
            $master->grade = $request->grade;
            $master->save();
            DB::commit();
            return redirect()->route('is-master-list')->with('success', 'Is Master Created Sucessfully');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('UserCreate')->with('error', $th->getMessage());
        }
    }

    public function is_master_delete($id)
    {
        try {
            DB::beginTransaction();
            $u_id = base64_decode($id);
            $user = IsMaster::find($u_id);
            $user->delete();
            DB::commit();
            return redirect()->route('is-master-list')->with('success', 'Is Master Deleted Sucessfully');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('is-master-list')->with('error', $th->getMessage());
        }
    }

    public function is_master_edit(Request $request, $id)
    {
        $u_id = base64_decode($id);

        $editIsMaster = IsMaster::where('id', $u_id)->first();

        return view('setup.is-master.edit-is-master', compact('editIsMaster'));
    }

    public function is_master_update(Request $request)
    {

        $request->validate([
            'is_name' => "required",
            'year' => 'required',
            'cml_no' => "required|",
            'hp' => 'required',
            'type' => "required|",
            'yst' => 'required',
            'drift_exp' => "required|",
            'grade' => 'required',
        ]);

        try {

            DB::beginTransaction();

            $master = IsMaster::where('id', $request->id)->first();
            // $last_number = IsMaster::latest();
            // $is_number = $last_number->is_name + 1;
            // $IsName = "IS " . $is_number;
            $master->is_name =  $request->is_name;
            $master->year = $request->year;
            $master->cml_no = $request->cml_no;
            $master->hp = $request->hp;
            $master->type = $request->type;
            $master->thickness = $request->thickness;
            $master->yst = $request->yst;
            $master->uniformity_test = $request->uniformity_test;
            $master->addition_test = $request->addition_test;
            $master->free_board_test = $request->free_board_test;
            $master->drift_exp = $request->drift_exp;
            $master->grade = $request->grade;
            $master->save();
            DB::commit();
            return redirect()->route('is-master-list')->with('success', 'Is Master Updated Sucessfully');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('is-master-list')->with('error', $th->getMessage());
        }
    }
}

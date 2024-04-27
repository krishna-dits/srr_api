<?php

namespace App\Http\Controllers;

use App\Models\GradeMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\IsMaster;
use App\Models\MaxMinLimit;

class MaxMinLimitController extends Controller
{
    public function max_min_limit_Create(Request $request)
    {
        $is_number_list  = IsMaster::get();
        $grade = GradeMaster::all();
        return view('setup.max-min-limit.create-max-min-limit',compact('is_number_list','grade'));
    }

    public function max_min_limit_list()
    {
        $size_master  = MaxMinLimit::get();

        return view('setup.max-min-limit.max-min-limit-list', compact('size_master'));
    }

    public function max_min_limit_save(Request $request)
    {
        // dd('hi');
        $request->validate([
            'is_name' => "required",
            'grade' => 'required',
            'c_max' => "required",
            'mn_max' => "required",
            'ph_max' => "required",
            'su_max' => "required",
            'ce_max' => "required",
            'yst_min' => "required",
            'uts' => "required",
            'elgn' => "required",
        ]);

        try {

            DB::beginTransaction();
            // dd('hi');
            $master = new MaxMinLimit();
            $master->is_name =  $request->is_name;
            $master->grade = $request->grade;
            $master->c_max = $request->c_max;
            $master->mn_max = $request->mn_max;
            $master->ph_max = $request->ph_max;
            $master->su_max = $request->su_max;
            $master->si_max = $request->si_max;
            $master->ce_max = $request->ce_max;
            $master->yst_min = $request->yst_min;
            $master->uts = $request->uts;
            $master->elgn = $request->elgn;
            $master->save();
            DB::commit();
            return redirect()->route('MaxMinLimitList')->with('success', 'Max Min Limit Created Sucessfully');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('MaxMinLimitList')->with('error', $th->getMessage());
        }
    }

    public function max_min_limit_delete($id)
    {
        try {
            DB::beginTransaction();
            $u_id = base64_decode($id);
            $user = MaxMinLimit::find($u_id);
            $user->delete();
            DB::commit();
            return redirect()->route('MaxMinLimitList')->with('success', 'Max Min Limit Deleted Sucessfully');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('MaxMinLimitList')->with('error', $th->getMessage());
        }
    }

    public function max_min_limit_edit(Request $request, $id)
    {
        $u_id = base64_decode($id);
        $is_number_list  = IsMaster::get();
        $grade = GradeMaster::all();
        $editLimit  = MaxMinLimit::where('id', $u_id)->first();

        return view('setup.max-min-limit.edit-max-min-limit', compact('editLimit','is_number_list','grade'));
    }

    public function max_min_limit_update(Request $request)
    {
        $request->validate([
            'is_name' => "required",
            'grade' => 'required',
            'c_max' => "required",
            'mn_max' => "required",
            'ph_max' => "required",
            'su_max' => "required",
            'ce_max' => "required",
            'yst_min' => "required",
            'uts' => "required",
            'elgn' => "required",
        ]);
        try {

            DB::beginTransaction();

            $master = MaxMinLimit::where('id', $request->id)->first();
            $master->is_name =  $request->is_name;
            $master->grade = $request->grade;
            $master->c_max = $request->c_max;
            $master->mn_max = $request->mn_max;
            $master->ph_max = $request->ph_max;
            $master->su_max = $request->su_max;
            $master->si_max = $request->si_max;
            $master->ce_max = $request->ce_max;
            $master->yst_min = $request->yst_min;
            $master->uts = $request->uts;
            $master->elgn = $request->elgn;
            $master->save();

            DB::commit();

            return redirect()->route('MaxMinLimitList')->with('success', 'Max Min Limit Updated Sucessfully');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('MaxMinLimitList')->with('error', $th->getMessage());
        }
    }
}

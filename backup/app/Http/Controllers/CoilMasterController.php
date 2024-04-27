<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\IsMaster;
use App\Models\CoilMaster;

class CoilMasterController extends Controller
{
    public function coil_master_Create(Request $request)
    {
        $is_number_list  = IsMaster::get();
        return view('setup.coil-master.create-coil-master', compact('is_number_list'));
    }

    public function coil_master_list()
    {
        $size_master  = CoilMaster::get();

        return view('setup.coil-master.coil-master-list', compact('size_master'));
    }

    public function coil_master_save(Request $request)
    {

        $request->validate([
            'coil_type' => "required",
            'indentification_no' => 'required',
            'carbon' => "required",
            'mangnese' => "required",
            'Phosphorus' => "required",
            'sulphur' => "required",
            'silicon' => "required",
            'carbon_equivalent' => "required",

        ]);

        try {

            DB::beginTransaction();

            // dd('hi');
            $last_number =  CoilMaster::latest()->first();
            $is_number = $last_number->coil_no;
            $originalString =  $is_number;
            $numericPart = preg_replace('/[^0-9]/', '', $originalString);
            $is_numbers = $numericPart + 1;
            $CoilNumber =  $request->coil_type . $is_numbers;

            $master = new CoilMaster();
            $master->coil_no = $CoilNumber;
            $master->coil_type =  $request->coil_type;
            $master->indentification_no = $request->indentification_no;
            $master->hit_no = $request->hit_no;
            $master->hit_no1 = $request->hit_no1;
            $master->hit_no2 = $request->hit_no2;
            $master->hit_no3 = $request->hit_no3;
            $master->hit_no4 = $request->hit_no4;
            $master->carbon = $request->carbon;
            $master->mangnese = $request->mangnese;
            $master->Phosphorus = $request->Phosphorus;
            $master->sulphur = $request->sulphur;
            $master->silicon = $request->silicon;
            $master->carbon_equivalent = $request->carbon_equivalent;

            $master->save();
            DB::commit();
            return redirect()->route('CoilMasterList')->with('success', 'Coil Master Created Sucessfully');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('CoilMasterList')->with('error', $th->getMessage());
        }
    }

    public function coil_master_delete($id)
    {
        try {
            DB::beginTransaction();
            $u_id = base64_decode($id);
            $user = CoilMaster::find($u_id);
            $user->delete();
            DB::commit();
            return redirect()->route('CoilMasterList')->with('success', 'Coil Master Deleted Sucessfully');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('CoilMasterList')->with('error', $th->getMessage());
        }
    }

    public function coil_master_edit(Request $request, $id)
    {
        $u_id = base64_decode($id);
        $is_number_list  = IsMaster::get();
        $editCoilMaster  = CoilMaster::where('id', $u_id)->first();

        return view('setup.coil-master.edit-coil-master', compact('editCoilMaster', 'is_number_list'));
    }

    public function coil_master_update(Request $request)
    {

        $request->validate([
            'coil_type' => "required",
            'indentification_no' => 'required',
            'carbon' => "required",
            'mangnese' => "required",
            'Phosphorus' => "required",
            'sulphur' => "required",
            'silicon' => "required",
            'carbon_equivalent' => "required",
        ]);
        try {

            DB::beginTransaction();

            $master = CoilMaster::where('id', $request->id)->first();
            $master->coil_type =  $request->coil_type;
            $master->indentification_no = $request->indentification_no;
            $master->hit_no = $request->hit_no;
            $master->hit_no1 = $request->hit_no1;
            $master->hit_no2 = $request->hit_no2;
            $master->hit_no3 = $request->hit_no3;
            $master->hit_no4 = $request->hit_no4;
            $master->carbon = $request->carbon;
            $master->mangnese = $request->mangnese;
            $master->Phosphorus = $request->Phosphorus;
            $master->sulphur = $request->sulphur;
            $master->silicon = $request->silicon;
            $master->carbon_equivalent = $request->carbon_equivalent;
            $master->save();

            DB::commit();

            return redirect()->route('CoilMasterList')->with('success', 'Coil Master Updated Sucessfully');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('CoilMasterList')->with('error', $th->getMessage());
        }
    }
}

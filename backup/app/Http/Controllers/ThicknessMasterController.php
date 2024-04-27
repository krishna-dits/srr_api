<?php

namespace App\Http\Controllers;

use App\Models\IsMaster;
use Illuminate\Http\Request;
use App\Models\ThicknessMaster;
use Illuminate\Support\Facades\DB;

class ThicknessMasterController extends Controller
{
    public function thickness_master_Create(Request $request)
    {
        $is_number_list  = IsMaster::get();

        $last_number =  ThicknessMaster::latest()->first();
        $is_number = $last_number->thickness_id;
        $originalString =  $is_number;
        $numericPart = preg_replace('/[^0-9]/', '', $originalString);
        $is_numbers = $numericPart + 1;
        $ThickNumber = "T" . $is_numbers;
        return view('setup.thickness-master.create-thickness-master', compact('is_number_list','ThickNumber'));
    }

    public function thickness_master_list()
    {
        $size_master  = ThicknessMaster::get();

        // $is_number_list  = $is_number->is_name;
       
        return view('setup.thickness-master.thickness-master-list', compact('size_master'));
    }

    public function thickness_master_save(Request $request)
    {

        $request->validate([
            'thickness_id' => "required|",
            'is_name' => 'required',
            'thik_value' => "required|",
            'thik_type' => 'required',
            'desire' => "required|",
        ]);

        try {

            DB::beginTransaction();
            // dd('hi');
            $master = new ThicknessMaster();
            $master->thickness_id =  $request->thickness_id;
            $master->is_name = $request->is_name;
            $master->thik_value = $request->thik_value;
            $master->thik_type = $request->thik_type;
            $master->desire = $request->desire;
            $master->save();
            DB::commit();
            return redirect()->route('ThicknessMasterList')->with('success', 'Thickness Master Created Sucessfully');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('ThicknessMasterList')->with('error', $th->getMessage());
        }
    }

    public function thickness_master_delete($id)
    {
        try {
            DB::beginTransaction();
            $u_id = base64_decode($id);
            $user = ThicknessMaster::find($u_id);
            $user->delete();
            DB::commit();
            return redirect()->route('ThicknessMasterList')->with('success', 'Thickness Master Deleted Sucessfully');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('ThicknessMasterList')->with('error', $th->getMessage());
        }
    }

    public function thickness_master_edit(Request $request, $id)
    {
        $u_id = base64_decode($id);
        $is_number_list  = IsMaster::get();
        $editThicknessMaster = ThicknessMaster::where('id', $u_id)->first();

        return view('setup.thickness-master.edit-thickness-master', compact('editThicknessMaster', 'is_number_list'));
    }

    public function thickness_master_update(Request $request)
    {

        $request->validate([
            'thickness_id' => "required|",
            'is_name' => 'required',
            'thik_value' => "required|",
            'thik_type' => 'required',
            'desire' => "required|",
        ]);
        try {

            DB::beginTransaction();

            $master = ThicknessMaster::where('id', $request->id)->first();
            $master->thickness_id =  $request->thickness_id;
            $master->is_name = $request->is_name;
            $master->thik_value = $request->thik_value;
            $master->thik_type = $request->thik_type;
            $master->desire = $request->desire;
            $master->save();

            DB::commit();

            return redirect()->route('ThicknessMasterList')->with('success', 'Thickness Updated Sucessfully');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('ThicknessMasterList')->with('error', $th->getMessage());
        }
    }
}

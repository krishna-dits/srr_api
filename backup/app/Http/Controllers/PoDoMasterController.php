<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\IsMaster;
use App\Models\GradeMaster;
use App\Models\PoDoMaster;

class PoDoMasterController extends Controller
{
    public function podo_master_Create(Request $request)
    {
        $is_number_list  = IsMaster::get();
        // $last_number =  PoDoMaster::latest()->first();
        // $is_number = $last_number->podo_id;
        // $originalString =  $is_number;
        // $numericPart = preg_replace('/[^0-9]/', '', $originalString);
        // $is_numbers = $numericPart + 1;
        // $PoDoNumber = "PD" . $is_numbers;

        $last_number =  PoDoMaster::latest()->first();
        $is_number = $last_number->podo_id;
        $originalString = $is_number;
        $numericPart = preg_replace('/[^0-9]/', '', $originalString);
        $is_numbers = intval($numericPart) + 1;
        $formattedNumber = str_pad($is_numbers, strlen($numericPart), '0', STR_PAD_LEFT);
        $PoDoNumber = "PD" . $is_numbers;

        return view('setup.podo-master.create-podo-master', compact('is_number_list','PoDoNumber'));
    }

    public function podo_master_list()
    {
        $size_master  = PoDoMaster::get();

        return view('setup.podo-master.podo-master-list', compact('size_master'));
    }

    public function podo_master_save(Request $request)
    {
        // dd('hi');
        $request->validate([
            'podo_id' => "required|",
            'type' => 'required',
            'init' => "required|",

        ]);

        try {

            DB::beginTransaction();
            // dd('hi');
            $master = new PoDoMaster();
            $master->podo_id =  $request->podo_id;
            $master->type = $request->type;
            $master->init = $request->init;
            $master->save();
            DB::commit();
            return redirect()->route('PoDoMasterList')->with('success', 'Po/Do Master Created Sucessfully');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('PoDoMasterList')->with('error', $th->getMessage());
        }
    }

    public function podo_master_delete($id)
    {
        try {
            DB::beginTransaction();
            $u_id = base64_decode($id);
            $user = PoDoMaster::find($u_id);
            $user->delete();
            DB::commit();
            return redirect()->route('PoDoMasterList')->with('success', 'PoDo Master Deleted Sucessfully');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('PoDoMasterList')->with('error', $th->getMessage());
        }
    }

    public function podo_master_edit(Request $request, $id)
    {
        $u_id = base64_decode($id);
        $is_number_list  = IsMaster::get();
        $editPoDoMaster = PoDoMaster::where('id', $u_id)->first();

        return view('setup.podo-master.edit-podo-master', compact('editPoDoMaster', 'is_number_list'));
    }

    public function podo_master_update(Request $request)
    {
        $request->validate([
            'podo_id' => "required|",
            'type' => 'required',
            'init' => "required|",

        ]);
        try {

            DB::beginTransaction();

            $master = PoDoMaster::where('id', $request->id)->first();
            $master->podo_id =  $request->podo_id;
            $master->type = $request->type;
            $master->init = $request->init;
            $master->save();

            DB::commit();

            return redirect()->route('PoDoMasterList')->with('success', 'Po/Do Updated Sucessfully');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('PoDoMasterList')->with('error', $th->getMessage());
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\IsMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\SizeMaster;

class SizeMasterController extends Controller
{
    public function size_master_Create(Request $request)
    {
        $is_number_list = IsMaster::all();

        $last_number = SizeMaster::latest()->first();
        $is_number = $last_number->size_id;
        $originalString = $is_number;
        $numericPart = preg_replace('/[^0-9]/', '', $originalString);
        $is_numbers = intval($numericPart) + 1;
        $formattedNumber = str_pad($is_numbers, strlen($numericPart), '0', STR_PAD_LEFT);
        $SizeNumber = "S" . $formattedNumber;
        return view('setup.size-master.create-size-master', compact('is_number_list', 'SizeNumber'));
    }

    public function get_desire(Request $request)
    {
        $data = IsMaster::where('is_name', $request->IsName)->first();
        return response()->json($data);
    }

    public function size_master_list()
    {
        $size_master  = SizeMaster::get();
        return view('setup.size-master.size-master-list', compact('size_master'));
    }

    public function size_master_save(Request $request)
    {

        $request->validate([
            'size_id' => "required|",
            'is_name' => 'required',
            'is_size' => "required|",
            'desier' => 'required',
            'is_size1' => "required|",
            'desier_size' => 'required',
        ]);

        try {

            DB::beginTransaction();
            // dd('hi');
            $master = new SizeMaster();
            $master->size_id =  $request->size_id;
            $master->is_name = $request->is_name;
            $master->is_size = $request->is_size;
            $master->is_size1 = $request->is_size1;
            $master->desier_size = $request->desier_size;
            $master->flattening = $request->flattening;
            $master->bend = $request->bend;
            $master->desier = $request->desier;
            $master->free_board_test = $request->free_board_test;
            $master->save();
            DB::commit();
            return redirect()->route('size-master-list')->with('success', 'Size Master Created Sucessfully');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('size-master-list')->with('error', $th->getMessage());
        }
    }

    public function size_master_delete($id)
    {
        try {
            DB::beginTransaction();
            $u_id = base64_decode($id);
            $user = SizeMaster::find($u_id);
            $user->delete();
            DB::commit();
            return redirect()->route('size-master-list')->with('success', 'Size Master Deleted Sucessfully');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('size-master-list')->with('error', $th->getMessage());
        }
    }

    public function size_master_edit(Request $request, $id)
    {
        $u_id = base64_decode($id);

        $editSizeMaster = SizeMaster::where('id', $u_id)->first();

        $is_number_list = IsMaster::all();
        return view('setup.size-master.edit-size-master', compact('editSizeMaster','is_number_list'));
    }

    public function size_master_update(Request $request)
    {

        $request->validate([
            'size_id' => "required|",
            'is_name' => 'required',
            'is_size' => "required|",
            'desier' => 'required',
            'is_size1' => "required|",
            'desier_size' => 'required',
        ]);
        try {

            DB::beginTransaction();

            $master = SizeMaster::where('id', $request->id)->first();
            $master->size_id =  $request->size_id;
            $master->is_name = $request->is_name;
            $master->is_size = $request->is_size;
            $master->is_size1 = $request->is_size1;
            $master->flattening = $request->flattening;
            $master->bend = $request->bend;
            $master->desier_size = $request->desier_size;
            $master->desier = $request->desier;
            $master->free_board_test = $request->free_board_test;
            $master->save();

            DB::commit();

            return redirect()->route('size-master-list')->with('success', 'Size Master Updated Sucessfully');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('size-master-list')->with('error', $th->getMessage());
        }
    }
}

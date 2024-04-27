<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\IsMaster;
use App\Models\Batch;
use App\Models\CoilMaster;
use App\Models\Year;
use App\Models\Month;
use App\Models\SizeMaster;
use App\Models\ThicknessMaster;

class BatchController extends Controller
{
    public function batch_Create(Request $request)
    {
        $is_number_list  = IsMaster::get();
        $coil_master     = CoilMaster::get();
        $size_master     = SizeMaster::get();
        $thickness       = ThicknessMaster::get();

        $last_number =  Batch::latest()->first();
        $is_number = $last_number->batch_id;
        $originalString =  $is_number;
        $numericPart = preg_replace('/[^0-9]/', '', $originalString);
        $is_numbers = $numericPart + 1;
        $BatchNumber = "B" . $is_numbers;

        return view('setup.batch.create-batch', compact('is_number_list', 'coil_master', 'size_master', 'thickness', 'BatchNumber'));
    }
    public function getCoilData(Request $request)
    {
        $selectedCoilNo = $request->input('coil_no');

    // Use Eloquent or Query Builder to fetch the data from your database based on $selectedCoilNo.
    $coilData = CoilMaster::where('coil_no', $selectedCoilNo)->first();

    return response()->json($coilData);
    }

    public function batch_list()
    {
        $batch_list  = Batch::get();

        return view('setup.batch.batch-list', compact('batch_list'));
    }

    public function get_month_and_year_by_date(Request $request)
    {
        $monthLetter  =  Month::where('month_id', $request->MonthId)->first();
        $yearLetter   =  Year::where('year', $request->YearValue)->first();

        return response()->json(array('monthLetter' => $monthLetter, 'yearLetter' => $yearLetter));
    }

    public function batch_save(Request $request)
    {

        // $request->validate([
        //     'batch_id' => "required",
        //     'batch_no' => 'required',
        //     'lot_no' => "required",
        //     'descriptation' => "required",
        //     'is_name' => "required",
        //     'shift' => "required",
        //     'mill_date' => "required",
        //     'coil_no' => "required",
        //     'size' => "required",
        //     'thickness' => "required",
        //     'quality' => "required",
        //     'zn1' => "required",
        //     'zn2' => "required",
        //     'yst1' => "required",
        //     'yst2' => "required",
        //     'uts1' => "required",
        //     'uts2' => "required",
        //     'elgn1' => "required",
        //     'elgn2' => "required",

        // ]);

        // try {

        //     DB::beginTransaction();

        $master = new Batch();
        $master->elgn2 =  $request->elgn2;
        $master->elgn1 = $request->elgn1;
        $master->uts2 = $request->uts2;
        $master->uts1 = $request->uts1;
        $master->yst2 = $request->yst2;
        $master->yst1 = $request->yst1;
        $master->zn2 = $request->zn2;
        $master->zn1 = $request->zn1;
        $master->quality = $request->quality;
        $master->thickness = $request->thickness;
        $master->size = $request->size;
        $master->coil_no = $request->coil_no;
        $master->hit_no = $request->hit_no;
        $master->hit_no1 = $request->hit_no1;
        $master->hit_no2 = $request->hit_no2;
        $master->hit_no3 = $request->hit_no3;
        $master->hit_no4 = $request->hit_no4;
        $master->mill_date = $request->mill_date;
        $master->shift = $request->shift;
        $master->is_name = $request->is_name;
        $master->descriptation = $request->descriptation;
        $master->lot_no = $request->lot_no;
        $master->batch_no = $request->batch_no;
        $master->batch_id = $request->batch_id;
        $master->pipe_type = $request->pipe_type;
        $master->save();

        DB::commit();
        return redirect()->route('BatchList')->with('success', 'Batch Enter Sucessfully');
        // } catch (\Throwable $th) {
        //     DB::rollback();
        //     return redirect()->route('BatchList')->with('error', $th->getMessage());
        // }
    }

    public function batch_delete($id)
    {
        try {
            DB::beginTransaction();
            $u_id = base64_decode($id);
            $user = Batch::find($u_id);
            $user->delete();
            DB::commit();
            return redirect()->route('BatchList')->with('success', 'Batch Deleted Sucessfully');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('BatchList')->with('error', $th->getMessage());
        }
    }

    public function batch_edit(Request $request, $id)
    {
        $u_id = base64_decode($id);
        $is_number_list  = IsMaster::get();
        $editBatch  = Batch::where('id', $u_id)->first();
        $coil_master     = CoilMaster::get();
        $size_master     = SizeMaster::get();
        $thickness       = ThicknessMaster::get();

        return view('setup.batch.edit-batch', compact('editBatch', 'is_number_list', 'coil_master', 'size_master', 'thickness'));
    }

    public function batch_update(Request $request)
    {

        // dd($request->all());
        $request->validate([
            'batch_id' => "required",
            'batch_no' => 'required',
            'lot_no' => "required",
            'descriptation' => "required",
            'is_name' => "required", 
            'shift' => "required",
            'mill_date' => "required",
            // 'coil_no ' => "required",
            // 'size' => "required",
            // 'thickness' => "required",
            'quality' => "required",
            // 'zn1' => "required",
            // 'zn2' => "required",
            // 'yst1' => "required",
            // 'yst2' => "required",
            // 'uts1' => "required",
            // 'uts2' => "required",
            // 'elgn1' => "required",
            // 'elgn2' => "required",

        ]);

        // try {

        // DB::beginTransaction();

        $master = Batch::where('id', $request->id)->first();
        $master->elgn2 =  $request->elgn2;
        $master->elgn1 = $request->elgn1;
        $master->uts2 = $request->uts2;
        $master->uts1 = $request->uts1;
        $master->yst2 = $request->yst2;
        $master->yst1 = $request->yst1;
        $master->zn2 = $request->zn2;
        $master->zn1 = $request->zn1;
        $master->quality = $request->quality;
        $master->thickness = $request->thickness;
        $master->size = $request->size;
        $master->coil_no = $request->coil_no;
        $master->hit_no = $request->hit_no;
        $master->mill_date = $request->mill_date;
        $master->shift = $request->shift;
        $master->is_name = $request->is_name;
        $master->descriptation = $request->descriptation;
        $master->lot_no = $request->lot_no;
        $master->batch_no = $request->batch_no;
        $master->batch_id = $request->batch_id;
        $master->pipe_type = $request->pipe_type;
        $master->hit_no1 = $request->hit_no1;
        $master->hit_no2 = $request->hit_no2;
        $master->hit_no3 = $request->hit_no3;
        $master->hit_no4 = $request->hit_no4;
        $master->save();

        // DB::commit();

        return redirect()->route('BatchList')->with('success', 'Batch Updated Sucessfully');
        // } catch (\Throwable $th) {
        //     DB::rollback();
        //     return redirect()->route('BatchList')->with('error', $th->getMessage());
        // }
    }
    public function getSizesByIsName(Request $request)
{
    $isName = $request->input('is_name');
    // Fetch sizes based on the selected Is Name from your SizeMaster model
    $sizes = SizeMaster::where('is_name', $isName)->get();

    return response()->json(['sizes' => $sizes]);
}

}

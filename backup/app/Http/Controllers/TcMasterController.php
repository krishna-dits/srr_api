<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IsMaster;
use App\Models\Batch;
use App\Models\CoilMaster;
use App\Models\Customer;
use App\Models\MaxMinLimit;
use App\Models\PoDoMaster;
use App\Models\SizeMaster;
use App\Models\TcDetail;
use App\Models\TcMaster;
use App\Models\ThicknessMaster;
use DB;
use PDF;


class TcMasterController extends Controller
{
    public function tc_master_Create(Request $request)
    {
        $is_number_list  = IsMaster::get();
        $coil_master     = CoilMaster::get();
        $size_master     = SizeMaster::get();
        $thickness       = ThicknessMaster::get();
        $init = PoDoMaster::get();
        $customer = Customer::all();

        $last_number =  TcMaster::latest()->first();
        $is_number = $last_number->tc_id;
        $originalString = $is_number;
        $numericPart = preg_replace('/[^0-9]/', '', $originalString);
        $is_numbers = intval($numericPart) + 1;
        $formattedNumber = str_pad($is_numbers, strlen($numericPart), '0', STR_PAD_LEFT);
        $TcNumber = "TC" . $formattedNumber;

        return view('setup.tc-master.create-tc-master', compact('is_number_list', 'coil_master', 'size_master', 'thickness', 'init', 'customer', 'TcNumber'));
    }

    public function tc_master_list()
    {
        $tc_list  = TcMaster::get();

        return view('setup.tc-master.tc-master-list', compact('tc_list'));
    }

    public function get_cml_no(Request $request)
    {
        $isMaster  = IsMaster::where('is_name', $request->IsName)->first();

        return response()->json($isMaster);
    }

    public function get_hp_no(Request $request)
    {
        $isMaster  = IsMaster::where('is_name', $request->IsName)->first();

        return response()->json($isMaster);
    }


    public function get_all_coil_details(Request $request)
    {
        // dd($request->CoilName);
        $coil_values  = CoilMaster::where('coil_no', $request->CoilName)->first();
        // dd($coil_values);

        return response()->json($coil_values);
    }

    public function get_all_batch_details(Request $request)
    {
        $batch_values  = Batch::where('batch_no', $request->BatchName)->first();

        return response()->json($batch_values);
    }

    public function get_all_is_master_details(Request $request)
    {
        $is_values  = IsMaster::where('is_name', $request->IsName)->first();
        // dd($is_values->is_name);
        $size = SizeMaster::where('is_name', $is_values->is_name)->first();
        $thick_values  = ThicknessMaster::where('is_name', $request->IsName)->get();
        return response()->json(['is_values' => $is_values, 'thick_values' => $thick_values, 'size' => $size]);
    }

    public function get_coform_is_year(Request $request)
    {
        $year  = IsMaster::where('is_name', $request->IsName)->first();

        return response()->json($year);
    }

    public function get_size_by_is_master(Request $request)
    {
        $isName  = IsMaster::where('is_name', $request->IsName)->first();
        $size = SizeMaster::where('is_name', $isName->is_name)->get();

        return response()->json($size);
    }

    public function get_customer_id_no(Request $request)
    {
        $customer  = Customer::where('id', $request->CustomerId)->first();

        return response()->json($customer);
    }

    public function tc_master_print(Request $request, $id)
    {
        $u_id = base64_decode($id);
        $tc_master  = TcMaster::where('id', $u_id)->first();
        $year  = IsMaster::where('is_name', $tc_master->is_no)->first();

        $tc_details  = TcDetail::where('tc_id',  $tc_master->tc_id)->get();
        
        // dd($tc_details);

        view()->share('tc_master', $tc_master);
        view()->share('year', $year);

        view()->share('tc_details', $tc_details);

        $pdf = PDF::loadView('setup.tc-master.print-tc-master');
        return $pdf->stream('print-tc-master.pdf');

        // return view('setup.tc-master.print-tc-master IS-12', compact('tc_details'));
    }

    public function get_all_tc_details(Request $request)
    {
        // dd($request->SizeName);
        $size =  SizeMaster::where('id', $request->SizeName)->first();

        $thickness  = IsMaster::where('is_masters.is_name', $size->is_name)
            ->join('thickness_masters', 'thickness_masters.is_name', '=', 'is_masters.is_name')
            ->get();
        // dd($thickness);
        $is_values = IsMaster::where('is_name', $size->is_name)->first();


        $lot_no  = IsMaster::where('is_masters.is_name', $size->is_name)
            ->join('batches', 'batches.is_name', '=', 'is_masters.is_name')
            ->get();
        //  dd($lot_no);
        $batch_no  = IsMaster::where('is_masters.is_name', $size->is_name)
            ->select('batches.batch_no', 'batches.descriptation')
            ->join('batches', 'batches.is_name', '=', 'is_masters.is_name')
            ->first();
        //  dd($batch_no);

        $coil_no  = IsMaster::where('is_masters.is_name', $size->is_name)
            ->join('batches', 'batches.is_name', '=', 'is_masters.is_name')
            ->first();

        // dd($coil_no);
        $grade_no  = IsMaster::where('is_masters.is_name', $size->is_name)
            ->join('grade_masters', 'grade_masters.is_name', '=', 'is_masters.is_name')
            ->get();
        // dd($grade_no);
        return response()->json(array('thickness' => $thickness, 'lot_no' => $lot_no, 'batch_no' => $batch_no, 'coil_no' => $coil_no, 'grade_no' => $grade_no, 'is_values' => $is_values, 'size' => $size));
    }

    public function tc_master_save(Request $request)
    {

        // $request->validate([
        //     'tc_id' => "required",
        //     'is_no' => "required",
        //     'product' => "required",
        //     'address1' => "required",
        //     'address2' => "required",
        //     'type' => "required",
        //     'podo_init' => "required",
        //     'podo_value' => "required",
        //     'conformToIs' => "required",
        //     'tc_no' => "required",
        //     'invoice_no' => "required",
        //     'podo_no' => "required",
        //     'unit' => "required",
        //     'date1' => "required",
        //     'date2' => "required",
        //     'date3' => "required",
        //     'cml_no' => "required",
        //     'hp' => "required",
        //     'vehicleno' => "required",
        //     'c_max' => "required",
        //     'mn_max' => "required",
        //     'ph_max' => "required",
        //     'su_max' => "required",
        //     'yst_min' => "required",
        //     'uts_min' => "required",
        //     'elgn_min' => "required",
        // ]);

        // $validatedData = $request->validate([

        // ]);

        // try {



        //     DB::beginTransaction();

        $max_details = MaxMinLimit::where('is_name', $request->is_no)->first();

        $master = new TcMaster();
        $master->tc_id =  $request->tc_id;
        $master->is_no =  $request->is_no;
        $master->product =  $request->product;
        $master->company =  $request->cust_name;
        $master->address1 =  $request->address1;
        $master->address2 =  $request->address2;
        $master->type =  $request->type;
        $master->part_no =  $request->part;
        $master->podo_init =  $request->podo_init;
        $master->podo_value =  $request->PO_value;
        $master->coating_thikness =  $request->coating_thikness;
        $master->conformToIs = $request->conform_to_is;
        $master->tc_no = $request->tc_no;
        $master->invoice_no = $request->invoice_no;
        $master->podo_no = $request->podo_no;
        $master->po_no = $request->po_no;
        $master->unit = $request->unit;
        $master->date1 = $request->date1;
        $master->date2 = $request->date2;
        $master->date3 = $request->date3;
        $master->cml_no = $request->cml_no;
        $master->hp = $request->ndt_hp;
        $master->vehicleno = $request->vehicle;
        $master->c_max =  $max_details->c_max;
        $master->mn_max =  $max_details->mn_max;
        $master->ph_max =  $max_details->ph_max;
        $master->su_max =  $max_details->su_max;
        $master->su_max =  $max_details->su_max;
        $master->si_max =  $max_details->si_max;
        $master->ce_max =  $max_details->ce_max;
        $master->yst_min = $max_details->yst_min;
        $master->uts_min = $max_details->uts;
        $master->elgn_min = $max_details->elgn;
        $master->save();

        foreach ($request->size as $key => $slno) {

            if (@$request->size[$key] != null) {
                $tc_details = new TcDetail();
                $tc_details->tc_id                       = $master->tc_id;
                $tc_details->sl_no                       = $request->sl_no[$key];
                $tc_details->batch_size                  = $request->size[$key];
                $tc_details->thikness                    = $request->thickness[$key];
                $tc_details->lot_no                      = $request->lot_no[$key];
                $tc_details->batch_no                    = $request->batch_no[$key];
                $tc_details->coil_no                     = $request->coil_no[$key];
                $tc_details->description                 = $request->description[$key];
                $tc_details->quantiy                     = $request->quantity[$key];
                $tc_details->grade                       = $request->grade[$key];
                $tc_details->c_per                       = $request->c_per[$key];
                $tc_details->mn_per                      = $request->mn_per[$key];
                $tc_details->p_per                       = $request->ph_per[$key];
                $tc_details->s_per                       = $request->su_per[$key];
                $tc_details->ce_per                      = $request->ce_per[$key];
                $tc_details->si_per                      = $request->si_per[$key];
                $tc_details->uts                         = $request->uts_per[$key];
                $tc_details->yst                         = $request->yst_per[$key];
                $tc_details->elgn                        = $request->elgn_per[$key];
                $tc_details->bend_test                   = $request->bend[$key];
                $tc_details->flt_test                   = $request->flt[$key];
                $tc_details->drift_expn                  = $request->drift[$key];
                $tc_details->massof_zn                   = $request->mass[$key];
                $tc_details->dip_test                    = $request->dip_test[$key];
                $tc_details->free_bore                   = $request->adh[$key];
                $tc_details->remarks                     = $request->remarks[$key];
                $tc_details->adh_test                   = $request->addition_test[$key];
                $tc_details->ends                       = $request->ends[$key];
                $status = $tc_details->save();
            }
        }


        // DB::commit();
        return redirect()->route('TcMasterList')->with('success', 'Tc Master Generate Sucessfully');
        // } catch (\Throwable $th) {
        //     DB::rollback();
        //     return redirect()->route('TcMasterList')->with('error', $th->getMessage());
        // }
    }

    public function tc_master_delete($id)
    {
        try {
            DB::beginTransaction();
            $u_id = base64_decode($id);
            $user = TcMaster::find($u_id);

            $details = TcDetail::where('tc_id', $user->tc_id)->delete();
            $user->delete();

            DB::commit();
            return redirect()->route('TcMasterList')->with('success', 'Tc Deleted Sucessfully');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('TcMasterList')->with('error', $th->getMessage());
        }
    }

    public function tc_master_edit(Request $request, $id)
    {
        $is_number_list  = IsMaster::get();
        $coil_master     = CoilMaster::get();
        $size_master     = SizeMaster::get();
        $thickness       = ThicknessMaster::get();
        $init            = PoDoMaster::get();
        $customer        = Customer::all();
        $u_id            = base64_decode($id);
        $edit_tc_master  = TcMaster::where('id', $u_id)->first();
        $edit_tc_detail  = TcDetail::where('tc_id', $edit_tc_master->tc_id)->get();
        //($edit_tc_detail);
        $size_master_idwise     = SizeMaster::where('is_name',$edit_tc_master->is_no)->get();


        //   dd($edit_tc_detail);

        return view('setup.tc-master.edit-tc-master', compact('is_number_list', 'coil_master', 'size_master', 'thickness', 'init', 'customer', 'edit_tc_master', 'edit_tc_detail','size_master_idwise'));
    }

    public function tc_master_update(Request $request)
    {

        // $request->validate([
        //     'tc_id' => "required",
        //     'is_no' => "required",
        //     'product' => "required",
        //     'address1' => "required",
        //     'address2' => "required",
        //     'type' => "required",
        //     'podo_init' => "required",
        //     'podo_value' => "required",
        //     'conformToIs' => "required",
        //     'tc_no' => "required",
        //     'invoice_no' => "required",
        //     'podo_no' => "required",
        //     'unit' => "required",
        //     'date1' => "required",
        //     'date2' => "required",
        //     'date3' => "required",
        //     'cml_no' => "required",
        //     'hp' => "required",
        //     'vehicleno' => "required",
        //     'c_max' => "required",
        //     'mn_max' => "required",
        //     'ph_max' => "required",
        //     'su_max' => "required",
        //     'yst_min' => "required",
        //     'uts_min' => "required",
        //     'elgn_min' => "required",
        // ]);
        // $validatedData = $request->validate([
        // ]);
        // try {
        //     DB::beginTransaction();

        $max_details = MaxMinLimit::where('is_name', $request->is_no)->first();

        $master = TcMaster::where('id', $request->id)->first();
        $master->tc_id =  $request->tc_id;
        $master->is_no =  $request->is_no;
        $master->product =  $request->product;
        $master->company =  $request->cust_name;
        $master->address1 =  $request->address1;
        $master->address2 =  $request->address2;
        $master->type =  $request->type;
        $master->part_no =  $request->part;
        $master->podo_init =  $request->podo_init;
        $master->coating_thikness =  $request->coating_thikness;
        $master->conformToIs = $request->conform_to_is;
        $master->tc_no = $request->tc_no;
        $master->invoice_no = $request->invoice_no;
        $master->podo_no = $request->podo_no;
        $master->po_no = $request->po_no;
        $master->unit = $request->unit;
        $master->date1 = $request->date1;
        $master->date2 = $request->date2;
        $master->date3 = $request->date3;
        $master->cml_no = $request->cml_no;
        $master->hp = $request->ndt_hp;
        $master->vehicleno = $request->vehicle;
        $master->c_max =  $max_details->c_max;
        $master->mn_max =  $max_details->mn_max;
        $master->ph_max =  $max_details->ph_max;
        $master->su_max =  $max_details->su_max;
        $master->su_max =  $max_details->su_max;
        $master->si_max =  $max_details->si_max;
        $master->ce_max =  $max_details->ce_max;
        $master->yst_min = $max_details->yst_min;
        $master->uts_min = $max_details->uts;
        $master->elgn_min = $max_details->elgn;
        $master->save();

        foreach ($request->sl_no as $key => $slno) {

            $tc_details = TcDetail::where('tc_id', $master->tc_id)->where('sl_no', $request->sl_no[$key])->first();
            $tc_details->tc_id                       = $master->tc_id;
            $tc_details->sl_no                       = $request->sl_no[$key];
            $tc_details->batch_size                  = $request->size[$key];
            $tc_details->thikness                    = $request->thickness[$key];
            $tc_details->lot_no                      = $request->lot_no[$key];
            $tc_details->batch_no                    = $request->batch_no[$key];
            $tc_details->coil_no                     = $request->coil_no[$key];
            $tc_details->description                 = $request->description[$key];
            $tc_details->quantiy                     = $request->quantity[$key];
            $tc_details->grade                       = $request->grade[$key];
            $tc_details->c_per                       = $request->c_per[$key];
            $tc_details->mn_per                      = $request->mn_per[$key];
            $tc_details->p_per                       = $request->ph_per[$key];
            $tc_details->s_per                       = $request->su_per[$key];
            $tc_details->ce_per                      = $request->ce_per[$key];
            $tc_details->si_per                      = $request->si_per[$key];
            $tc_details->uts                         = $request->uts_per[$key];
            $tc_details->yst                         = $request->yst_per[$key];
            $tc_details->elgn                        = $request->elgn_per[$key];
            $tc_details->bend_test                   = $request->bend[$key];
            $tc_details->flt_test                   = $request->flt[$key];
            $tc_details->drift_expn                  = $request->drift[$key];
            $tc_details->massof_zn                   = $request->mass[$key];
            $tc_details->dip_test                    = $request->dip_test[$key];
            $tc_details->free_bore                   = $request->adh[$key];
            $tc_details->adh_test                   = $request->addition_test[$key];
            $tc_details->remarks                     = $request->remarks[$key];
            $tc_details->ends                       = $request->ends[$key];
            $status = $tc_details->save();
        }


        // DB::commit();
        return redirect()->route('TcMasterList')->with('success', 'Tc Master Updated Sucessfully');
        // } catch (\Throwable $th) {
        //     DB::rollback();
        //     return redirect()->route('TcMasterList')->with('error', $th->getMessage());
        // }
    }
    // public function tc_master_update(Request $request)
    // {

    //     $request->validate([
    //         'batch_id' => "required",
    //         'batch_no' => 'required',
    //         'lot_no' => "required",
    //         'descriptation' => "required",
    //         'is_name' => "required",
    //         'shift' => "required",
    //         'mill_date' => "required",
    //         'coil_no' => "required",
    //         'size' => "required",
    //         'thickness' => "required",
    //         'quality' => "required",
    //         'zn1' => "required",
    //         'zn2' => "required",
    //         'yst1' => "required",
    //         'yst2' => "required",
    //         'uts1' => "required",
    //         'uts2' => "required",
    //         'elgn1' => "required",
    //         'elgn2' => "required",

    //     ]);

    //     try {

    //         DB::beginTransaction();

    //         $master = Batch::where('id', $request->id)->first();
    //         $master->elgn2 =  $request->elgn2;
    //         $master->elgn1 = $request->elgn1;
    //         $master->uts2 = $request->uts2;
    //         $master->uts1 = $request->uts1;
    //         $master->yst2 = $request->yst2;
    //         $master->yst1 = $request->yst1;
    //         $master->zn2 = $request->zn2;
    //         $master->zn1 = $request->zn1;
    //         $master->quality = $request->quality;
    //         $master->thickness = $request->thickness;
    //         $master->size = $request->size;
    //         $master->coil_no = $request->coil_no;
    //         $master->mill_date = $request->mill_date;
    //         $master->shift = $request->shift;
    //         $master->is_name = $request->is_name;
    //         $master->descriptation = $request->descriptation;
    //         $master->lot_no = $request->lot_no;
    //         $master->batch_no = $request->batch_no;
    //         $master->batch_id = $request->batch_id;
    //         $master->save();

    //         DB::commit();

    //         return redirect()->route('TcMasterList')->with('success', 'Batch Updated Sucessfully');
    //     } catch (\Throwable $th) {
    //         DB::rollback();
    //         return redirect()->route('TcMasterList')->with('error', $th->getMessage());
    //     }
    // }
}

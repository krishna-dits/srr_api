<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IsMaster;
use App\Models\Batch;
use App\Models\CoilMaster;
use App\Models\Customer;
use App\Models\GradeMaster;
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
    public function tc_master_Create_previous($id)
    {
        $u_id = base64_decode($id);
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


        $TcDetail=TcMaster::where('id',$u_id)->first();

        return view('setup.tc-master.create-tc-master-edit-view', compact('is_number_list', 'coil_master', 'size_master', 'thickness', 'init', 'customer', 'TcNumber','TcDetail'));


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
        $size_list = SizeMaster::where('is_name', $is_values->is_name)->get();
        $thick_values  = ThicknessMaster::where('is_name', $request->IsName)->get();
        return response()->json(['is_values' => $is_values, 'thick_values' => $thick_values, 'size' => $size, 'size_list' => $size_list]);
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
        $master->date4 = $request->date4;
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
        $id = $master->id;
        $encodedId = base64_encode($id);


        
        return redirect()->route('TcMasterDetailsSave', ['id' => $encodedId])->with('success', 'Tc Master Generate Successfully');
        
    }
    public function tc_master_Create_update(Request $request)
    {
        TcMaster::where('tc_id',$request->tc_id)->update(array('invoice_no'=>$request->invoice_no,'type'=>$request->type,'type'=>$request->type,'part_no'=>$request->part,'vehicleno'=>$request->vehicle,'product'=>$request->product,'podo_init'=>$request->podo_init,'unit'=>$request->unit,'cml_no'=>$request->cml_no,'company'=>$request->cust_name,'date1'=>$request->date1,'hp'=>$request->ndt_hp,'address1'=>$request->address1,'address2'=>$request->address2,'tc_no'=>$request->tc_no,'date2'=>$request->date2,'podo_no'=>$request->podo_no,'po_no'=>$request->po_no,'date3'=>$request->date3));
        return redirect()->back()->with('success', 'Data Updated successfully!');

    }
    public function tc_master_detail_save($id)
    {
        $TcmasterID = base64_decode($id);
        $TcMasterDetails= TcMaster::where('id',$TcmasterID)->first();
        $sizelist=SizeMaster::where('is_name',$TcMasterDetails->is_no)->get();
        $IsDetails=IsMaster::where('is_name',$TcMasterDetails->is_no)->first();
        $GradeMasterList=GradeMaster::where('is_name',$TcMasterDetails->is_no)->get();
        $ThicknessMasterlist=ThicknessMaster::where('is_name',$TcMasterDetails->is_no)->get();
        return view('setup.tc-master.Tc-details-form',compact('sizelist','ThicknessMasterlist','TcMasterDetails','IsDetails','GradeMasterList'));
    }
    // Add this method to your controller
    public function getLotNos(Request $request)
    {
        $selectedsize_id = $request->input('selectedsize');
        $sizeDetails = SizeMaster::where('id',$selectedsize_id)->first();
        //dd($thickness);
        $isNo = $request->input('is_no');
        //dd($isNo);

        // Use the values of $thickness and $isNo to fetch lot numbers from the database
        $lotNos = Batch::where('size', $sizeDetails->desier)
            ->where('is_name', $isNo)
            ->pluck('lot_no', 'lot_no');
            //dd($lotNos);
        $freeBoreTest = $sizeDetails->free_board_test;

        return response()->json([
        'lotNos' => $lotNos,
        'freeBoreTest' => $freeBoreTest,
    ]);
    }

    public function getBatchInfo(Request $request) {
    $lot_no = $request->input('lot_no');
    //dd($lot_no);
    $batch_detail=Batch::where('lot_no',$lot_no)->first();
    //dd($batch_detail->coil_no);
    $CoilMaster=CoilMaster::where('coil_no',$batch_detail->coil_no)->first();
    //dd($CoilMaster->carbon);


    // Use $lot_no to retrieve batch_no, description, and lot_no from your database

    $data = [
        'batch_no' => @$batch_detail->batch_no,
        'description' => @$batch_detail->descriptation,
        'coil_no' => @$batch_detail->coil_no,
        'zn' => @$batch_detail->zn1,
        'carbon' => @$CoilMaster->carbon,
        'mangnese' => @$CoilMaster->mangnese,
        'Phosphorus' => @$CoilMaster->Phosphorus,
        'sulphur' => @$CoilMaster->sulphur,
        'silicon' => @$CoilMaster->silicon,
        'carbon_equivalent' => @$CoilMaster->carbon_equivalent,
        'uts1' => @$batch_detail->uts1,
        'yst1' => @$batch_detail->yst1,
        'elgn1' => @$batch_detail->elgn1,
        'hit_no' => @$batch_detail->hit_no,
        'hit_no1' => @$batch_detail->hit_no1,
        'hit_no2' => @$batch_detail->hit_no2,
        'hit_no3' => @$batch_detail->hit_no3,
        'hit_no4' => @$batch_detail->hit_no4,
        'pipe_type' => @$batch_detail->pipe_type,
    ];

    return response()->json($data);
}

    public function getBendFlattening(Request $request)
    {
        $sizeId = $request->input('size_id');
        //dd($sizeId);

        $size = SizeMaster::find($sizeId); // Replace with your actual model name

        $data = [
        'bend' => @$size->bend,
        'flattening' => @$size->flattening,
    ];

    return response()->json($data);
    }
    public function Tcdetailsave(Request $request)
{
    // Loop through the form data and insert records for each set of input fields
    for ($i = 0; $i < count($request->input('batch_size')); $i++) {
        $batchSize = $request->input('batch_size')[$i];

        // Check if batch_size is not empty
        if (!empty($batchSize)) {
            $tcDetail = new TcDetail();
            $tcDetail->sl_no = $i;
            $tcDetail->tc_id = $request->input('tc_id');
            $tcDetail->batch_size = $batchSize;
            $tcDetail->thikness = $request->input('thickness')[$i];
            $tcDetail->lot_no = $request->input('lot_no')[$i];
            $tcDetail->batch_no = $request->input('batch_no')[$i];
            $tcDetail->coil_no = $request->input('coil_no')[$i];
            $tcDetail->description = $request->input('description')[$i];
            $tcDetail->quantiy = $request->input('quantity')[$i];
            $tcDetail->grade = $request->input('grade')[$i];
            $tcDetail->c_per = $request->input('c_per')[$i];
            $tcDetail->mn_per = $request->input('mn_per')[$i];
            $tcDetail->p_per = $request->input('ph_per')[$i];
            $tcDetail->s_per = $request->input('su_per')[$i];
            $tcDetail->ce_per = $request->input('ce_per')[$i];
            $tcDetail->uts = $request->input('uts_per')[$i];
            $tcDetail->yst = $request->input('yst_per')[$i];
            $tcDetail->elgn = $request->input('elgn_per')[$i];
            $tcDetail->bend_test = $request->input('bend')[$i];
            $tcDetail->flt_test = $request->input('flt')[$i];
            $tcDetail->drift_expn = $request->input('drift')[$i];
            $tcDetail->massof_zn = $request->input('mass')[$i];
            //$tcDetail->dip_test = $request->input('dip_test')[$i]; // Uncomment this line if needed
            $tcDetail->adh_test = $request->input('adh')[$i];
            $tcDetail->ends = $request->input('ends')[$i];
            $tcDetail->remarks = $request->input('remarks')[$i];
            $tcDetail->hitNo = $request->input('hitNo')[$i];
            $tcDetail->freeboretest = $request->input('freeboretest')[$i];
            $tcDetail->uniformitytest = $request->input('uniformitytest')[$i];
            $tcDetail->save();
        }
    }

    return redirect()->route('TcMasterList')->with('success', 'Data inserted successfully!');
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

    /*public function tc_master_edit(Request $request, $id)
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
    }*/
    public function tc_master_edit($id)
    {
        /******/
        $TcmasterID = base64_decode($id);
        $TcMasterDetails= TcMaster::where('id',$TcmasterID)->first();
        $sizelist=SizeMaster::where('is_name',$TcMasterDetails->is_no)->get();
        $IsDetails=IsMaster::where('is_name',$TcMasterDetails->is_no)->first();
        $GradeMasterList=GradeMaster::where('is_name',$TcMasterDetails->is_no)->get();
        $ThicknessMasterlist=ThicknessMaster::where('is_name',$TcMasterDetails->is_no)->get();
        $tcDetails=TcDetail::where('tc_id',$TcMasterDetails->tc_id)->get();
       
        return view('setup.tc-master.edit-tc-master', compact('sizelist','ThicknessMasterlist','TcMasterDetails','IsDetails','GradeMasterList','tcDetails'));
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

        /*foreach ($request->sl_no as $key => $slno) {

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
        }*/


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
    public function TcdetailUpdate(Request $request)
    {
        foreach ($request->input('batch_size') as $key => $batchSize) {
        $tcDetail = TcDetail::find($request->input('tcdetailValue')[$key]);


            $tcDetail->batch_size = $request->input('batch_size')[$key];
            $tcDetail->thikness = $request->input('thickness')[$key];
            if ($request->input('lot_no')[$key] !== null) {
                $tcDetail->lot_no = $request->input('lot_no')[$key];
            }
            $tcDetail->batch_no = $request->input('batch_no')[$key];
            $tcDetail->coil_no = $request->input('coil_no')[$key];
            $tcDetail->description = $request->input('description')[$key];
            $tcDetail->quantiy = $request->input('quantity')[$key];
            $tcDetail->grade = $request->input('grade')[$key];
            $tcDetail->c_per = $request->input('c_per')[$key];
            $tcDetail->mn_per = $request->input('mn_per')[$key];
            $tcDetail->p_per = $request->input('ph_per')[$key];
            $tcDetail->s_per = $request->input('su_per')[$key];
            $tcDetail->ce_per = $request->input('ce_per')[$key];
            $tcDetail->uts = $request->input('uts_per')[$key];
            $tcDetail->yst = $request->input('yst_per')[$key];
            $tcDetail->elgn = $request->input('elgn_per')[$key];
            $tcDetail->bend_test = $request->input('bend')[$key];
            $tcDetail->flt_test = $request->input('flt')[$key];
            $tcDetail->drift_expn = $request->input('drift')[$key];
            $tcDetail->massof_zn = $request->input('mass')[$key];
            //$tcDetail->dip_test = $request->input('dip_test')[$i]; // Uncomment this line if needed
            $tcDetail->adh_test = $request->input('adh')[$key];
            $tcDetail->ends = $request->input('ends')[$key];
            $tcDetail->remarks = $request->input('remarks')[$key];
            
            if ($request->input('hitNo')[$key] !== null) {
                $tcDetail->hitNo = $request->input('hitNo')[$key];
            }
            $tcDetail->freeboretest = $request->input('freeboretest')[$key];
            $tcDetail->uniformitytest = $request->input('uniformitytest')[$key];

    $tcDetail->save();
        }
        
        return redirect()->back()->with('success', 'TC Details updated successfully');

    }
    public function getGrades(Request $request)
    {
        $isName = $request->input('is_name');

        $grades = GradeMaster::where('is_name', $isName)->get(['grade_id', 'grade']);

        return response()->json($grades);
    }
}

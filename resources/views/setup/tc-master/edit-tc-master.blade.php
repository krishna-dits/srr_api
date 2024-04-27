@extends('layouts.layout')
@section('content')
<div class="container-fluid">
    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <!--div-->
        <div class="card">
            <div class="card-header">
                <div class="card-title">Edit Tc Master Details</div>
            </div>
            @if (session('success'))
            <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('success')}}</div>
            @endif
            @if (session()->has('error'))
            <div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('error')}}</div>
            @endif
            <!-- ------------------------------------------ -->
            <div class="row">
            <div class="col-md-12">
            <table style="width:95%; margin: 25px 0px 0px 28px !important;border: 1px solid #899499;border-collapse: collapse; background-color:#6cbc4f;margin-top:3px; ">
            <tr >
               <th
                  >
                  <span style="display:inline-block;line-height:10px;font-size: 12px;color:#000; margin-bottom:0px; text-align: justify; font-weight: 300; margin-top:20px;">
                  TC ID
                  </span>
                  <span  style="width:63%;display:inline-block;text-transform:uppercase;line-height:normal;text-indent:15px;font-size:12px;font-family:'Font Awesome 5 Free';font-style:normal;color:#000;font-weight:600;border-bottom:1px dashed #000;text-transform:uppercase;margin-bottom: 0px; text-align: justify;"> {{ @$TcMasterDetails->tc_id }}
                  </span>
               </th>
               <th
                  >
                  <span style="display:inline-block;line-height:10px;font-size: 12px;color:#000; margin-bottom: 0px; text-align: justify; font-weight: 300;margin-top:20px;">
                  Invoice No
                  </span>
                  <span  style="width:64%;display:inline-block;text-transform:uppercase;line-height:normal;text-indent:15px;font-size:12px;font-family:'Font Awesome 5 Free';font-style:normal;color:#000;font-weight:600;border-bottom:1px dashed #000;text-transform:uppercase;margin-bottom: 0px; text-align: justify;"> {{ @$TcMasterDetails->invoice_no }}
                  </span>
               </th>
               <th
                  >
                  <span style="display:inline-block;line-height:10px;font-size: 12px;color:#000; margin-bottom: 0px; text-align: justify; font-weight: 300;margin-top:20px;">
                  Type 
                  </span>
                  <span  style="width:64%;display:inline-block;text-transform:uppercase;line-height:normal;text-indent:15px;font-size:12px;font-family:'Font Awesome 5 Free';font-style:normal;color:#000;font-weight:600;border-bottom:1px dashed #000;text-transform:uppercase;margin-bottom: 0px; text-align: justify;"> {{ @$TcMasterDetails->type }}
                  </span>
               </th>
               <th
                  >
                  <span style="display:inline-block;line-height:10px;font-size: 12px;color:#000; margin-bottom: 0px; text-align: justify; font-weight: 300;margin-top:20px;">
                  Is No 
                  </span>
                  <span  style="width:64%;display:inline-block;text-transform:uppercase;line-height:normal;text-indent:15px;font-size:12px;font-family:'Font Awesome 5 Free';font-style:normal;color:#000;font-weight:600;border-bottom:1px dashed #000;text-transform:uppercase;margin-bottom: 0px; text-align: justify;"> {{ @$TcMasterDetails->is_no }}
                  </span>
               </th>
               <th
                  >
                  <span style="display:inline-block;line-height:10px;font-size: 12px;color:#000; margin-bottom: 0px; text-align: justify; font-weight: 300;margin-top:20px;">
                  Part 
                  </span>
                  <span  style="width:64%;display:inline-block;text-transform:uppercase;line-height:normal;text-indent:15px;font-size:12px;font-family:'Font Awesome 5 Free';font-style:normal;color:#000;font-weight:600;border-bottom:1px dashed #000;text-transform:uppercase;margin-bottom: 0px; text-align: justify;"> {{ @$TcMasterDetails->part_no }}
                  </span>
               </th>
            </tr>




            <tr >
               <th
                  >
                  <span style="display:inline-block;line-height:10px;font-size: 12px;color:#000; margin-bottom:0px; text-align: justify; font-weight: 300; margin-top:20px;">
                  Vehicle
                  </span>
                  <span  style="width:63%;display:inline-block;text-transform:uppercase;line-height:normal;text-indent:15px;font-size:12px;font-family:'Font Awesome 5 Free';font-style:normal;color:#000;font-weight:600;border-bottom:1px dashed #000;text-transform:uppercase;margin-bottom: 0px; text-align: justify;"> {{ @$TcMasterDetails->vehicleno }}
                  </span>
               </th>
               <th
                  >
                  <span style="display:inline-block;line-height:10px;font-size: 12px;color:#000; margin-bottom: 0px; text-align: justify; font-weight: 300;margin-top:20px;">
                  Product 
                  </span>
                  <span  style="width:64%;display:inline-block;text-transform:uppercase;line-height:normal;text-indent:15px;font-size:12px;font-family:'Font Awesome 5 Free';font-style:normal;color:#000;font-weight:600;border-bottom:1px dashed #000;text-transform:uppercase;margin-bottom: 0px; text-align: justify;"> {{ @$TcMasterDetails->product }}
                  </span>
               </th>
               <th
                  >
                  <span style="display:inline-block;line-height:10px;font-size: 12px;color:#000; margin-bottom: 0px; text-align: justify; font-weight: 300;margin-top:20px;">
                  Po/Do Init 
                  </span>
                  <span  style="width:80%;display:inline-block;text-transform:uppercase;line-height:normal;text-indent:15px;font-size:12px;font-family:'Font Awesome 5 Free';font-style:normal;color:#000;font-weight:600;border-bottom:1px dashed #000;text-transform:uppercase;margin-bottom: 0px; text-align: justify;"> {{ @$TcMasterDetails->podo_init }}
                  </span>
               </th>
               <th
                  >
                  <span style="display:inline-block;line-height:10px;font-size: 12px;color:#000; margin-bottom: 0px; text-align: justify; font-weight: 300;margin-top:20px;">
                  Unit 
                  </span>
                  <span  style="width:30%;display:inline-block;text-transform:uppercase;line-height:normal;text-indent:15px;font-size:12px;font-family:'Font Awesome 5 Free';font-style:normal;color:#000;font-weight:600;border-bottom:1px dashed #000;text-transform:uppercase;margin-bottom: 0px; text-align: justify;"> {{ @$TcMasterDetails->unit }}
                  </span>
               </th>
               <th
                  >
                  <span style="display:inline-block;line-height:10px;font-size: 12px;color:#000; margin-bottom: 0px; text-align: justify; font-weight: 300;margin-top:20px;">
                  CM/L No 
                  </span>
                  <span  style="width:64%;display:inline-block;text-transform:uppercase;line-height:normal;text-indent:15px;font-size:12px;font-family:'Font Awesome 5 Free';font-style:normal;color:#000;font-weight:600;border-bottom:1px dashed #000;text-transform:uppercase;margin-bottom: 0px; text-align: justify;"> {{ @$TcMasterDetails->cml_no }}
                  </span>
               </th>
            </tr>



            <tr >
               <th
                  >
                  <span style="display:inline-block;line-height:10px;font-size: 12px;color:#000; margin-bottom:0px; text-align: justify; font-weight: 300; margin-top:20px;">
                  Cust
                  </span>
                  <span  style="width:63%;display:inline-block;text-transform:uppercase;line-height:normal;text-indent:15px;font-size:12px;font-family:'Font Awesome 5 Free';font-style:normal;color:#000;font-weight:600;border-bottom:1px dashed #000;text-transform:uppercase;margin-bottom: 0px; text-align: justify;"> {{ @$TcMasterDetails->cast_details->cus_name }}
                  </span>
               </th>
               <th
                  >
                  <span style="display:inline-block;line-height:10px;font-size: 12px;color:#000; margin-bottom: 0px; text-align: justify; font-weight: 300;margin-top:20px;">
                  Date 
                  </span>
                  <span  style="width:64%;display:inline-block;text-transform:uppercase;line-height:normal;text-indent:15px;font-size:12px;font-family:'Font Awesome 5 Free';font-style:normal;color:#000;font-weight:600;border-bottom:1px dashed #000;text-transform:uppercase;margin-bottom: 0px; text-align: justify;"> {{ @$TcMasterDetails->date1 }}
                  </span>
               </th>
               <th
                  >
                  <span style="display:inline-block;line-height:10px;font-size: 12px;color:#000; margin-bottom: 0px; text-align: justify; font-weight: 300;margin-top:20px;">
                  NDT/HP
                  </span>
                  <span  style="width:64%;display:inline-block;text-transform:uppercase;line-height:normal;text-indent:15px;font-size:12px;font-family:'Font Awesome 5 Free';font-style:normal;color:#000;font-weight:600;border-bottom:1px dashed #000;text-transform:uppercase;margin-bottom: 0px; text-align: justify;"> {{ @$TcMasterDetails->hp }}
                  </span>
               </th>
               <!-- <th
                  >
                  <span style="display:inline-block;line-height:10px;font-size: 12px;color:#000; margin-bottom: 0px; text-align: justify; font-weight: 300;margin-top:20px;">
                  Address 
                  </span>
                  <span  style="width:64%;display:inline-block;text-transform:uppercase;line-height:normal;text-indent:15px;font-size:12px;font-family:'Font Awesome 5 Free';font-style:normal;color:#000;font-weight:600;border-bottom:1px dashed #000;text-transform:uppercase;margin-bottom: 0px; text-align: justify;"> {{ @$TcMasterDetails->address1 }}, {{ @$TcMasterDetails->address2 }}
                  </span>
               </th> -->
               <th
                  >
                  <span style="display:inline-block;line-height:10px;font-size: 12px;color:#000; margin-bottom: 0px; text-align: justify; font-weight: 300;margin-top:20px;">
                  TC No
                  </span>
                  <span  style="width:64%;display:inline-block;text-transform:uppercase;line-height:normal;text-indent:15px;font-size:12px;font-family:'Font Awesome 5 Free';font-style:normal;color:#000;font-weight:600;border-bottom:1px dashed #000;text-transform:uppercase;margin-bottom: 0px; text-align: justify;"> {{ @$TcMasterDetails->tc_no }}
                  </span>
               </th>
            </tr>


            <tr >
               <th
                  >
                  <span style="display:inline-block;line-height:10px;font-size: 12px;color:#000; margin-bottom:0px; text-align: justify; font-weight: 300; margin-top:20px;">
                  Date
                  </span>
                  <span  style="width:63%;display:inline-block;text-transform:uppercase;line-height:normal;text-indent:15px;font-size:12px;font-family:'Font Awesome 5 Free';font-style:normal;color:#000;font-weight:600;border-bottom:1px dashed #000;text-transform:uppercase;margin-bottom: 0px; text-align: justify;"> {{ @$TcMasterDetails->date2 }}
                  </span>
               </th>
               <th
                  >
                  <span style="display:inline-block;line-height:10px;font-size: 12px;color:#000; margin-bottom: 0px; text-align: justify; font-weight: 300;margin-top:20px;">
                  DO No 
                  </span>
                  <span  style="width:64%;display:inline-block;text-transform:uppercase;line-height:normal;text-indent:15px;font-size:12px;font-family:'Font Awesome 5 Free';font-style:normal;color:#000;font-weight:600;border-bottom:1px dashed #000;text-transform:uppercase;margin-bottom: 0px; text-align: justify;"> {{ @$TcMasterDetails->podo_no }}
                  </span>
               </th>
               <th
                  >
                  <span style="display:inline-block;line-height:10px;font-size: 12px;color:#000; margin-bottom: 0px; text-align: justify; font-weight: 300;margin-top:20px;">
                 PO No
                  </span>
                  <span  style="width:64%;display:inline-block;text-transform:uppercase;line-height:normal;text-indent:15px;font-size:12px;font-family:'Font Awesome 5 Free';font-style:normal;color:#000;font-weight:600;border-bottom:1px dashed #000;text-transform:uppercase;margin-bottom: 0px; text-align: justify;"> {{ @$TcMasterDetails->po_no }}
                  </span>
               </th>
               <th
                  >
                  <span style="display:inline-block;line-height:10px;font-size: 12px;color:#000; margin-bottom: 0px; text-align: justify; font-weight: 300;margin-top:20px;">
                  Date 
                  </span>
                  <span  style="width:64%;display:inline-block;text-transform:uppercase;line-height:normal;text-indent:15px;font-size:12px;font-family:'Font Awesome 5 Free';font-style:normal;color:#000;font-weight:600;border-bottom:1px dashed #000;text-transform:uppercase;margin-bottom: 0px; text-align: justify;"> {{ @$TcMasterDetails->date3 }}
                  </span>
               </th>
               <th
                  >
                  
               </th>
            </tr>
            
           
         </table>
         </div>
     </div>
         <!-- ------------------------------------------------ -->
            <div class="card-body">
                <div class="">

                    <form class="row g-3" method="POST" action="{{route('TcdetailUpdate')}}">
                        @csrf
                        <input type="hidden" name="is_no" value="{{@$TcMasterDetails->is_no}}">
                        <input type="hidden" name="tc_id" value="{{@$TcMasterDetails->tc_id}}">

                        
                        @foreach($tcDetails as $tcd)
                        <input type="hidden" name="tcdetailValue[]" value="{{$tcd->id}}">
                            <div class="col-md-12 mt-2 addborder">
                                 <div class="newdesign">
                                    <span>{{$loop->iteration}}</span>
                                </div>
                                <div class="form-row">
                                <div class="form-group col-md-2 mb-0">
                                    <div class="form-group">
                                        <label class="form-label">Size<span class="text-danger">*</span></label>
                                        <select class="form-control select2-show-search select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="batch_size[]" id="batch_size{{$loop->iteration}}">
                                                    <option value="">--Select Size--</option>
                                                    @foreach($sizelist as $list)
                                                    <option value="{{$list->id}}" @if($tcd->batch_size == $list->id) selected @endif>{{$list->desier}}</option>
                                                    @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-1 mb-0 thicknesswithLight{{$loop->iteration}}" style="display: none;">
                                    <div class="form-group">
                                        <label class="form-label">Thickness<span class="text-danger">*</span></label>
                                        <select class="form-control select2-show-search select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="thickness[]" id="thickness{{$loop->iteration}}" value="{{ old('thickness') }}">
                                                    <option value="">--Select--</option>
                                                    @foreach($ThicknessMasterlist as $list)
                                                    <option value="{{$list->desire}}" @if($tcd->thikness == $list->desire) selected @endif>{{$list->desire}}</option>
                                                    @endforeach

                                                </select>
                                    </div>
                                </div>

                                <div class="form-group col-md-1 mb-0 thicknesswithoutLight{{$loop->iteration}}" style="display: none;">
                                    <div class="form-group">
                                        <label class="form-label">Thickness<span class="text-danger">*</span></label>
                                        <select class="form-control select2-show-search select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="thickness[]" id="thickness{{$loop->iteration}}" value="{{ old('thickness') }}">
                                                    <option value="">--Select--</option>
                                                    @foreach($ThicknessMasterlist as $list)
                                                    @if($list->desire != "LIGHT")

                                                    <option value="{{$list->desire}}" @if($tcd->thikness == $list->desire) selected @endif>{{$list->desire}}</option>
                                                    @endif
                                                    @endforeach

                                                </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-1 mb-0">
                                    <div class="form-group">
                                        <label class="form-label">Lot No: <font color="blue">{{$tcd->lot_no}}</font><span class="text-danger">*</span></label>
                                        <select class="form-control select2-show-search select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="lot_no[]" id="lot_no{{$loop->iteration}}" value="{{ old('lot_no') }}">
                                        <option value="{{$tcd->lot_no}}" selected></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-2 mb-0">
                                    <div class="form-group">
                                        <label class="form-label">Batch No<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="batch_no[]" id="batch_no{{$loop->iteration}}" value="{{ old('batch_no') }}" placeholder="Enter Batch No" />
                                    </div>
                                </div>
                                <div class="form-group col-md-1 mb-0">
                                    <div class="form-group">
                                        <label class="form-label">Coil No<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="coil_no[]" id="coil_no{{$loop->iteration}}" value="{{ old('coil_no') }}" placeholder="Enter Coil No" />
                                    </div>
                                </div>
                                <div class="form-group col-md-2 mb-0">
                                    <div class="form-group">
                                        <label class="form-label">Description<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="description[]" id="description{{$loop->iteration}}" value="{{ old('description') }}" placeholder="Enter Description" />
                                    </div>
                                </div>
                                <div class="form-group col-md-1 mb-0">
                                    <div class="form-group">
                                        <label class="form-label">Quantity<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="quantity[]" id="quantity{{$loop->iteration}}" value="{{@$tcd->quantiy}}" placeholder="Enter Quantity" />
                                    </div>
                                </div>
                                <div class="form-group col-md-1 mb-0">
                                    <div class="form-group">
                                        <label class="form-label">Unit<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" value="{{ @$TcMasterDetails->unit }}" placeholder="Enter Coil No" readonly />
                                    </div>
                                </div>
                                <div class="form-group col-md-1 mb-0">
                                    <div class="form-group">
                                        <label class="form-label">Grade<span class="text-danger">*</span></label>
                                        <input type="text" name="grade[]" class="form-control" value="{{ @$TcMasterDetails->tc_grade }}" placeholder="Enter Grade" readonly />
                                    </div>
                                </div>

                                <!-- <div class="form-group col-md-1 mb-0">
                                    <div class="form-group">
                                        <label class="form-label">Grade<span class="text-danger">*</span></label>
                                        <select class="form-control select2-show-search select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="grade[]" id="grade{{$loop->iteration}}" value="{{ old('grade') }}">
                                                    <option value="">Select</option>
                                                    @foreach($GradeMasterList as $list)
                                                    <option value="{{@$list->grade}}"  @if($tcd->grade == $list->grade) selected @endif>{{@$list->grade}}</option>
                                                    @endforeach

                                                </select>
                                    </div>
                                </div> -->
                                <div class="form-group col-md-1 mb-0">
                                    <div class="form-group newadd">
                                        <label class="form-label">C%<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="c_per[]" id="c_per{{$loop->iteration}}" value="" />
                                    </div>
                                </div>

                                <div class="form-group col-md-1 mb-0">
                                    <div class="form-group newadd">
                                        <label class="form-label">MN%<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="mn_per[]" id="mn_per{{$loop->iteration}}" value="" />
                                    </div>
                                </div>

                                <div class="form-group col-md-1 mb-0">
                                    <div class="form-group newadd">
                                        <label class="form-label">P%<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="ph_per[]" id="ph_per{{$loop->iteration}}" value="" />
                                    </div>
                                </div>

                                <div class="form-group col-md-1 mb-0">
                                    <div class="form-group newadd">
                                        <label class="form-label">S%<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="su_per[]" id="su_per{{$loop->iteration}}" value="" />
                                    </div>
                                </div>

                                <!-- <div class="form-group col-md-1 mb-0">
                                    <div class="form-group newadd">
                                        <label class="form-label">SI%<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="si_per[]" id="si_per{{$loop->iteration}}" value="" />
                                    </div>
                                </div> -->

                                <div class="form-group col-md-1 mb-0">
                                    <div class="form-group newadd">
                                        <label class="form-label">CE%<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="ce_per[]" id="ce_per{{$loop->iteration}}" value="" />
                                    </div>
                                </div>
                                <div class="form-group col-md-1 mb-0">
                                    <div class="form-group newadd">
                                        <label class="form-label">UTS%<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="uts_per[]" id="uts_per{{$loop->iteration}}" value="" />
                                    </div>
                                </div>

                                <div class="form-group col-md-1 mb-0">
                                    <div class="form-group newadd">
                                        <label class="form-label">YST%<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="yst_per[]" id="yst_per{{$loop->iteration}}" value="" />
                                    </div>
                                </div>

                                <div class="form-group col-md-1 mb-0">
                                    <div class="form-group newadd">
                                        <label class="form-label">ELGN%<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="elgn_per[]" id="elgn_per{{$loop->iteration}}" value="" />
                                    </div>
                                </div>

                                <div class="form-group col-md-1 mb-0">
                                    <div class="form-group newadd">
                                        <label class="form-label">FLT Test<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="flt[]" id="flt{{$loop->iteration}}" value="" />
                                    </div>
                                </div>

                                <div class="form-group col-md-1 mb-0">
                                    <div class="form-group newadd">
                                        <label class="form-label">Bend Test<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="bend[]" id="bend{{$loop->iteration}}" value="" />
                                    </div>
                                </div>

                                <div class="form-group col-md-1 mb-0">
                                    <div class="form-group newadd">
                                        <label class="form-label">Drift Exp<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="drift_expn[]" id="drift{{$loop->iteration}}" value="{{ @$tcd->drift_expn}}" readonly />
                                    </div>
                                </div>

                                <div class="form-group col-md-1 mb-0">
                                    <div class="form-group newadd1">
                                        <label class="form-label">Mass OF Zn<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="mass[]" id="mass{{$loop->iteration}}" value="" />
                                    </div>
                                </div>

                                <!-- <div class="form-group col-md-2 mb-0">
                                    <div class="form-group">
                                        <label class="form-label">Dip Test<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="dip_test[]" id="dip_test{{$loop->iteration}}" value="" />
                                    </div>
                                </div> -->

                                <div class="form-group col-md-2 mb-0">
                                    <div class="form-group newadd1">
                                        <label class="form-label">Adhesion Test<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="adh[]" id="adh{{$loop->iteration}}" />
                                    </div>
                                </div>

                                <div class="form-group col-md-2 mb-0">
                                    <div class="form-group newadd1">
                                        <label class="form-label">Free Bore Test<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="freeboretest[]" id="freeboretest{{$loop->iteration}}" />
                                    </div>
                                </div>

                                <div class="form-group col-md-2 mb-0">
                                    <div class="form-group newadd1">
                                        <label class="form-label">Uniformity Test<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="uniformitytest[]" id="uniformitytest{{$loop->iteration}}" />
                                    </div>
                                </div>

                                <div class="form-group col-md-2 mb-0">
                                    <div class="form-group newadd1">
                                        <label class="form-label">Ends<span class="text-danger">*</span></label>
                                        <select class="form-control select2-show-search select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="ends[]" id="ends{{$loop->iteration}}">
                                                    <option value="">Select</option>
                                                    @foreach (Config::get('static.Ends') as $lang => $end)
                                                    <option value="{{ $end }}"  @if($tcd->ends == $end) selected @endif> {{ $end }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                    </div>
                                </div>

                                <div class="form-group col-md-2 mb-0">
                                    <div class="form-group newadd1">
                                        <label class="form-label">Hit No: <font color="blue">{{$tcd->hitNo}}</font><span class="text-danger">*</span></label>
                                        <select class="form-control select2-show-search select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="hitNo[]" id="hitNo{{$loop->iteration}}">
                                                    <option value="">Select</option>
                                                </select>
                                    </div>
                                </div>

                                <div class="form-group col-md-2 mb-0">
                                    <div class="form-group newadd1">
                                        <label class="form-label">Remarks<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="remarks[]" id="remarks{{$loop->iteration}}" value="{{@$tcd->remarks}}" />
                                    </div>
                                </div>
                                            
                                </div>
                            </div>

                           @endforeach
                            
                            <div class="text-right mt-3 ml-3">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-file"></i>&nbsp;Save TC Details</button>
                        </div>


                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
    // Event listener for the 'thickness' and 'batch_size' dropdowns
    $('select[name^="batch_size"], select[name^="thickness"]').on('change', function () {
        var selectedSize = $(this).closest('.form-row').find('select[name^="batch_size"]').val();
        var selectedThickness = $(this).closest('.form-row').find('select[name^="thickness"]').val();
        var isNo = $('input[name="is_no"]').val();
        var row = $(this).closest('.form-row'); // Get the current row

        // Make an AJAX request to get lot numbers and free_bore_test based on selected size and is_no
        $.ajax({
            url: '{{ route('getLotNos') }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                selectedsize: selectedSize,
                selectedthickness: selectedThickness,
                is_no: isNo
            },
            success: function (data) {
                // Update the 'lot_no' dropdown in the current row with the received options
                var lotNoDropdown = row.find('select[name^="lot_no"]');
                lotNoDropdown.empty();

                // Add a blank option
                lotNoDropdown.append($('<option>', {
                    value: '', // Value and text are both set to ''
                    text: 'Select Lot'
                }));

                // Add other options based on the received lot numbers
                $.each(data.lotNos, function (key, value) {
                    lotNoDropdown.append($('<option>', {
                        value: key,
                        text: key // Set value and text to the same
                    }));
                });

                // Display the free_bore_test in the relevant field
                /*console.log(data.freeBoreTest);
                var freeBoreTestField = row.find('input[name^="freeboretest"]');
                freeBoreTestField.val(data.freeBoreTest);*/
            }
        });
    });
});

</script>
<script>
    $(document).ready(function () {
        // Event listener for the 'lot_no' dropdowns
        $('select[name^="batch_size"], select[name^="lot_no"]').on('change', function () {
            var selectedLotNo = $(this).val();
            var row = $(this).closest('.form-row'); // Get the closest '.form-row'
            var selectedSize = row.find('select[name^="batch_size[]"] option:selected').text();
            var middleInteger = selectedSize.match(/\d+/)[0];
            //alert(middleInteger);

            
            $.ajax({
                url: '{{ route('getBatchInfo') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    lot_no: selectedLotNo,
                    TCID: '{{ $TcMasterDetails->tc_id }}',
                    ISname: '{{@$TcMasterDetails->is_no}}'
                },
                success: function (data) {
                    console.log(data);
                    // Update the 'batch_no', 'description', 'coil_no', and 'c_per' fields in the current row
                    row.find('input[name^="batch_no"]').val(data.batch_no);
                    row.find('input[name^="description"]').val(data.description);
                    row.find('input[name^="coil_no"]').val(data.coil_no);
                    row.find('input[name^="c_per"]').val(data.carbon);
                    row.find('input[name^="mn_per"]').val(data.mangnese);
                    row.find('input[name^="ph_per"]').val(data.Phosphorus);
                    row.find('input[name^="su_per"]').val(data.sulphur);
                    row.find('input[name^="si_per"]').val(data.silicon);
                    row.find('input[name^="ce_per"]').val(data.carbon_equivalent);
                    row.find('input[name^="uts_per"]').val(data.uts1);
                    row.find('input[name^="yst_per"]').val(data.yst1);
                    row.find('input[name^="elgn_per"]').val(data.elgn1);
                    var inputValue = data.zn || 'NA'; // Use 'NA' if data.zn is falsy
                    row.find('input[name^="mass"]').val(inputValue);
                    console.log(data.pipe_type);

                    var inputValue = (data.pipe_type == 'Galvanised') ? 'PASS' : 'NA';
                    var inputValue2 = (data.pipe_type == 'Galvanised' && middleInteger <= 25) ? 'PASS' : 'NA';
                    row.find('input[name^="uniformitytest"]').val(inputValue);
                    row.find('input[name^="adh"]').val(inputValue);
                    row.find('input[name^="freeboretest"]').val(inputValue2);

                    

                    // Update the 'hit_no' select element
                    var hitNoSelect = row.find('select[name^="hitNo[]"]');
                    hitNoSelect.empty(); // Clear existing options

                    // Add the default "Select" option
                    hitNoSelect.append('<option value="">Select</option>');

                    // Add the values from data
                    if (data.hit_no !== null) {
                        hitNoSelect.append('<option value="' + data.hit_no + '">' + data.hit_no + '</option>');
                    }
                    if (data.hit_no1 !== null) {
                        hitNoSelect.append('<option value="' + data.hit_no1 + '">' + data.hit_no1 + '</option>');
                    }
                    if (data.hit_no2 !== null) {
                        hitNoSelect.append('<option value="' + data.hit_no2 + '">' + data.hit_no2 + '</option>');
                    }
                    if (data.hit_no3 !== null) {
                        hitNoSelect.append('<option value="' + data.hit_no3 + '">' + data.hit_no3 + '</option>');
                    }
                    if (data.hit_no4 !== null) {
                        hitNoSelect.append('<option value="' + data.hit_no4 + '">' + data.hit_no4 + '</option>');
                    }
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function () {
        // Event listener for the 'lot_no' dropdowns
        $('select[name^="batch_size"]').on('change', function () {
            var selectedLotNo = $(this).val();
            var row = $(this).closest('.form-row'); // Get the closest '.form-row'

            // Make an AJAX request to get batch_no, description, coil_no, and carbon content based on the selected lot_no
            $.ajax({
                url: '{{ route('getBendFlattening') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    size_id: selectedLotNo
                },
                success: function (data) {
                    // Update the 'batch_no', 'description', 'coil_no', and 'c_per' fields in the current row
                    row.find('input[name^="bend"]').val(data.bend);
                    row.find('input[name^="flt"]').val(data.flattening);
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('select[name^="batch_size"]').on('change', function () {
            var selectedOptionText = $(this).find('option:selected').text();
            var middleInteger = selectedOptionText.match(/\d+/)[0];
            var isNo = "{{$TcMasterDetails->is_no}}";
            var index = $(this).attr('id').replace('batch_size', ''); // Extract the index from the ID
            console.log(index);
            if (parseInt(middleInteger) > 100 && isNo === 'IS 1239') {
               $('.thicknesswithoutLight' + index).show();
                $('.thicknesswithLight' + index).hide();
               
                
            } else {
              $('.thicknesswithLight' + index).show();
                $('.thicknesswithoutLight' + index).hide();

               

               
            }
        });
    });
</script>
@endsection
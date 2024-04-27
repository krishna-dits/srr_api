@extends('layouts.layout')
@section('content')
<div class="container-fluid">
    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <!--div-->
        <div class="card">
            <div class="card-header">
                <div class="card-title">Edit Tc Master</div>
            </div>
            <div class="card-body">
                <div class="">
                    <form class="row g-3" method="POST" action="{{ route('TcMasterUpdate') }}">
                        @csrf
                        <div class="col-md-12">
                            <input name="id" type="hidden" value="{{$edit_tc_master->id}}">

                            <h5 class="font-weight-bold"><i class="fa fa-cube"></i> Master</h5>
                            <div class="row">

                                <div class="col-md-2">
                                    <label class="form-label">TC ID<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('tc_id') is-invalid
                                        @enderror" name="tc_id" id="tc_id" placeholder="Is Name" value="{{$edit_tc_master->tc_id}}" readonly>
                                    @error('tc_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">Invoice No <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="invoice_no" id="invoice_no" value="{{$edit_tc_master->invoice_no}}" required placeholder="Enter Invoice No" />
                                    @error('invoice_no')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-2">
                                    <label for="type">Type <span class="text-danger">*</span></label>
                                    <select name="type" class="form-control select2-show-search" id="type" required onchange="getPorductName(this.value)">
                                        <option value="" for="type">type</option>
                                        @foreach (Config::get('static.Podo_Type') as $lang => $types)
                                        <option value="{{ $types }}" {{ $types == $edit_tc_master->type ? 'selected' : " " }}> {{ $types }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('type')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Is No <span class="text-danger">*</span></label>
                                    <!-- <select class="form-control select2-show-search select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="is_no" id="is_no" onchange="updatePartOptions(this.value,'{{ @$edit_tc_master->part_no }}','{{ @$edit_tc_detail }}')">
                                        <option value="">Select</option>
                                        @foreach ($is_number_list as $item)
                                        <option value="{{ $item->is_name }}" {{ $item->is_name == $edit_tc_master->is_no ? 'selected' : " " }}>{{ $item->is_name }}</option>
                                        @endforeach
                                    </select> -->
                                    <input type="text" class="form-control @error('is_no') is-invalid
                                        @enderror" name="is_no" id="is_no" placeholder="Is Name" value="{{$edit_tc_master->is_no}}" readonly>
                                    @error('is_no')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">Part <span class="text-danger">*</span></label>
                                    <select class="form-control" name="part" id="part" required>
                                        <!-- Part options will be populated dynamically using jQuery -->
                                        <option value="">Select</option>
                                    </select>
                                    @error('part')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">Vehicle <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="vehicle" id="vehicle" value="{{$edit_tc_master->vehicleno}}" required placeholder="Enter vehicle" />
                                    @error('vehicle')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Product <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="product" id="product" value="{{$edit_tc_master->product}}" required placeholder="Enter Product" />
                                    @error('product')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">Po/Do Init<span class="text-danger">*</span></label>
                                    <select class="form-control select2-show-search select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="podo_init" id="podo_init" onchange="GetPODo()">
                                        <option value="">Select</option>
                                        @foreach ($init as $item)
                                        <option value="{{ $item->init }}" {{ $item->init == $edit_tc_master->podo_init ? 'selected' : " " }}>{{ $item->init }}</option>
                                        @endforeach
                                    </select>
                                    @error('podo_init')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">Value <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="PO_value" id="PO_value" value="{{$edit_tc_master->podo_value}}" required placeholder="Enter value" onchange="GetPODo()" />
                                    @error('value')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-2">

                                    <label class="form-label">Unit<span class="text-danger">*</span></label>
                                    <select class="form-control select2-show-search select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="unit">
                                        <option value="">Select</option>
                                        @foreach (Config::get('static.Unit') as $lang => $units)
                                        <option value="{{ $units }}" {{ $units == $edit_tc_master->unit ? 'selected' : "" }}> {{ $units }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('unit')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">CM/L No <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="cml_no" id="cml_no" value="{{$edit_tc_master->cml_no}}" required placeholder="Enter CM/L No" />
                                    @error('cml_no')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Cust<span class="text-danger">*</span></label>
                                    <!-- <select class="form-control select2-show-search select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="cust_name" onchange="getCust(this.value)">
                                        <option value="">Select</option>
                                        @foreach ($customer as $item)
                                        <option value="{{ $item->id }}" {{ $item->id == $edit_tc_master->company ? 'selected' : " " }}>{{ $item->cus_name }}</option>
                                        @endforeach
                                    </select> -->
                                    <input type="text" class="form-control @error('cust_name') is-invalid
                                        @enderror" name="cust_name" id="cust_name"  value="{{$edit_tc_master->cast_details->cus_name}}" readonly>
                                    @error('cust_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">Conform To Is <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="conform_to_is" id="conform_to_is" value="{{$edit_tc_master->conformToIs}}" required placeholder="Enter Conform To Is" />
                                    @error('conform_to_is')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="date1" id="date1" value="{{ date('Y-m-d',strtotime($edit_tc_master->date1)) }}" required />
                                    @error('date1')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-2">
                                    <label class="form-label">NDT/HP <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="ndt_hp" id="ndt_hp" value="{{$edit_tc_master->hp}}" required placeholder="Enter NDT/HP" />
                                    @error('ndt_hp')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-3">
                                    <label class="form-label">Address<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="address1" id="address1" value="{{$edit_tc_master->address1}}" required placeholder="Enter Address1" />
                                    @error('address1')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Address2<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="address2" id="address2" value="{{$edit_tc_master->address2}}" required placeholder="Enter Address2" />
                                    @error('address2')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">TC No<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="tc_no" id="tc_no" value="{{$edit_tc_master->tc_no}}" required placeholder="Enter tc_no" />
                                    @error('tc_no')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-1">
                                    <label class="form-label">Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="date2" id="date2" value="{{ date('Y-m-d',strtotime($edit_tc_master->date2)) }}" required />
                                    @error('date2')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">PO/DO No<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="podo_no" id="podo_no" value="{{$edit_tc_master->podo_no}}" required placeholder="Enter PO/DO No" />
                                    @error('podo_no')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">PO No<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="po_no" id="po_no" value="{{$edit_tc_master->po_no}}" required placeholder="Enter PO/DO No" />
                                    @error('po_no')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-1">
                                    <label class="form-label">Date<span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="date3" id="date3" value="{{$edit_tc_master->date3}}" required placeholder="Enter Date" />
                                    @error('date3')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- //coating_thikness -->
                                <input type="hidden" class="form-control" name="coating_thikness" id="coating_thikness" value="{{ $edit_tc_master->coating_thikness }}" />

                            </div>
                        </div>

                        <div class="col-md-12 mt-2">
                            <h5 class="font-weight-bold"><i class="fa fa-cube"></i> Details</h5>
                            <div class="form-group col-md-12" style="border-top: 1px solid #ede8e8;">
                                <table class="table card-table table-vcenter text-nowrap" id="subhendu">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="width: 10%">Size<span class="text-danger">*</span></th>
                                            <th scope="col" style="width: 10%">Thickness<span class="text-danger">*</span></th>
                                            <th scope="col" style="width: 10%">Lot No<span class="text-danger">*</span></th>
                                            <th scope="col" style="width: 20%">Batch No<span class="text-danger">*</span></th>
                                            <th scope="col" style="width: 10%">Coil No<span class="text-danger">*</span></th>
                                            <th scope="col" style="width: 20%">Description<span class="text-danger">*</span></th>
                                            <th scope="col" style="width: 10%">Quantity<span class="text-danger">*</span></th>
                                            <th scope="col" style="width: 10%">Grade<span class="text-danger">*</span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @for ($i = 1; $i < 11; $i++) <tr>
                                            <td>
                                                <select class="form-control select2-show-search select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="size[]" id="size{{$i}}" onchange="getAllTcDetails(this.value, {{$i}})">
                                                    <option value="">Select</option>
                                                    @foreach($size_master_idwise as $list)
                                                        <option value="{{$list->id}}" {{ in_array($list->id, $edit_tc_detail->pluck('batch_size')->all()) ? 'selected' : '' }}>{{$list->desier}}</option>
                                                    @endforeach
                                                </select>

                                            </td>
                                            <td>
                                                <select class="form-control select2-show-search select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="thickness[]" id="thickness{{$i}}" value="{{ old('thickness') }}">
                                                    <option value="">Select</option>
                                                </select>

                                            </td>
                                            <td>
                                                <select class="form-control select2-show-search select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="lot_no[]" id="lot_no{{$i}}" value="{{ old('lot_no') }}">
                                                    <option value="">Select</option>

                                                </select>

                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="batch_no[]" id="batch_no{{$i}}" value="{{ old('batch_no') }}" placeholder="Enter Batch No" />
                                            </td>

                                            <td>
                                                <input type="text" class="form-control" name="coil_no[]" id="coil_no{{$i}}" value="{{ old('coil_no') }}" placeholder="Enter Coil No" />
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="description[]" id="description{{$i}}" value="{{ old('description') }}" placeholder="Enter Description" />
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="quantity[]" id="quantity{{$i}}" value="{{ old('quantity') }}" placeholder="Enter Quantity" />
                                            </td>
                                            <td>
                                                <select class="form-control select2-show-search select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="grade[]" id="grade{{$i}}" value="{{ old('grade') }}">
                                                    <option value="">Select</option>

                                                </select>
                                            </td>

                                            </tr>
                                            @endfor


                                    </tbody>
                                </table>
                            </div>
                            <div class="text-right mt-3 ml-3">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-file"></i>&nbsp;Save</button>
                            </div>
                        </div>

                        <div class="col-md-12 mt-2">

                            <div class="form-group col-md-12" style="border-top: 1px solid #ede8e8;">
                                <table class="table card-table table-vcenter text-nowrap" id="subhendu">
                                    <thead>

                                        <tr>
                                            <th scope="col" style="width: 2%">SL NO.<span class="text-danger">*</span></th>
                                            <th scope="col" style="width: 5%">C%<span class="text-danger">*</span></th>
                                            <th scope="col" style="width: 5%">MN%<span class="text-danger">*</span></th>
                                            <th scope="col" style="width: 5%">P%<span class="text-danger">*</span></th>
                                            <th scope="col" style="width: 5%">S%<span class="text-danger">*</span></th>
                                            <th scope="col" style="width: 5%">SI%<span class="text-danger">*</span></th>
                                            <th scope="col" style="width: 5%">CE%<span class="text-danger">*</span></th>
                                            <th scope="col" style="width: 5%">UTS%<span class="text-danger">*</span></th>
                                            <th scope="col" style="width: 5%">YST%<span class="text-danger">*</span></th>
                                            <th scope="col" style="width: 5%">ELGN%<span class="text-danger">*</span></th>
                                            <th scope="col" style="width: 5%">FLT Test<span class="text-danger">*</span></th>
                                            <th scope="col" style="width: 4%">Bend Test<span class="text-danger">*</span></th>
                                            <th scope="col" style="width: 5%">Drift Exp<span class="text-danger">*</span></th>
                                            <th scope="col" style="width: 5%">Mass OF Zn<span class="text-danger">*</span></th>
                                            <th scope="col" style="width: 5%">Dip Test<span class="text-danger">*</span></th>
                                            <th scope="col" style="width: 5%">Adh_Free Br<span class="text-danger">*</span></th>
                                            <th scope="col" style="width: 5%">Ends<span class="text-danger">*</span></th>
                                            <th scope="col" style="width: 9%">Remarks<span class="text-danger">*</span></th>

                                        </tr>
                                    </thead>

                                    <tbody>

                                        @for ($i = 1; $i < 11; $i++)
                                        <tr>

                                            <td>
                                                <input type="text" value="{{$i}}" class="form-control" name="sl_no[]" id="sl_no{{$i}}"  />
                                            </td>

                                            <td>
                                                <input type="text" class="form-control" name="c_per[]" id="c_per{{$i}}"  />
                                            </td>

                                            <td>
                                                <input type="text" class="form-control" name="mn_per[]" id="mn_per{{$i}}"  />
                                            </td>

                                            <td>
                                                <input type="text" class="form-control" name="ph_per[]" id="ph_per{{$i}}"  />
                                            </td>

                                            <td>
                                                <input type="text" class="form-control" name="su_per[]" id="su_per{{$i}}"  />
                                            </td>

                                            <td>
                                                <input type="text" class="form-control" name="si_per[]" id="si_per{{$i}}"  />
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="ce_per[]" id="ce_per{{$i}}"  />
                                            </td>

                                            <td>
                                                <input type="text" class="form-control" name="uts_per[]" id="uts_per{{$i}}"  />
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="yst_per[]" id="yst_per{{$i}}" />
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="elgn_per[]" id="elgn_per{{$i}}" />
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="flt[]" id="flt{{$i}}"  />
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="bend[]" id="bend{{$i}}"  />
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="drift[]" id="drift{{$i}}"  />
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="mass[]" id="mass{{$i}}"  />
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="dip_test[]" id="dip_test{{$i}}"  />
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="adh[]" id="adh{{$i}}"  />
                                            </td>
                                            <input type="hidden" class="form-control" name="addition_test[]" id="addition_test{{$i}}"  />
                                            <td>

                                                <select class="form-control select2-show-search select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="ends[]" id="ends{{$i}}">
                                                    <option value="">Select</option>
                                                    @foreach (Config::get('static.Ends') as $lang => $end)
                                                    <option value="{{ $end }}" > {{ $end }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </td>


                                            <td>
                                                <input type="text" class="form-control" name="remarks[]" id="remarks{{$i}}" value="Satisfactory" />
                                            </td>

                                        </tr>
                                        @endfor


                                    </tbody>
                                </table>
                            </div>


                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>

<!-- <script>
    // Define the mapping of Is No values to Part options
    var partOptions = {
        'IS 1239': ['Part I', 'Part II', 'Part III'],
        // Add other mappings here
    };

    // Function to update Part options based on selected Is No
    function updatePartOptions(selectedIsNo) {
        // alert(selectedIsNo)

        $('#conform_to_is').val('');

        $.ajax({
            url: "{{ route('get-coform-is-year') }}",
            type: "post",
            data: {
                IsName: selectedIsNo,
                _token: '{{ csrf_token() }}',
            },
            dataType: 'json',
            success: function(res) {
                let year = res.year;

                if (year != '' && selectedIsNo != '') {

                    let conformIs = selectedIsNo + ' Part():' + year;
                    $('#conform_to_is').val(conformIs);

                }

            }
        });

        function getCust(cust_id) {

            $('#tc_no').empty();

            $.ajax({
                url: "{{ route('get-customer-id-no') }}",
                type: "post",
                data: {
                    CustomerId: cust_id,
                    _token: '{{ csrf_token() }}',
                },
                dataType: 'json',
                success: function(res) {
                    let year = res.cus_id;

                    var afterSlash = year.split('/')[1]; // Get the value after the slash


                    var string = selectedIsNo;
                    var lastTwoCharacters = string.slice(-2);

                    var IC = $('#tc_id').val();

                    var inputString = IC;
                    var numbersOnly = inputString.match(/\d+/)[0];

                    let TCNO = '23' + afterSlash + lastTwoCharacters + '/' + numbersOnly;
                    $('#tc_no').val(TCNO);

                }
            });
        }

        var partSelect = $('#part');
        partSelect.empty(); // Clear existing options

        if (selectedIsNo in partOptions) {
            var options = partOptions[selectedIsNo];
            options.forEach(function(option) {
                partSelect.append('<option value="' + option + '">' + option + '</option>');
            });
        } else {
            // If selected Is No has no options, add "NA"
            partSelect.append('<option value="NA">NA</option>');
        }
    }

    getCml(selectedIsNo)
    getHp(selectedIsNo)
</script> -->
<script>
    // Define the mapping of Is No values to Part options
    var partOptions = {
        'IS 1239': ['Part I', 'Part II', 'Part III'],
        // Add other mappings here
    };

    // Function to update Part options based on selected Is No
    function updatePartOptions(selectedIsNo, partNo,edit_tc_detail) {
        console.log(edit_tc_detail);
        console.log(typeof edit_tc_detail);
        // var dataArray = $.map(edit_tc_detail, function(element) {
        //     return element;
        // });
        const dataArray = JSON.parse(edit_tc_detail);
        console.log(dataArray);

        var div_data_si = '';
        for (var j = 1; j < 11; j++) {
            $('#size' + j).html("<option value=''> select one.. </option>");
        }
        $('#conform_to_is').val('');
        $.ajax({
            url: "{{ route('get-size-by-is-master') }}",
            type: "post",
            data: {
                IsName: selectedIsNo,
                _token: '{{ csrf_token() }}',
            },
            dataType: 'json',
            success: function(response) {
                console.log(response);

                // var j = 0;
                for (var i = 1; i < 11; i++) {
                       
                        $.each(response, function(key, value) {
                        var sel = '';
                        // if(dataArray[j] != ''){
                        //     if(value.id == (dataArray[j].batch_size)){
                        //         sel = 'selected';
                        //     }
                        //     else{
                        //         sel = '';   
                        //     }  
                        // }
                        div_data_si += `<option value="${value.id}" ${sel}>${value.desier}</option>`;
                    });
                    $('#size' + i).append(div_data_si);
                    // getAllTcDetails(dataArray[j].thikness,i);
                    // j++;
                }
                console.log(div_data_si);
            },
            error: function(error) {
                console.log(error);
            }
        });

        // $.ajax({
        //     url: "{{ route('get-size-by-is-master') }}",
        //     type: "post",
        //     data: {
        //         IsName: selectedIsNo,
        //         _token: '{{ csrf_token() }}',
        //     },
        //     dataType: 'json',
        //     success: function(res) {
        //         $.each(response, function(key, value) {
        //             $('#size').append(
        //                 `<option value="${value.id	}">${value.desier }</option>`
        //             );
        //         });
        //     }
        // });
        var sel = '';
        $.ajax({
            url: "{{ route('get-coform-is-year') }}",
            type: "post",
            data: {
                IsName: selectedIsNo,
                _token: '{{ csrf_token() }}',
            },
            dataType: 'json',
            success: function(res) {
                let year = res.year;

                if (year != '' && selectedIsNo != '') {

                    let conformIs = selectedIsNo + ' Part():' + year;
                    $('#conform_to_is').val(conformIs);

                }

                $('#cml_no').val(res.cml_no);
                $('#ndt_hp').val(res.hp);

            }
        });


        var partSelect = $('#part');
        partSelect.empty(); // Clear existing options

        if (selectedIsNo in partOptions) {
            var options = partOptions[selectedIsNo];
            options.forEach(function(option) {
                if (option == partNo) {
                    var sel = 'selected';
                }
                partSelect.append('<option value="' + option + '" ' + sel + ' >' + option + '</option>');
            });
        } else {
            // If selected Is No has no options, add "NA"
            partSelect.append('<option value="NA">NA</option>');
        }
    }

    getCml(selectedIsNo)
    getHp(selectedIsNo)
</script>

<script>
    function getCml(name) {

        $('#cml_no').empty();

        $.ajax({
            url: "{{ route('get-cml-no') }}",
            type: "post",
            data: {
                IsName: name,
                _token: '{{ csrf_token() }}',
            },
            dataType: 'json',
            success: function(res) {
                $('#cml_no').val(res.cml_no);

            }
        });
    }

    function getHp(name) {
        $('#ndt_hp').empty();
        $.ajax({
            url: "{{ route('get-hp-no') }}",
            type: "post",
            data: {
                IsName: name,
                _token: '{{ csrf_token() }}',
            },
            dataType: 'json',
            success: function(res) {
                $('#ndt_hp').val(res.hp);

            }
        });
    }
</script>

<script>
    function GetPODo() {
        let name = $('#podo_init').val()
        var POvalue = $('#PO_value').val();

        if (name !== '' && POvalue !== '') {
            var POvalue = $('#PO_value').val();
            let TCNO = name + '/' + POvalue + '/23-24';
            $('#podo_no').val(TCNO);
        }
    }
</script>

<script>
    function getAllTcDetails(Size, index, lotNo) {

        var thicknessSelect = $('#thickness' + index);
        var lotNoSelect = $('#lot_no' + index);
        var gradeSelect = $('#grade' + index);
        var descriptionInput = $('#description' + index);
        var batchNoInput = $('#batch_no' + index);
        var coilNoInput = $('#coil_no' + index);

        var bend_perInput = $('#bend' + index);
        var flt_perInput = $('#flt' + index);

        thicknessSelect.empty();
        lotNoSelect.empty();
        gradeSelect.empty();
        descriptionInput.val('');
        batchNoInput.val('');
        coilNoInput.val('');

        bend_perInput.val('');
        flt_perInput.val('');

        var cPerSelect = $('#c_per' + index);
        var mn_perSelect = $('#mn_per' + index);
        var ph_perSelect = $('#ph_per' + index);
        var su_perInput = $('#su_per' + index);
        var si_perInput = $('#si_per' + index);
        var ce_perInput = $('#ce_per' + index);

        cPerSelect.val('');
        mn_perSelect.val('');
        ph_perSelect.val('');
        su_perInput.val('');
        si_perInput.val('');
        ce_perInput.val('');

        $('#uts_per' + index).val('');
        $('#yst_per' + index).val('');
        $('#elgn_per' + index).val('');
        $('#mass' + index).val('');
        bend_perInput.val('');
        flt_perInput.val('');
        var drift_Select = $('#drift' + index);
        drift_Select.val('');

        var adh_Select = $('#adh' + index);
        var addition_test_Select = $('#addition_test' + index);
        var dip_Select = $('#dip_test' + index);

        adh_Select.val('');
        addition_test_Select.val('');
        dip_Select.val('');



        $.ajax({
            url: "{{ route('get-all-tc-details') }}",
            type: "post",
            data: {
                SizeName: Size,
                _token: '{{ csrf_token() }}',
            },
            dataType: 'json',
            success: function(response) {

                console.log(response)

                $.each(response.thickness, function(key, value) {
                    let sel = (value.id == Size ? 'selected' : '');
                    thicknessSelect.append(

                        `<option value="${value.desire}" ${sel}>${value.desire}</option>`
                    );
                });

                $.each(response.lot_no, function(key, value) {
                    let sel = (value.id == lotNo ? 'selected' : '');
                    lotNoSelect.append(
                        `<option value="${value.lot_no}" ${sel}>${value.lot_no}</option>`
                    );
                });

                $.each(response.grade_no, function(key, value) {
                    gradeSelect.append(
                        `<option value="${value.grade}">${value.grade}</option>`
                    );
                });

                descriptionInput.val(response.batch_no.descriptation);
                batchNoInput.val(response.batch_no.batch_no);
                coilNoInput.val(response.coil_no.coil_no);


                getCoilValues(response.coil_no.coil_no, index);
                getBatchValues(response.batch_no.batch_no, index);

                bend_perInput.val(response.size.bend);
                flt_perInput.val(response.size.flattening);

                getIsValues(response.is_values.is_name, index);
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
</script>

<script>
    function getCoilValues(Coil, index) {

        var cPerSelect = $('#c_per' + index);
        var mn_perSelect = $('#mn_per' + index);
        var ph_perSelect = $('#ph_per' + index);
        var su_perInput = $('#su_per' + index);
        var si_perInput = $('#si_per' + index);
        var ce_perInput = $('#ce_per' + index);

        cPerSelect.val('');
        mn_perSelect.val('');
        ph_perSelect.val('');
        su_perInput.val('');
        si_perInput.val('');
        ce_perInput.val('');

        $.ajax({
            url: "{{ route('get-all-coil-details') }}",
            type: "post",
            data: {
                CoilName: Coil,
                _token: '{{ csrf_token() }}',
            },
            dataType: 'json',
            success: function(response) {
                cPerSelect.val(response.carbon);
                mn_perSelect.val(response.mangnese);
                ph_perSelect.val(response.Phosphorus);
                su_perInput.val(response.sulphur);
                si_perInput.val(response.silicon);
                ce_perInput.val(response.carbon_equivalent);

            },
            error: function(error) {
                console.log(error);
            }
        });
    }
</script>


<script>
    function getBatchValues(Batch, index) {

        var uts_perSelect = $('#uts_per' + index);
        var yst_perSelect = $('#yst_per' + index);
        var elgn_perSelect = $('#elgn_per' + index);
        var massSelect = $('#mass' + index);

        $('#uts_per' + index).val();
        $('#yst_per' + index).val();
        $('#elgn_per' + index).val();
        $('#mass' + index).val();


        $.ajax({
            url: "{{ route('get-all-batch-details') }}",
            type: "post",
            data: {
                BatchName: Batch,
                _token: '{{ csrf_token() }}',
            },
            dataType: 'json',
            success: function(response) {
                uts_perSelect.val(response.uts1);
                yst_perSelect.val(response.yst1);
                elgn_perSelect.val(response.elgn1);
                massSelect.val(response.zn1);
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
</script>

<!-- <script>
    function getIsValues(IsMaster, index) {
        var drift_Select = $('#drift' + index);
        var adh_Select = $('#adh' + index);
        var addition_test_Select = $('#addition_test' + index);
        var dip_Select = $('#dip_test' + index);

        drift_Select.val();
        adh_Select.val();
        addition_test_Select.val();
        dip_Select.val();

        $.ajax({
            url: "{{ route('get-all-is-master-details') }}",
            type: "post",
            data: {
                IsName: IsMaster,
                _token: '{{ csrf_token() }}',
            },
            dataType: 'json',
            success: function(response) {

                drift_Select.val(response.drift_exp);
                adh_Select.val(response.free_board_test);
                dip_Select.val(response.uniformity_test);
                addition_test_Select.val(response.addition_test);
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
</script> -->

<script>
    function getIsValues(IsMaster, index) {
        var drift_Select = $('#drift' + index);
        var adh_Select = $('#adh' + index);
        var addition_test_Select = $('#addition_test' + index);
        var dip_Select = $('#dip_test' + index);

        $.ajax({
            url: "{{ route('get-all-is-master-details') }}",
            type: "post",
            data: {
                IsName: IsMaster,
                _token: '{{ csrf_token() }}',
            },
            dataType: 'json',
            success: function(response) {

                drift_Select.val(response.is_values.drift_exp);
                adh_Select.val(response.size.free_board_test);
                dip_Select.val(response.is_values.uniformity_test);
                addition_test_Select.val(response.is_values.addition_test);

            },
            error: function(error) {
                console.log(error);
            }
        });
    }
</script>

<script>
    function getPorductName(typeName) {
        $('#product').val('');
        if (typeName != " ") {
            if (typeName === 'MSBP') {

                $('#product').prop('readonly', true);

                $('#product').val('Mild Steel Black Pipe');
                $('#coating_thikness').val('NA');

            } else if (typeName === 'CSBP') {
                $('#product').prop('readonly', true);

                $('#product').val('Carbon Steel Black Pipe');
                $('#coating_thikness').val('NA');
            } else if (typeName === 'MSGI') {
                $('#product').prop('readonly', true);

                $('#product').val('Mild Steel Galvanised Pipe');
                $('#coating_thikness').val('PASS');
            } else if (typeName === 'CSGI') {
                $('#product').prop('readonly', true);

                $('#product').val('Carbon Steel Galvanised Pipe');
                $('#coating_thikness').val('PASS');
            }
        }
    }
</script>

@endsection
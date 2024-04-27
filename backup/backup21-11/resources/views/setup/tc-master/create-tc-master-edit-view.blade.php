@extends('layouts.layout')
@section('content')
<div class="container-fluid">
    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <!--div-->
        <div class="card">
            <div class="card-header">
                <div class="card-title">Tc Master (TC ID: {{@$TcDetail->tc_id}})</div>
            </div>
            <!-- ================================ Alert Message===================================== -->

            @if (session('success'))
            <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('success')}}</div>
            @endif
            @if (session()->has('error'))
            <div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('error')}}</div>
            @endif

            <!-- ================================ Alert Message===================================== -->
            <script>
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
                            console.log(res);
                            let year = res.cus_id;
                            let afterSlash = year.split('/')[1].slice(-3); // Get the last three digits after the slash

                            var string = $('#is_no').val();

                            var lastTwoCharacters = string.slice(-2);
                            var IC = $('#tc_id').val();


                            var inputString = IC;
                            var numbersOnly = inputString.match(/\d+/)[0];
                            var lastFourDigits = numbersOnly.slice(-4);

                            let TCNO = '23' + afterSlash + lastTwoCharacters + lastFourDigits;

                            $('#tc_no').val(TCNO);
                            $('#address1').val(res.address1);
                            $('#address2').val(res.address2);



                        }
                    });



                }
            </script>
            <div class="card-body">
                <div class="">
                    <form class="row g-3" method="POST" action="{{ route('TcMasterAdd_previous_update') }}">
                        @csrf
                        <div class="col-md-12">

                            <h5 class="font-weight-bold"><i class="fa fa-cube"></i> Master</h5>
                            <div class="row">
                                <div class="col-md-2">
                                    <label class="form-label">TC ID<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('tc_id') is-invalid
                                        @enderror" name="tc_id" id="tc_id" placeholder="TC ID" value="{{@$TcDetail->tc_id}}" readonly>
                                    @error('tc_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">Invoice No <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="invoice_no" id="invoice_no" value="{{@$TcDetail->invoice_no}}" required placeholder="Enter Invoice No" />
                                    @error('invoice_no')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-2">
                                    <label for="type">Type <span class="text-danger">*</span></label>
                                    <select name="type" class="form-control select2-show-search" id="type" required onchange="getPorductName(this.value)">
                                        <option value="" for="type">type</option>
                                        @foreach (Config::get('static.Podo_Type') as $lang => $types)
                                        <option value="{{ $types }}" {{ $TcDetail->type == $types ? 'selected' : '' }}> {{ $types }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('type')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">IS No <span class="text-danger">*</span></label>
                                    <select class="form-control select2-show-search select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="is_no" id="is_no" onchange="updatePartOptions(this.value)">
                                        <option value="">Select</option>
                                        @foreach ($is_number_list as $item)
                                        <option value="{{ $item->is_name }}" {{ $item->is_name == $TcDetail->is_no ? 'selected' : '' }}>{{ $item->is_name }}</option>
                                        @endforeach
                                    </select>
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
                                    <input type="text" class="form-control" name="vehicle" id="vehicle" value="{{@$TcDetail->vehicleno}}" required placeholder="Enter vehicle" />
                                    @error('vehicle')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Product <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="product" id="product" value="{{ old('product') }}" required placeholder="Enter Product" />
                                    @error('product')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">Po/Do Init<span class="text-danger">*</span></label>
                                    <select class="form-control select2-show-search select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="podo_init" id="podo_init" onchange="GetPODo()">
                                        <option value="">Select</option>
                                        @foreach ($init as $item)
                                        <option value="{{ $item->init }}" {{ $item->init == $TcDetail->podo_init ? 'selected' : '' }}>{{ $item->init }}</option>
                                        @endforeach
                                    </select>
                                    @error('podo_init')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">Value <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="PO_value" id="PO_value" value="{{@$TcDetail->PO_value}}" a placeholder="Enter value" onchange="GetPODo()" />
                                    @error('value')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">Unit<span class="text-danger">*</span></label>
                                    <select class="form-control select2-show-search select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="unit" id="unit">
                                        <option value="">Select</option>
                                        @foreach (Config::get('static.Unit') as $lang => $units)
                                        <option value="{{ $units }}" {{ $units == $TcDetail->unit ? 'selected' : '' }}> {{ $units }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('unit')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">CM/L No <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="cml_no" id="cml_no" value="{{@$TcDetail->cml_no}}" required placeholder="Enter CM/L No" />
                                    @error('cml_no')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Cust<span class="text-danger">*</span></label>
                                    <select class="form-control select2-show-search select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="cust_name" onchange="getCust(this.value)">
                                        <option value="">Select</option>
                                        @foreach ($customer as $item)
                                        <option value="{{ $item->id }}" {{ $item->id == $TcDetail->company ? 'selected' : '' }}>{{ $item->cus_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('cust_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">Conform To Is <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="conform_to_is" id="conform_to_is" value="{{@$TcDetail->conform_to_is}}" required placeholder="Enter Conform To Is" />
                                    @error('conform_to_is')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="date1" id="date1" value="{{@$TcDetail->date1}}" required />
                                    @error('date1')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-2">
                                    <label class="form-label">NDT/HP <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="ndt_hp" id="ndt_hp" value="{{@$TcDetail->ndt_hp}}" required placeholder="Enter NDT/HP" />
                                    @error('ndt_hp')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-3">
                                    <label class="form-label">Address<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="address1" id="address1" value="{{@$TcDetail->address1}}" required placeholder="Enter Address1" />
                                    @error('address1')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Address2<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="address2" id="address2" value="{{@$TcDetail->address2}}" required placeholder="Enter Address2" />
                                    @error('address2')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">TC No<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="tc_no" id="tc_no" value="{{@$TcDetail->tc_no}}" required placeholder="Enter tc_no" />
                                    @error('tc_no')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-1">
                                    <label class="form-label">Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="date2" id="date2" value="{{@$TcDetail->date2}}" required />
                                    @error('date2')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">DO No<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="podo_no" id="podo_no" value="{{@$TcDetail->podo_no}}" required placeholder="Enter PO/DO No" />
                                    @error('podo_no')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">PO No<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="po_no" id="po_no" value="{{@$TcDetail->po_no}}" required placeholder="Enter PO/DO No" />
                                    @error('po_no')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-1">
                                    <label class="form-label">Date<span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="date3" id="date3" value="{{@$TcDetail->date3}}" required placeholder="Enter Date" />
                                    @error('date3')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- //coating_thikness -->
                                <input type="hidden" class="form-control" name="coating_thikness" id="coating_thikness" value="{{ old('coating_thikness') }}" />

                            </div>
                        </div>
                        <div class="text-right mt-3 ml-3">
                                <button type="submit" class="btn btn-success"><i class="fa fa-file"></i>&nbsp;Update</button>

                                <a class="btn btn-primary"><i class="fa fa-arrow-right"></i>&nbsp;Next</a>
                                
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>

<script>
    // Define the mapping of Is No values to Part options
    var partOptions = {
        'IS 1239': ['Part I', 'Part II', 'Part III'],
        // Add other mappings here
    };

    // Function to update Part options based on selected Is No
    function updatePartOptions(selectedIsNo) {
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
                console.log('response :   '+response);
                $.each(response, function(key, value) {
                    div_data_si += `<option value="${value.id}" >${value.desier}</option>`;
                });
              
                for (var i = 1; i < 11; i++) {                                   
                    $('#size' + i).append(div_data_si);

                }
                console.log('size:' +div_data_si);
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
                partSelect.append('<option value="' + option + '">' + option + '</option>');
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
    function getAllTcDetails(Size, index) {

        var thicknessSelect = $('#thickness' + index);
        //console.log(thicknessSelect);
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

        $.ajax({
            url: "{{ route('get-all-tc-details') }}",
            type: "post",
            data: {
                SizeName: Size,
                _token: '{{ csrf_token() }}',
            },
            dataType: 'json',
            success: function(response) {
                console.log(response.thickness)
                $.each(response.thickness, function(key, value) {
                    thicknessSelect.append(
                        `<option value="${value.desire}">${value.desire}</option>`
                    );
                });
                $.each(response.lot_no, function(key, value) {
                    lotNoSelect.append(
                        `<option value="${value.lot_no}">${value.lot_no}</option>`
                    );
                });

                $.each(response.grade_no, function(key, value) {
                    gradeSelect.append(
                        `<option value="${value.grade}">${value.grade}</option>`
                    );
                });
                //console.log();

                descriptionInput.val(response.batch_no.descriptation);
                batchNoInput.val(response.batch_no.batch_no);
                coilNoInput.val(response.coil_no.coil_no);

                // alert(response.coil_no.coil_no);
                getCoilValues(response.coil_no.coil_no, index)
                getBatchValues(response.batch_no.batch_no, index)

                bend_perInput.val(response.size.bend);
                flt_perInput.val(response.size.flattening);

                getIsValues(response.is_values.is_name, index)
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
</script>

<script>
    function getCoilValues(Coil, index) {
        // alert(Coil);
        var cPerSelect = $('#c_per' + index);
        //   alert(cPerSelect);
        var mn_perSelect = $('#mn_per' + index);
        var ph_perSelect = $('#ph_per' + index);
        var su_perInput = $('#su_per' + index);
        var si_perInput = $('#si_per' + index);
        var ce_perInput = $('#ce_per' + index);

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
        // alert(Coil);
        var uts_perSelect = $('#uts_per' + index);
        var yst_perSelect = $('#yst_per' + index);
        var elgn_perSelect = $('#elgn_per' + index);
        var massSelect = $('#mass' + index);
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

                $('#product').val('Mild Steel Galvanized Pipe');
                $('#coating_thikness').val('PASS');
            } else if (typeName === 'CSGI') {
                $('#product').prop('readonly', true);

                $('#product').val('Carbon Steel Galvanized Pipe');
                $('#coating_thikness').val('PASS');
            }
        }
    }
</script>

@endsection
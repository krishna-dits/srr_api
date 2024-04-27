@extends('layouts.layout')
@section('content')
<div class="container-fluid">
    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <!--div-->
        <div class="card">
            <div class="card-header">
                <div class="card-title">Edit Batch</div>
            </div>
            <div class="card-body">
                <div class="">
                    <form class="row g-3" method="POST" action="{{ route('BatchUpdate') }}">
                        @csrf
                        <div class="col-md-12">
                            <div class="row">
                                <input name="id" type="hidden" value="{{$editBatch->id}}">
                                <div class="col-md-2">
                                    <label class="form-label">Batch Id<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('batch_id') is-invalid
                                        @enderror" name="batch_id" placeholder="Is Name" value="{{$editBatch->batch_id}}" readonly>
                                    @error('batch_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Batch No <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="batch_no" id="batch_no" placeholder="Enter Batch No" value="{{$editBatch->batch_no}}" readonly />
                                    @error('batch_no')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Lot No <span class="text-danger">*</span></label>

                                    <input type="text" class="form-control" name="lot_no" id="lot_no" placeholder="Enter Lot No" value="{{$editBatch->lot_no}}" readonly />
                                    @error('lot_no')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Descriptation <span class="text-danger">*</span></label>

                                    <input type="text" class="form-control" name="descriptation" id="descriptation" required placeholder="Enter Descriptation" value="{{$editBatch->descriptation}}" readonly />
                                    @error('descriptation')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Is Name <span class="text-danger">*</span></label>
                                    <select class="form-control select2-show-search select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="is_name" id="is_name" onchange="getAllValues(this.value,'{{$editBatch->thickness}}')">
                                        <option value="">Select</option>
                                        @foreach ($is_number_list as $item)
                                        <option value="{{ $item->is_name }}" {{ $item->is_name == $editBatch->is_name ? 'selected' : " " }}>{{ $item->is_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('is_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Sift<span class="text-danger">*</span></label>
                                    <select class="form-control select2-show-search select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="shift" id="shift" onchange="getBatchNo()">
                                        <option value="">Select</option>
                                        <option value="A" {{ 'A' == $editBatch->shift ? 'selected' : " " }}>A</option>
                                        <option value="B" {{ 'B' == $editBatch->shift ? 'selected' : " " }}>B</option>
                                    </select>
                                    @error('shift')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Mill Date<span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="mill_date" id="mill_date" required value="<?= date('Y-m-d', strtotime($editBatch->mill_date)) ?>" onchange="getBatchNo()" />
                                    @error('mill_date')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Coil Indentification No <span class="text-danger">*</span></label>
                                   <select class="form-control select2-show-search select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="coil_no" id="coil_no">
                                        <option value="">Select</option>
                                        @foreach ($coil_master as $item)
                                        <option value="{{ $item->indentification_no }}" {{ $item->indentification_no == $editBatch->coil_no ? 'selected' : " " }}>{{ $item->indentification_no }}</option>
                                        @endforeach
                                    </select>
                                    @error('coil_no')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- <div class="col-md-3">
                                    <label class="form-label">Heat No <span class="text-danger">*</span></label>
                                    <select class="form-control select2-show-search select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="hit_no">
                                        <option value="">Select</option>
                                        @foreach ($coil_master as $item)
                                        <option value="{{ $item->hit_no }}" {{ $item->hit_no == $editBatch->hit_no ? 'selected' : " " }}>{{ $item->hit_no }}</option>
                                        @endforeach
                                    </select>
                                    @error('hit_no')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div> -->

                                <div class="col-md-3">
                                    <label class="form-label">Heat No</label>
                                    <input type="text" class="form-control" name="hit_no" id="hit_no" value="{{$editBatch->hit_no}}" placeholder="Enter Quantity" />
                                    @error('hit_no')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Heat No 1</label>
                                    <input type="text" class="form-control" name="hit_no1" id="hit_no1" value="{{$editBatch->hit_no1}}" placeholder="Enter Quantity" />
                                    @error('hit_no1')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Heat No 2</label>
                                    <input type="text" class="form-control" name="hit_no2" id="hit_no2" value="{{$editBatch->hit_no2}}" placeholder="Enter Quantity" />
                                    @error('hit_no2')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Heat No 3</label>
                                    <input type="text" class="form-control" name="hit_no3" id="hit_no3" value="{{$editBatch->hit_no3}}" placeholder="Enter Quantity" />
                                    @error('hit_no3')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Heat No 4</label>
                                    <input type="text" class="form-control" name="hit_no4" id="hit_no4" value="{{$editBatch->hit_no4}}" placeholder="Enter Quantity" />
                                    @error('hit_no4')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Size<span class="text-danger">*</span></label>
                                    <select class="form-control select2-show-search select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="size" onchange="getBatchNo()" id="size">
                                        <option value="">Select</option>
                                        @foreach ($size_master as $item)
                                        <option value="{{ $item->desier }}" {{$item->desier == $editBatch->size ? 'selected' : " " }}>{{ $item->desier }}</option>
                                        @endforeach
                                    </select>
                                    @error('size')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- 
                                <div class="col-md-3">
                                    <label class="form-label">Thickness<span class="text-danger">*</span></label>
                                    <select class="form-control select2-show-search select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="thickness" id="thickness" onchange="getBatchNo()">
                                        <option value="">Select</option>
                                        @foreach ($thickness as $item)
                                        <option value="{{ $item->thik_value }}" {{ $item->thik_value == $editBatch->thickness ? 'selected' : " " }}>{{ $item->thik_value }}</option>
                                        @endforeach
                                    </select>
                                    @error('thickness')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div> -->

                                <!-- <div class="col-md-3">
                                    <label class="form-label">Thickness<span class="text-danger">*</span></label>
                                    <select class="form-control select2-show-search select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="thickness" id="thickness" onchange="getBatchNo()">
                                        <option value="">Select</option>
                                        @foreach ($thickness as $item)
                                        <option value="{{ $item->thik_value }}" {{ $item->thik_value == $editBatch->thickness ? 'selected' : ' ' }}>{{ $item->thik_value }}</option>
                                        @endforeach
                                    </select>
                                    @error('thickness')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div> -->

                                <div class="col-md-2">
                                    <label class="form-label">Thickness<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="thickness" id="thickness" value="{{$editBatch->thickness}}" required placeholder="Enter Quantity" readonly />
                                    @error('quality')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">Quantity<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="quality" id="quality" value="{{$editBatch->quality}}" required placeholder="Enter Quantity" />
                                    @error('quality')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- <div class="col-md-2">
                                    <label class="form-label">Zn 1 %<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="zn1" id="zn1" value="{{$editBatch->zn1}}" required placeholder="Enter Zn 1" />
                                    @error('zn1')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Zn 2 %<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="zn2" id="zn2" value="{{$editBatch->zn2}}" required placeholder="Enter Zn 2" />
                                    @error('zn2')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div> -->

                                <div class="col-md-3">
                                    <label class="form-label">Black & Galvanised <span class="text-danger">*</span></label>
                                    <select class="form-control select2-show-search select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="pipe_type" id="pipe_type" onchange="getDetailsAccordingType(this.value)">
                                        <option value="">Select</option>
                                        <option value="Black" {{ 'Black' == $editBatch->pipe_type ? 'selected' : ""}}>Black Pipe</option>
                                        <option value="Galvanised" {{ 'Galvanised' == $editBatch->pipe_type ? 'selected' : ""}}>Galvanised Pipe</option>
                                    </select>
                                    @error('pipe_type')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                @if($editBatch->pipe_type == 'Galvanised')

                                <div style="display:none" class="col-md-4" id="galbanaised">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">Zn 1 %<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="zn1" id="zn1" value="{{$editBatch->zn1}}" placeholder="Enter Zn 1" />
                                            @error('zn1')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Zn 2 %<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="zn2" id="zn2" value="{{$editBatch->zn2}}" placeholder="Enter Zn 2" />
                                            @error('zn2')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                @endif

                                <div class="col-md-2">
                                    <label class="form-label">YST 1st %<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="yst1" id="yst1" value="{{$editBatch->yst1}}" placeholder="Enter YST 1" />
                                    @error('yst1')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">YST 2nd %<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="yst2" id="yst2" value="{{$editBatch->yst2}}" placeholder="Enter Zn 2" />
                                    @error('yst2')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">UTS 1st %<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="uts1" id="uts1" value="{{$editBatch->uts1}}" placeholder="Enter Uts 1" />
                                    @error('uts1')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">UTS 2nd %<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="uts2" id="uts2" value="{{$editBatch->uts2}}" placeholder="Enter Uts 2" />
                                    @error('uts2')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">ELGN 1st %<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="elgn1" id="elgn1" value="{{$editBatch->elgn1}}" placeholder="Enter ELGN 1st" />
                                    @error('elgn1')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">ELGN 2nd %<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="elgn2" id="elgn2" value="{{$editBatch->elgn2}}" placeholder="Enter ELGN 2nd" />
                                    @error('elgn2')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="text-right mt-3 ml-3">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-file"></i>&nbsp;Save</button>
                                </div>
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
    function getDetailsAccordingType(val) {

        getBatchNo(val);
        if (val == 'Black') {
            $('#galbanaised').hide();

        } else if (val == 'Galvanised') {
            $('#galbanaised').show();

        }
    }
</script>

<script>
    function getBatchNo(pipeType) {
        // alert(pipeType);
        var dateString = $('#mill_date').val();
        var dateParts = dateString.split('-');
        var month = dateParts[1];
        var year = dateParts[0];
        var day = dateParts[2];

        $.ajax({
            url: "{{ route('get-month-and-year-by-date') }}",
            type: "post",
            data: {
                MonthId: month,
                YearValue: year,
                _token: '{{ csrf_token() }}',
            },
            dataType: 'json',
            success: function(response) {
                console.log(response);

                var MonthName = response.monthLetter.letter;
                var YearName = response.yearLetter.letter;
                var is_size = YearName + MonthName;
                var shift = $('#shift').val();
                var size = $('#size').val();
                var thickness = $('#thickness').val();
                let pipe_type = $('#pipe_type').val();


                let name = is_size + day + shift + size + thickness;
                // alert(name);
                let Lot = is_size + day + shift;
                let Des = size + " " + thickness + " " + pipe_type;


                if (is_size !== '' && day !== '' && shift !== '') {
                    $('#lot_no').val(Lot);
                }
                if (day !== '' && shift !== '' && thickness !== '' && size !== '') {
                    $('#batch_no').val(name);
                }

                if (thickness !== '' && size !== '' && pipe_type != '') {
                    $('#descriptation').val(Des);
                }
            }
        });
    }
</script>


<script>
    function getAllValues(isname, Thickness) {
        //  alert(Thickness);
        var div_data = '';
        var div_data_dat = '';
        var thikTypeSelect = $('select[name="thickness"]');
        thikTypeSelect.html('<option value="">select one..</option>')
        $.ajax({
            url: "{{ route('get-all-is-master-details') }}",
            type: "post",
            data: {
                IsName: isname,
                _token: '{{ csrf_token() }}',
            },
            dataType: 'json',
            success: function(response) {
                console.log(response.thick_values);
                let yst_type = response.is_values.yst;
                // alert(yst_type);
                if (yst_type == 'N') {
                    $('#yst1').val('NA');
                    $('#yst2').val('NA');
                } else {
                    $('#yst1').val('');
                    $('#yst2').val('');
                }
                $.each(response.thick_values, function(key, value) {

                    div_data += `<option value="${value.thik_value}" >${value.thik_value}</option>`;
                });
                console.log(div_data);
                thikTypeSelect.append(div_data);

                if (isname == 'IS 1239') {

                    thikTypeSelect.empty(); // Remove existing options
                    thikTypeSelect.html($('<option value="">Select One...</option>'));
                    var isThicknessOptions = <?php echo json_encode(Config::get('static.Is_Thickness')); ?>;
                    $.each(isThicknessOptions, function(key, value) {
                        if (value == Thickness) {
                            var sel = 'selected';
                        } else {
                            var sel = '';
                        }
                        div_data_dat += `<option value="${value}" ${sel}>${value}</option>`;

                        thikTypeSelect.html(div_data_dat);
                    });
                }

            },
            error: function(error) {
                console.log(error);
            }
        });
    }
</script>
<script>
    $(document).ready(function () {
        $('#coil_no2').change(function () {
            var selectedCoilNo = $(this).val();
            //console.log('');

            // Check if a coil number is selected
            if (selectedCoilNo) {
                // Make an AJAX request to fetch the heat numbers
                $.ajax({
                    url: "{{ route('get-heat-numbers') }}",
                    type: "post",
                    data: {
                        coil_no: selectedCoilNo,
                        _token: '{{ csrf_token() }}',
                    },
                    dataType: 'json',
                    success: function (response) {
                        // Update the "Heat No" fields with the received data
                        $('#hit_no').val(response.hit_no);
                        $('#hit_no1').val(response.hit_no1);
                        $('#hit_no2').val(response.hit_no2);
                        $('#hit_no3').val(response.hit_no3);
                        $('#hit_no4').val(response.hit_no4);
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            } else {
                // Clear the "Heat No" fields if no coil number is selected
                $('#hit_no').val('');
                $('#hit_no1').val('');
                $('#hit_no2').val('');
                $('#hit_no3').val('');
                $('#hit_no4').val('');
            }
        });
    });

    // Rest of your script for other functionalities

</script>


@endsection
@extends('layouts.layout')
@section('content')
<div class="container-fluid">
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <!--div-->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Add Max Min Limit</div>
        </div>
        <div class="card-body">
            <div class="">
                <form class="row g-3" method="POST" action="{{ route('MaxMinLimitSave') }}">
                    @csrf
                    <div class="col-md-12">
                        <div class="row">

                            <div class="col-md-3">
                                <label class="form-label">Is Name <span class="text-danger">*</span></label>
                                <select class="form-control select2-show-search select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="is_name" id="is_name">
                                    <option value="">Select</option>
                                    @foreach ($is_number_list as $item)
                                        <option value="{{ $item->is_name }}">{{ $item->is_name }}</option>
                                    @endforeach
                                </select>
                                @error('is_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">Grade <span class="text-danger">*</span></label>
                                <select class="form-control select2-show-search select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="grade" id="grade">
                                    <option value="">Select</option>
                                </select>
                                @error('grade')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">C % Max<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="c_max" id="c_max" value="{{ old('c_max') }}"  placeholder="Enter c_max" />
                                @error('c_max')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">Mn % Max <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="mn_max" id="mn_max" value="{{ old('mn_max') }}"  placeholder="Enter mn_max" />
                                @error('mn_max')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">P % Max <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="ph_max" id="ph_max" value="{{ old('ph_max') }}"  placeholder="Enter ph_max" />
                                @error('ph_max')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">S % Max <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="su_max" id="su_max" value="{{ old('su_max') }}"  placeholder="Enter Su Max" />
                                @error('su_max')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- <div class="col-md-3">
                                <label class="form-label">Si Max <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="si_max" id="si_max" value="{{ old('si_max') }}"  placeholder="Enter Su Max" />
                                @error('si_max')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div> -->

                            <div class="col-md-3">
                                <label class="form-label">CE Max <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="ce_max" id="ce_max" value="{{ old('ce_max') }}"  placeholder="Enter Su Max" />
                                @error('ce_max')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">YST Min <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="yst_min" id="yst_min" value="{{ old('yst_min') }}"  placeholder="Enter Yst Min" />
                                @error('yst_min')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">UTS Min<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="uts" id="uts" value="{{ old('uts') }}"  placeholder="Enter Uts" />
                                @error('uts')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">Elgn %<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="elgn" id="elgn" value="{{ old('elgn') }}"  placeholder="Enter Elgn" />
                                @error('elgn')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>



                        </div>
                        <div class="text-right mt-3 ml-3" style="margin-right: 750px;">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-file"></i>&nbsp;Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    $(document).ready(function() {
        $('#is_name').change(function() {
            var isName = $(this).val();
            if (isName) {
                $.ajax({
                    url: '{{ route("getGrades") }}',
                    type: 'POST', // Change the method to POST
                    data: {
                        _token: '{{ csrf_token() }}', // Add CSRF token for Laravel
                        is_name: isName
                    },
                    success: function(data) {
                        $('#grade').html('<option value="">Select</option>');
                        $.each(data, function(key, value) {
                            $('#grade').append('<option value="' + value.grade + '">' + value.grade + '</option>');
                        });
                    }
                });


                $.ajax({
                    url: '{{ route("getYST") }}',
                    type: 'POST', // Change the method to POST
                    data: {
                        _token: '{{ csrf_token() }}', // Add CSRF token for Laravel
                        is_name: isName
                    },
                    success: function(data) {
                         //console.log(data);

                        if (data=='N') {
                            $('#yst_min').val("NA");
                        }
                        else
                        {
                            $('#yst_min').val("");
                        }
                    }
                });
            } else {
                $('#grade').html('<option value="">Select</option>');
            }

        });
    });

</script>





@endsection
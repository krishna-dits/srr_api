@extends('layouts.layout')
@section('content')
<div class="col-xl-12 col-lg-12 col-md-12">
    <div class="border-0">
        <div class="tab-content">
            <div class="tab-pane active" id="tab-7">
                <div class="card">
                    <div class="card-body">
                        <h4 class="font-weight-bold">Application For Leave</h4>
                    </div>
                    @if (session()->has('success'))
                    <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        {{ Session::get('success') }}
                    </div>
                    @endif
                    @if (session()->has('error'))
                    <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                       {{ Session::get('error') }}
                    </div>
                    @endif

                    <form method="POST" action="{{route('hr-leave-application')}}">
                        @csrf
                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="form-label">Employee <span class="text-danger">*</span></label>

                                        <select  class="form-control" name="user_id" onchange="getAvilableleave()" id="user_id">
                                            <option value="">Select One</option>
                                            @if (isset($user_list))
                                                @foreach ($user_list as $value)
                                                    <option value="{{ @$value->id }}">{{ @$value->name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('user_id')
                                         <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Apply Date <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="apply_date">
                                        @error('apply_date')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Type <span class="text-danger">*</span></label>
                                        <select class="form-control" onchange="getAvilableleave()" name="leave_type" id="leave_type">
                                            <option value="">Select Leave Type..</option>
                                         @foreach(Config::get('static.leave_type') as $value)
                                            <option value="{{$value}}">{{$value}}</option>
                                         @endforeach

                                        </select>
                                        @error('leave_type')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 my-3">
                                        <label class="form-label">Single Day/Multiple Days <span class="text-danger">*</span></label>
                                        <select onchange="gettype(this.value)" class="form-control select2-show-search select2-hidden-accessible" name="single_day_multiple_day">
                                            <option value="">Select Leave Type..</option>
                                            <option value="single_day">Single Day</option>
                                            <option value="multiple_day">Multiple Days</option>
                                        </select>
                                        @error('single_day_multiple_day')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 my-5">
                                        <span id="leaveType_section" style="font-size: 1rem; font-weight:bold;"></span>
                                        <span class="badge badge-pill badge-primary" id="leaveType_value"></span>

                                    </div>
                                    {{-- <div class="col-md-4 my-3" id="sick">
                                        <label class="form-label">Pending Sick Leave<span class="text-danger"></span></label>
                                         <span class="badge badge-pill badge-primary">
                                            5
                                        </span>
                                    </div> --}}
                                    {{-- <div class="col-md-4 my-3" id="earn">
                                        <label class="form-label">Pending Earn Leave <span class="text-danger"></span></label>
                                        <span class="badge badge-pill badge-primary">
                                            4
                                        </span>
                                    </div> --}}
                                </div>

                                <div class="row" id="single_day">
                                    <div class="col-md-4">
                                        <label class="form-label">Date <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="singleDate">
                                        @error('singleDate')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Half Day/Full Day <span class="text-danger">*</span></label>
                                        <select class="form-control select2-show-search select2-hidden-accessible" name="half_day_full_day">
                                            <option value="full_day">Full Day</option>
                                            <option value="half_day">Half Days</option>
                                        </select>
                                        @error('half_day_full_day')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row" id="multiple_day">
                                    <div class="col-md-4">
                                        <label class="form-label">From Date <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="from_date">
                                        @error('from_date')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">To Date <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="to_date">
                                        @error('to_date')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <label class="form-label">Purpose<span class="text-danger">*</span></label>
                                        <textarea class="form-control" name="purpose"></textarea>
                                        @error('purpose')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Resume duty on <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="resume_duty_on">
                                        @error('resume_duty_on')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body border-top">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Need Permission From <span class="text-danger">*</span></label>
                                    <select name="permission_authority[]" multiple="multiple" class="multi-select select2-show-search">
                                        <option value="">Select One</option>
                                        @if($user_list)
                                        @foreach ($user_list as $value)
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    @error('permission_authority')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-body border-top">
                            <input type="submit" class="btn btn-success mt-3" value="Submit" />
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<script>
    function getAvilableleave()
    {
        var user_id_ =  $('#user_id').val();
        var leave_type_ =  $('#leave_type').val();
        $.ajax({
        url: "{{ route('getUserPendingLeaveRoute') }}",
        type: "post",
        data: {
            user_id: user_id_,
            leave_type: leave_type_,
            _token: '{{ csrf_token() }}',
        },
        dataType: 'json',
        success: function(res) {
            console.log(res);
            $('#leaveType_section').text(res.leave_type);
            $('#leaveType_value').text(res.data.leave_no);
        }
        });

    }
</script>
<script>
    function gettype(val) {

        $('#multiple_day').attr('style', 'display:none');
        $('#single_day').attr('style', 'display:none');
        if (val == 'multiple_day') {

            $('#multiple_day').removeAttr('style', true);
        }
        if (val == 'single_day') {
            $('#single_day').removeAttr('style', true);
        }
    }

    // function getLeaveType(val) {

    //     $('#sick').attr('style', 'display:none');
    //     $('#earn').attr('style', 'display:none');
    //     $('#casual').attr('style', 'display:none');

    //     if (val == 'earn') {

    //     $('#earn').removeAttr('style', true);

    //     }
    //     if (val == 'casual') {

    //         $('#casual').removeAttr('style', true);
    //     }

    //     if (val == 'sick') {

    //         $('#sick').removeAttr('style', true);
    //     }
    // }





</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>

    /* get pending leave details according to user and leave type */


    // $(document).ready(function() {
    // $('#user-dropdown').on('change', function() {
    // var user_id = this.value;

    // console.log(user_id);

    // $("#pending-leave-dropdown").html('');
    // $.ajax({
    // url:"{{url('user-leave-details')}}",
    // type: "POST",
    // data: {
    // user_id: user_id,
    // _token: '{{csrf_token()}}'
    // },
    // dataType : 'json',
    // success: function(result){
    // $('#pending-leave-dropdown').html('<option value=""></option>');
    // $.each(result,function(key,value){
    //     console.log(value.leave_type);
    // $("#pending-leave-dropdown").append('<option value="'+value.id+'">'+value.leave_type+'</option>');
    // });
    // $('#city-dropdown').html('<option value="">Select Leave Type First</option>');
    // }
    // });
    // });
    // });


    </script>
@endsection

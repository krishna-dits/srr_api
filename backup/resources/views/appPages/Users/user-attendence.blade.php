@extends('layouts.layout')
@section('content')



    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card">
             <!-- ================================ Alert Message ===================================== -->

            @if (session('success'))
            <div class="alert alert-success m-3" role="alert"><button type="button" class="close" data-dismiss="alert"
                    aria-hidden="true">×</button>{{ session('success') }}</div>
            @endif
            @if (session()->has('error'))
                <div class="alert alert-danger m-3" role="alert"><button type="button" class="close" data-dismiss="alert"
                        aria-hidden="true">×</button>{{ session('error') }}</div>
            @endif

            <!-- ================================ Alert Message ===================================== -->
            <div class="card-body">
                <form action="{{ route('User-Attendence') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <label class="form-label">Select Designations <span class="text-danger">*</span></label>
                            <select required class="form-control select2-show-search select2-hidden-accessible"
                                tabindex="-1" aria-hidden="true" name="select_designation">
                                <option value="" {{ @$deg_id == '' ? 'selected' : '' }}>Select Designations</option>
                                @foreach ($all_designations as $item)
                                    <option value="{{ $item->id }}" {{ @$deg_id == $item->id ? 'selected' : '' }}>
                                        {{ $item->designation_name }}</option>
                                @endforeach
                            </select>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Date <span class="text-danger">*</span></label>
                            <input type="date" @if (isset($attendence_date))
                               value="{{ date('Y-m-d',strtotime($attendence_date)) }}"
                            @endif required class="form-control" name="selected_attendence_date">
                            @error('selected_attendence_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Attendance Location <span class="text-danger">*</span></label>

                            <select class="form-control select2-show-search select2-hidden-accessible" name="attendence_location" id="attendence_location">
                                <option value="">Select Attendance Location</option>
                                @foreach ($all_locations as $location)
                                    <option value="{{$location->location_name}}"
                                        {{ @$location == $location->location_name ? 'selected' : '' }}>{{$location->location_name}}</option>
                                @endforeach
                            </select>

                            @error('selected_attendence_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-primary" style="margin-top: 26px;">Search</button>
                        </div>
                        <div class="col-md-3">
                            @if(isset($date_status))
                                <span style="color: #ff4d4d;font-size: 25px; font-weight: 500;">It's {{$date_status->offday_type}} !!</span>
                            @endif
                        </div>
                    </div>

                </form>
            </div>

            <form method="post" action="{{ route('add-attendence-for-user') }}">
                @csrf
                <input type="hidden" name="deg_id" value="{{ @$deg_id }}" />
                <input type="hidden" name="attendence_date" value="{{ @$attendence_date }}" />
                <input type="hidden" name="attendence_location" value="{{ @$attendence_location }}" />
                @if (isset($all_designations_user))
                <div class="card-body">
                    <table class="table table-striped table-bordered text-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">Sl No.</th>
                                <th scope="col">Username</th>
                                <th scope="col">Attendence</th>
                                <th scope="col">Attendence Location</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!$all_designations_user->isEmpty())
                                @foreach ($all_designations_user as $user)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $user->name }}({{ $user->emp_id }})
                                            @if ($user->attendence_type != null) <br><span class="badge badge-success">Attendence Already Given !!</span> @endif
                                        </td>
                                        <td>
                                            <div class="col-md-12 row">
                                                <div class="col-md-4">
                                                    <label class="custom-control custom-radio">
                                                        <input type="radio" onchange="" class="custom-control-input"
                                                            name="attendence[{{ $user->id }}]" value="present"
                                                            @if ($user->attendence_type == null) checked="" @endif
                                                            @if ($user->attendence_type == 'present') checked="" @endif>
                                                        <span class="custom-control-label">Present</span>
                                                    </label>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="custom-control custom-radio">
                                                        <input type="radio" class="custom-control-input"
                                                            name="attendence[{{ $user->id }}]" value="absent"
                                                            @if ($user->attendence_type == 'absent') checked="" @endif>
                                                        <span class="custom-control-label">Absent</span>
                                                    </label>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="custom-control custom-radio">
                                                        <input type="radio" class="custom-control-input"
                                                            name="attendence[{{ $user->id }}]" value="half_day"
                                                            @if ($user->attendence_type == 'half_day') checked="" @endif>
                                                        <span class="custom-control-label">Half Day</span>
                                                    </label>
                                                </div>
                                            </div>

                                        </td>
                                        <td>
                                          <span class="badge badge-primary badge-pill">{{$user->attendance_location}}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td colspan="7">
                                            No record found!
                                </td>
                            </tr>
                            @endif

                        </tbody>
                    </table>
                </div>

                <div class="card-body">
                    <div class="col-md-12">
                        <button class="btn btn-primary">Save Attendence</button>
                    </div>
                </div>
                @endif
            </form>
        </div>
    </div>

    <script src="{{ asset('public/assets/js/jquery-3.6.0.min.js') }}"></script>
@endsection

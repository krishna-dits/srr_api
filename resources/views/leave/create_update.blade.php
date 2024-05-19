@extends('layouts.layout')
@section('content')
    <div class="container-fluid">
        <div class="col-xl-12 col-lg-12 col-md-12">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger mt-3" role="alert">
                        {{ $error }}
                    </div>
                @endforeach
            @endif
            <div class="border-0">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab-7">
                        <form class="form-horizontal" enctype="multipart/form-data" method="POST" action="">
                            @csrf
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="font-weight-bold"><i class="fa fa-cube"></i> Leave Details</h5>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="form-label">Leave Description <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="leave_desc"
                                                placeholder="Eg, Provide a brief explanation of the reason for the leave, e.g., vacation, illness, family emergency, etc."
                                                required
                                                value="{{ old('leave_desc', isset($leave) ? $leave->leave_desc : '') }}">
                                            @error('leave_desc')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Leave Type </label>
                                            <select name="leave_type" id="" class="form-control">
                                                <option value="" selected disabled>Select a type</option>
                                                <option value="Annual Leave"
                                                    {{ isset($leave) && $leave->leave_type == 'Annual Leave' ? 'selected' : '' }}>
                                                    Annual Leave
                                                </option>
                                                <option value="Sick Leave"
                                                    {{ isset($leave) && $leave->leave_type == 'Sick Leave' ? 'selected' : '' }}>
                                                    Sick Leave
                                                </option>
                                                <option value="Maternity Leave"
                                                    {{ isset($leave) && $leave->leave_type == 'Maternity Leave' ? 'selected' : '' }}>
                                                    Maternity
                                                    Leave</option>
                                                <option value="Paternity Leave"
                                                    {{ isset($leave) && $leave->leave_type == 'Paternity Leave' ? 'selected' : '' }}>
                                                    Paternity
                                                    Leave</option>
                                                <option value="Unpaid Leave"
                                                    {{ isset($leave) && $leave->leave_type == 'Unpaid Leave' ? 'selected' : '' }}>
                                                    Unpaid Leave
                                                </option>
                                            </select>
                                            @error('leave_type')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Start Date <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" id="inputPassword3" name="from_date"
                                                placeholder="Password"
                                                value="{{ old('from_date', isset($leave) ? date('Y-m-d', strtotime($leave->from_date)) : '') }}"
                                                required>
                                            @error('from_date')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">End Date <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" id="inputPassword3" name="to_date"
                                                placeholder="Password" required
                                                value="{{ old('to_date', isset($leave) ? date('Y-m-d', strtotime($leave->to_date)) : '') }}">
                                            @error('to_date')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="yst">Number of Days<span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" name="total_days" placeholder="Eg, 2"
                                                value="{{ old('total_days', isset($leave) ? $leave->total_days : '') }}">
                                            @error('total_days')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                                <div class="card-body border-top">
                                    <button type="submit" class="btn btn-primary"><i
                                            class="fa fa-paper-plane"></i>Apply</button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    </div>

@endsection

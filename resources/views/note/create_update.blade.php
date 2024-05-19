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

                                    </div>
                                </div>
                                <div class="card-body border-top">
                                    <button type="submit" class="btn btn-primary"><i
                                            class="fa fa-paper-plane"></i>Save</button>

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

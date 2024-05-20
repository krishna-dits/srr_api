@extends('layouts.layout')
@section('content')
    <div class="container-fluid">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">

            @if (session('success'))
                <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert"
                        aria-hidden="true">×</button>{{ session('success') }}</div>
            @endif
            @if (session()->has('error'))
                <div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert"
                        aria-hidden="true">×</button>{{ session('error') }}</div>
            @endif

            <!--div-->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Raise Issue</div>
                </div>
                <div class="card-body">
                    <div class="">
                        <form class="row g-3" method="POST" action="">
                            @csrf
                            <div class="col-md-12">
                                <div class="row justify-content-center">
                                    <div class="col-md-12">
                                        <label class="form-label">Issue Description <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="issue_note" id="name"
                                            value="{{ old('issue_note', isset($issue) ? $issue['issue_note'] : '') }}"
                                            placeholder="Eg, I have some documents related issue." />
                                        @error('issue_note')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="text-right mt-3 ml-3">
                                        <button type="submit" class="btn btn-primary mt-3"><i
                                                class="fa fa-file"></i>&nbsp;Save</button>
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

    <script></script>
@endsection

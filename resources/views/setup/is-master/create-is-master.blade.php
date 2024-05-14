@extends('layouts.layout')
@section('content')
    <div class="container-fluid">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <!--div-->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Add Is Master</div>
                </div>
                <div class="card-body">
                    <div class="">
                        <form class="row g-3" method="POST" action="{{ route('is-master-save') }}">
                            @csrf
                            <div class="col-md-12">
                                <div class="row">

                                    <div class="col-md-2">
                                        <label class="form-label">Is Name <span class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control @error('is_name') is-invalid
                                        @enderror"
                                            name="is_name" placeholder="Is Name" value="{{ $IsName }}">
                                        @error('is_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Year <span class="text-danger">*</span></label>

                                        <input type="text" class="form-control" name="year" id="year"
                                            value="{{ old('year') }}" required placeholder="Enter Year" />
                                        @error('year')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">CM/L No <span class="text-danger">*</span></label>

                                        <input type="text" class="form-control" name="cml_no" id="cml_no"
                                            value="{{ old('cml_no') }}" required placeholder="Enter cml_no" />
                                        @error('cml_no')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">H/P <span class="text-danger">*</span></label>

                                        <input type="text" class="form-control" name="hp" id="hp"
                                            value="{{ old('hp') }}" required placeholder="Enter hp" />
                                        @error('hp')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>



                                    <div class="form-group col-md-3">
                                        <label for="type">Type <span class="text-danger">*</span></label>
                                        <select name="type" class="form-control select2-show-search" id="type"
                                            required>
                                            <option value="" for="type">type</option>
                                            @foreach (Config::get('static.type') as $lang => $types)
                                                <option value="{{ $types }}"> {{ $types }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('type')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="yst">YST <span class="text-danger">*</span></label>
                                        <select name="yst" class="form-control select2-show-search" id="yst"
                                            required>
                                            <option value="" for="yst">Select</option>
                                            @foreach (Config::get('static.YST') as $lang => $ysts)
                                                <option value="{{ $ysts }}"> {{ $ysts }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('yst')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="draft_exp">Drift Exp <span class="text-danger">*</span></label>
                                        <select name="drift_exp" class="form-control select2-show-search" id="drift_exp">
                                            <option value="" for="draft_exp">Select</option>
                                            @foreach (Config::get('static.Drift') as $lang => $Drift)
                                                <option value="{{ $Drift }}"> {{ $Drift }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('draft_exp')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="grade">Grade <span class="text-danger">*</span></label>
                                        <select name="grade" class="form-control select2-show-search" id="grade"
                                            required>
                                            <option value="" for="grade">Select</option>
                                            @foreach (Config::get('static.YST') as $lang => $ysts)
                                                <option value="{{ $ysts }}"> {{ $ysts }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('grade')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <!-- <div class="form-group col-md-3">
                                            <label for="grade">Uniformity Test <span class="text-danger">*</span></label>
                                            <select name="uniformity_test" class="form-control select2-show-search" id="uniformity_test" required>
                                                <option value="" for="uniformity_test">Select</option>
                                                @foreach (Config::get('static.Drift') as $lang => $ysts)
    <option value="{{ $ysts }}"> {{ $ysts }}
                                                </option>
    @endforeach
                                            </select>
                                            @error('uniformity_test')
        <small class="text-danger">{{ $message }}</small>
    @enderror
                                        </div> -->

                                    <!-- <div class="form-group col-md-3">
                                            <label for="grade">Adhesion Test <span class="text-danger">*</span></label>
                                            <select name="addition_test" class="form-control select2-show-search" id="addition_test" required>
                                                <option value="" for="addition_test">Select</option>
                                                @foreach (Config::get('static.Drift') as $lang => $ysts)
    <option value="{{ $ysts }}"> {{ $ysts }}
                                                </option>
    @endforeach
                                            </select>
                                            @error('addition_test')
        <small class="text-danger">{{ $message }}</small>
    @enderror
                                        </div> -->



                                </div>
                                <div class="">
                                    <button type="submit" class="btn btn-primary"><i
                                            class="fa fa-file"></i>&nbsp;Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
@endsection

@extends('layouts.layout')
@section('content')
<div class="container-fluid">
    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <!--div-->
        <div class="card">
            <div class="card-header">
                <div class="card-title">Add Coil Master</div>
            </div>
            <div class="card-body">
                <div class="">
                    <form class="row g-3" method="POST" action="{{ route('CoilMasterSave') }}">
                        @csrf
                        <div class="col-md-12">
                            <div class="row">

                                <div class="form-group col-md-3">
                                    <label for="coil_type">Type <span class="text-danger">*</span></label>
                                    <select name="coil_type" class="form-control select2-show-search" id="type" >
                                        <option value="" for="type">type</option>
                                        @foreach (Config::get('static.Coil_Type') as $lang => $types)
                                        <option value="{{ $types }}"> {{ $types }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('coil_type')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Indentification No <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="indentification_no" id="indentification_no" value="{{ old('indentification_no') }}"  placeholder="Enter Indentification No" />
                                    @error('indentification_no')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Heat No <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="hit_no" id="hit_no" value="{{ old('hit_no') }}"  placeholder="Enter Hit No" />
                                    @error('hit_no')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Heat No 1<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="hit_no1" id="hit_no1" value="{{ old('hit_no1') }}" placeholder="Enter Hit No" />
                                    @error('hit_no1')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Heat No 2<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="hit_no2" id="hit_no2" value="{{ old('hit_no2') }}" placeholder="Enter Hit No" />
                                    @error('hit_no2')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Heat No 3<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="hit_no3" id="hit_no3" value="{{ old('hit_no3') }}" placeholder="Enter Hit No" />
                                    @error('hit_no3')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Heat No 4<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="hit_no4" id="hit_no4" value="{{ old('hit_no4') }}" placeholder="Enter Hit No" />
                                    @error('hit_no4')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-3">
                                    <label class="form-label">Carbon <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="carbon" id="carbon" value="{{ old('carbon') }}"  placeholder="Enter Carbon" />
                                    @error('carbon')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Mangnese <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="mangnese" id="mangnese" value="{{ old('mangnese') }}"  placeholder="Enter Mangnese" />
                                    @error('mangnese')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Phosphorus <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="Phosphorus" id="Phosphorus" value="{{ old('Phosphorus') }}"  placeholder="Enter Phosphorus" />
                                    @error('Phosphorus')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Sulphur <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="sulphur" id="sulphur" value="{{ old('sulphur') }}"  placeholder="Enter Sulphur" />
                                    @error('sulphur')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                               

                                <div class="col-md-3">
                                    <label class="form-label">Carbon Equivalent<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="carbon_equivalent" id="carbon_equivalent" value="{{ old('carbon_equivalent') }}"  placeholder="Enter Carbon Equivalent" />
                                    @error('carbon_equivalent')
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

@endsection
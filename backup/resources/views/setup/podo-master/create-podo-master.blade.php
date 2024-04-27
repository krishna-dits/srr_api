@extends('layouts.layout')
@section('content')
<div class="container-fluid">
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <!--div-->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Add Po/Do Master</div>
        </div>
        <div class="card-body">
            <div class="">
                <form class="row g-3" method="POST" action="{{ route('PoDoMasterSave') }}">
                    @csrf
                    <div class="col-md-12">
                        <div class="row">

                            <div class="col-md-3">
                                <label class="form-label">Id<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="podo_id" placeholder="Id" value="{{$PoDoNumber}}" readonly>
                                @error('podo_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">Type<span class="text-danger">*</span></label>
                                <select class="form-control select2-show-search select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="type">
                                    <option value="">Select</option>
                                    @foreach (Config::get('static.Podo_Type') as $lang => $types)
                                    <option value="{{ $types }}"> {{ $types }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('type')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Init <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="init" id="init" value="{{ old('init') }}" required placeholder="Enter Init" />
                                @error('init')
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
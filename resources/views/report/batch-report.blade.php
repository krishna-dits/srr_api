@extends('layouts.layout')
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<div class="container-fluid">
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Batch Master Report</div>
        </div>
        <div class="card-body p-0">
            <div class="row no-gutters">
                <div class="col-md-12">
                    <div class="row no-gutters">
                        <div class="col-md-12 border-right">
                            <form method="POST" action="{{ route('ShowBatchReport') }}">
                                @csrf
                                <div class="col-md-12">

                                    <div class="row">

                                        <div class="form-group col-md-1 emgregischeck" style="margin-top: 10px;">
                                            <label class="form-label">Request Type<span class="text-danger">*</span></label>
                                            <input type="radio" name="request_type" value="all" required><span class="font-weight-bold;">All</span>
                                            <input type="radio" name="request_type" value="select" required><span class="font-weight-bold;">Select</span>
                                            @error('request_type')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Batch Id<span class="text-danger">*</span></label>
                                            <select class="form-control select2-show-search select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="batch_id">
                                                <option value="">Select</option>
                                                @foreach ($batch_report as $item)
                                                <option value="{{ $item->batch_id }}">{{ $item->batch_id }}</option>
                                                @endforeach
                                            </select>
                                            @error('batch_id')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Is No<span class="text-danger">*</span></label>
                                            <select class="form-control select2-show-search select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="is_name">
                                                <option value="">Select</option>
                                                @foreach ($batch_report as $item)
                                                <option value="{{ $item->is_name }}">{{ $item->is_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('is_name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <button class="btn btn-primary mt-4 mb-3" style="margin-left: 429px"><i class="fa fa-search"></i> Search</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap" id="example">
                        <thead>
                            <tr>
                                <th scope="col">Sl No. </th>
                                <th scope="col">Batch Id</th>
                                <th scope="col">Batch No</th>
                                <th scope="col">Lot No</th>
                                <th scope="col">Descriptation</th>
                                <th scope="col">Is Nmae</th>
                                <th scope="col">Sift</th>
                                <th scope="col">Mill Date</th>
                                <th scope="col">Coil No</th>
                                <th scope="col">Is Size</th>
                                <th scope="col">Thickness</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if (@$batch_reports[0]->id != null)
                            @foreach ($batch_reports as $item)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{$item->batch_id}}</td>
                                <td>{{$item->batch_no}}</td>
                                <td>{{$item->lot_no}}</td>
                                <td>{{$item->descriptation}}</td>
                                <td>{{$item->is_name}}</td>
                                <td>{{$item->shift}}</td>
                                <td>{{$item->mill_date}}</td>
                                <td>{{$item->coil_no}}</td>
                                <td>{{$item->size}}</td>
                                <td>{{$item->thickness}}</td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


@endsection
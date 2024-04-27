@extends('layouts.layout')
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<div class="container-fluid">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Tc Report</div>
            </div>
            <div class="card-body p-0">
                <div class="row no-gutters">
                    <div class="col-md-12">
                        <div class="row no-gutters">
                            <div class="col-md-12 border-right">
                                <form method="POST" action="{{ route('ShowTcReport') }}">
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
                                                <label class="form-label">Tc No<span class="text-danger">*</span></label>
                                                <select class="form-control select2-show-search select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="tc_id">
                                                    <option value="">Select</option>
                                                    @foreach ($tc_report as $item)
                                                    <option value="{{ $item->tc_id }}">{{ $item->tc_id }}</option>
                                                    @endforeach
                                                </select>
                                                @error('tc_id')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="col-md-2">
                                                <label class="form-label">Is No<span class="text-danger">*</span></label>
                                                <select class="form-control select2-show-search select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="is_no">
                                                    <option value="">Select</option>
                                                    @foreach ($tc_report as $item)
                                                    <option value="{{ $item->is_no }}">{{ $item->is_no }}</option>
                                                    @endforeach
                                                </select>
                                                @error('is_no')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="col-md-3">
                                                <label class="form-label">Customer Id<span class="text-danger">*</span></label>
                                                <select class="form-control select2-show-search select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="cus_id">
                                                    <option value="">Select</option>
                                                    @foreach ($customer as $item)
                                                    <option value="{{ $item->id }}">{{ $item->cus_id }}</option>
                                                    @endforeach
                                                </select>
                                                @error('tc_id')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="col-md-3">
                                                <label class="form-label"> Invoice No <span class="text-danger">*</span></label>
                                                <select class="form-control select2-show-search select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="invoice_no">
                                                    <option value="">Select Invoice No</option>
                                                    @foreach ($tc_report as $item)
                                                    <option value="{{ $item->invoice_no }}">{{ $item->invoice_no }}</option>
                                                    @endforeach
                                                </select>
                                                @error('invoice_no')
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
                                    <th scope="col">Tc Id</th>
                                    <th scope="col">Invoice No</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Is No</th>
                                    <th scope="col">Part</th>
                                    <th scope="col">Vehicle</th>
                                    <th scope="col">product</th>
                                    <th scope="col">Po/Do Init</th>
                                    <th scope="col">Value</th>
                                    <th scope="col">Unit</th>
                                    <th scope="col">CM/L No</th>
                                    <th scope="col">ConformToIs</th>
                                    <th scope="col">ConformToIs Date</th>
                                    <th scope="col">NDT/HP</th>
                                    <th scope="col">Address1</th>
                                    <th scope="col">Address2</th>
                                    <th scope="col">Tc No</th>
                                    <th scope="col">Tc Date</th>
                                    <th scope="col">Po/Do No</th>
                                    <th scope="col">Po/Do Date</th>
                                </tr>
                            </thead>
                            <tbody>

                                @if (@$tc_reports[0]->id != null)
                                @foreach ($tc_reports as $item)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{$item->tc_id}}</td>
                                    <td>{{$item->invoice_no}}</td>
                                    <td>{{$item->type}}</td>
                                    <td>{{$item->is_no}}</td>
                                    <td>{{$item->part_no}}</td>
                                    <td>{{$item->vehicleno}}</td>
                                    <td>{{$item->product}}</td>
                                    <td>{{$item->podo_init}}</td>
                                    <td>{{$item->podo_value}}</td>
                                    <td>{{$item->unit}}</td>
                                    <td>{{$item->cml_no}}</td>
                                    <td>{{$item->conformToIs}}</td>
                                    <td>{{$item->date1}}</td>
                                    <td>{{$item->hp}}</td>
                                    <td>{{$item->address1}}</td>
                                    <td>{{$item->address2}}</td>
                                    <td>{{$item->tc_no}}</td>
                                    <td>{{$item->date2}}</td>
                                    <td>{{$item->podo_no}}</td>
                                    <td>{{$item->date3}}</td>
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
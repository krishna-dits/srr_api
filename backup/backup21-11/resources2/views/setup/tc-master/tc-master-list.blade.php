@extends('layouts.layout')
@section('content')
<div class="container-fluid">
    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">


        <div class="card">
            <div class="card-header d-block">
                <div class="row">
                    <div class="col-md-6 card-title">
                        Tc Master List
                    </div>

                    <div class="col-md-6 text-right">
                        <div class="d-block">

                            @can('Create Tc Master')
                            <td><a href="{{ route('TcMasterAdd') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Tc Master</a></td>
                            @endcan

                        </div>
                    </div>
                </div>
            </div>
            <!-- ================================ Alert Message===================================== -->

            @if (session('success'))
            <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('success')}}</div>
            @endif
            @if (session()->has('error'))
            <div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('error')}}</div>
            @endif

            <!-- ================================ Alert Message===================================== -->

            <div class="card-body">
                <table id="example" class="table table-borderless text-nowrap key-buttons">
                    <thead>
                        <tr>
                            <th scope="col">Sl No. </th>
                            <th scope="col">Tc Id</th>
                            <th scope="col">Invoice No</th>
                            <th scope="col">Type</th>
                            <th scope="col">Is No</th>
                            <th scope="col">Vehicle</th>
                            <th scope="col">product</th>
                            <th scope="col">Po/Do Init</th>
                            <th scope="col">Value</th>
                            <th scope="col">Unit</th>
                            <th scope="col">TC Details</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($tc_list))
                        @foreach($tc_list as $item)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{$item->tc_id}}</td>
                            <td>{{$item->invoice_no}}</td>
                            <td>{{$item->type}}</td>
                            <td>{{$item->is_no}}</td>
                            <td>{{$item->vehicleno}}</td>
                            <td>{{$item->product}}</td>
                            <td>{{$item->podo_init}}</td>
                            <td>{{$item->podo_value}}</td>
                            <td>{{$item->unit}}</td>
                            <td>
                                @php
                                $total_tcdetails=DB::Table('tc_details')->where('tc_id',$item->tc_id)->count();

                                @endphp
                                @if($total_tcdetails<1)

                                <a href="{{ route('TcMasterDetailsSave', ['id' => base64_encode($item->id)]) }}" type="submit" class="btn btn-success btn-sm"><i class="fa fa-plus"></i>&nbsp;TC Details</a></td>
                                @endif


                            <td>
                                <div class="card-options">
                                    <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right" style="">

                                        <!-- <a class="dropdown-item" href="{{route('TcMasterEdit',base64_encode($item->id))}}"><i class="fa fa-edit"></i> Edit</a> -->

                                        <a class="dropdown-item" href="{{route('TcMasterDelete',base64_encode($item->id))}}"><i class="fa fa-trash"></i> Delete</a>

                                        <a class="dropdown-item" href="{{route('TcMasterPrint',base64_encode($item->id))}}"><i class="fa fa-print"></i> Print</a>

                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>

            </div>


        </div>
    </div>
</div>


<script src="{{ asset('public/assets/js/jquery-3.6.0.min.js') }}"></script>
@endsection
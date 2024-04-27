@extends('layouts.layout')
@section('content')
<div class="container-fluid">
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">

    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    Coil Master List
                </div>

                <div class="col-md-6 text-right">
                    <div class="d-block">

                        @can('Create Coil Master')
                        <td><a href="{{ route('CoilMasterAdd') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Coil Master</a></td>
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
                        <!-- <th scope="col">Coil No</th> -->
                        <!-- <th scope="col">Coil Type</th> -->
                        <th scope="col">Indectification No</th>
                        <th scope="col">Carbon</th>
                        <th scope="col">Mangnese</th>
                        <th scope="col">Phosphorus</th>
                        <th scope="col">sulphur</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($size_master))
                    @foreach($size_master as $item)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <!-- <td>{{$item->coil_no}}</td> -->
                        <!-- <td>{{$item->coil_type}}</td> -->
                        <td>{{$item->indentification_no}}</td>
                        <td>{{$item->carbon}}</td>
                        <td>{{$item->mangnese}}</td>
                        <td>{{$item->Phosphorus}}</td>
                        <td>{{$item->sulphur}}</td>
                        <td>
                            <div class="card-options">
                                <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                <div class="dropdown-menu dropdown-menu-right" style="">

                                    <a class="dropdown-item" href="{{route('CoilMasterEdit',base64_encode($item->id))}}"><i class="fa fa-edit"></i> Edit</a>

                                    <a class="dropdown-item" href="{{route('CoilMasterDelete',base64_encode($item->id))}}"><i class="fa fa-trash"></i> Delete</a>

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
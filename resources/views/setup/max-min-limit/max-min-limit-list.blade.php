@extends('layouts.layout')
@section('content')
<div class="container-fluid">
    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">

        <div class="card">
            <div class="card-header d-block">
                <div class="row">
                    <div class="col-md-6 card-title">
                        Max Min Limit List
                    </div>

                    <div class="col-md-6 text-right">
                        <div class="d-block">

                            @can('Create Grade Master')
                            <td><a href="{{ route('MaxMinLimitAdd') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Max Min Limit</a></td>
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
                            <th scope="col">Is Name</th>
                            <th scope="col">Grade</th>
                            <th scope="col">C Max</th>
                            <th scope="col">Mn Max</th>
                            <th scope="col">Su Max</th>
                            <th scope="col">Ph Max</th>
                            <th scope="col">Si Max</th>
                            <th scope="col">Ce Max</th>
                            <th scope="col">Yst Min</th>
                            <th scope="col">Uts</th>
                            <th scope="col">Elgn</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($size_master))
                        @foreach($size_master as $item)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{$item->is_name}}</td>
                            <td>{{$item->grade}}</td>
                            <td>{{$item->c_max}}</td>
                            <td>{{$item->mn_max}}</td>
                            <td>{{$item->su_max}}</td>
                            <td>{{$item->ph_max}}</td>
                            <td>{{$item->si_max}}</td>
                            <td>{{$item->ce_max}}</td>
                            <td>{{$item->yst_min}}</td>
                            <td>{{$item->uts}}</td>
                            <td>{{$item->elgn}}</td>
                            <td>
                                <div class="card-options">
                                    <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right" style="">

                                        <a class="dropdown-item" href="{{route('MaxMinLimitEdit',base64_encode($item->id))}}"><i class="fa fa-edit"></i> Edit</a>

                                        <a class="dropdown-item" href="{{route('MaxMinLimitDelete',base64_encode($item->id))}}"><i class="fa fa-trash"></i> Delete</a>

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
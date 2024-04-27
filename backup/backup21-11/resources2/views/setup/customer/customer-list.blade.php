@extends('layouts.layout')
@section('content')

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">

    <div class="card">
        <!-- <div class="card-header">
            <h4 class="card-title">Customer List</h4>
        </div> -->

        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    Customer List
                </div>

                <div class="col-md-6 text-right">
                    <div class="d-block">

                        @can('Create Customer')
                        <td><a href="{{ route('Customer-add') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Customer</a></td>
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
                        <th scope="col">Customer Id</th>
                        <th scope="col">Customer Name</th>
                        <th scope="col">Address1</th>
                        <th scope="col">Address2</th>
                        <th scope="col"> Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($customer))
                    @foreach($customer as $item)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{$item->cus_id}}</td>
                        <td>{{$item->cus_name}}</td>
                        <td>{{$item->address1}}</td>
                        <td>{{$item->address2}}</td>
                        <td>
                            <div class="card-options">
                                <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                <div class="dropdown-menu dropdown-menu-right" style="">
                                    @if(auth()->user()->can('user edit') || $item->id == Auth::id())
                                    <a class="dropdown-item" href="{{route('Customer-edit',base64_encode($item->id))}}"><i class="fa fa-edit"></i> Edit</a>
                                    @endif

                                    <!-- @can('user delete') -->
                                    @if($item->id != Auth::id())
                                    <a class="dropdown-item" href="{{route('Customer-delete',base64_encode($item->id))}}"><i class="fa fa-trash"></i> Delete</a>
                                    @endif
                                    <!-- @endcan -->
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

<script src="{{ asset('public/assets/js/jquery-3.6.0.min.js') }}"></script>
@endsection
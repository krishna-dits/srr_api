@extends('layouts.layout')
@section('content')
<div class="container-fluid">
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">

    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    Po/Do Master List
                </div>

                <div class="col-md-6 text-right">
                    <div class="d-block">

                        @can('Create PoDo Master')
                        <td><a href="{{ route('PoDoMasterAdd') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Po/Do Master</a></td>
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
                        <th scope="col">PO/DO Id</th>
                        <th scope="col">Type</th>
                        <th scope="col">Init</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($size_master))
                    @foreach($size_master as $item)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{$item->podo_id}}</td>
                        <td>{{$item->type}}</td>
                        <td>{{$item->init}}</td>


                        <td>
                            <div class="card-options">
                                <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                <div class="dropdown-menu dropdown-menu-right" style="">

                                    <a class="dropdown-item" href="{{route('PoDoMasterEdit',base64_encode($item->id))}}"><i class="fa fa-edit"></i> Edit</a>

                                    <a class="dropdown-item" href="{{route('PoDoMasterDelete',base64_encode($item->id))}}"><i class="fa fa-trash"></i> Delete</a>

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
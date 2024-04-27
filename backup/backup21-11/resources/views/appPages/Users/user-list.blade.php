@extends('layouts.layout')
@section('content')
<div class="container-fluid">
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">User List</h4>
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
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>

                        <th scope="col">Status</th>
                        <!-- @can('user profile || user active deactive || user edit || user delete') -->

                        <!-- @endcan -->
                        <th scope="col"> Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($all_user))
                    @foreach($all_user as $item)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td><img alt="" style="height:25px;width: 25px" class="rounded-circle" src="{{ asset('public/profile_picture') }}/{{$item->profile_image}}"> {{ @$item->name }}</td>
                        <td>{{ @$item->email }}</td>
                        <td>
                            @if($item->is_active == '1')
                            <span class="badge badge-success">Enable</span>
                            @else
                            <span class="badge badge-secondary">Disable</span>
                            @endif

                        </td>

                        <!-- @can('user profile || user active deactive || user edit || user delete') -->

                        <!-- @endcan -->
                        <td>
                            <div class="card-options">
                                <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                <div class="dropdown-menu dropdown-menu-right" style="">
                                    <!-- @can('user profile') -->
                                    <a class="dropdown-item" href="{{route('user-profile')}}/{{base64_encode($item->id)}}"><i class="fa fa-eye"></i> View</a>
                                    <!-- @endcan -->

                                    @can('user active deactive')
                                    @if($item->id != Auth::id())
                                    <a class="dropdown-item" href="{{route('user-enable-disable',base64_encode($item->id))}}"><i class="fa fa-user-circle"></i> Enable/Disable</a>
                                    @endif
                                    @endcan

                                    @if(auth()->user()->can('user edit') || $item->id == Auth::id())
                                    <a class="dropdown-item" href="{{route('user-edit',base64_encode($item->id))}}"><i class="fa fa-edit"></i> Edit</a>
                                    @endif

                                    <!-- @can('user delete') -->
                                    @if($item->id != Auth::id())
                                    <a class="dropdown-item" href="{{route('user-delete',base64_encode($item->id))}}"><i class="fa fa-trash"></i> Delete</a>
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

</div>

<script src="{{ asset('public/assets/js/jquery-3.6.0.min.js') }}"></script>
@endsection
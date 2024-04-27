@extends('layouts.layout')
@section('content')

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Attendence</h4>
        </div>

<div class="card-body">
    <div>
        <form action="{{ route('User-Attendence') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <label class="form-label">Select Designations <span class="text-danger">*</span></label>
                    <select required class="form-control select2-show-search select2-hidden-accessible"
                        tabindex="-1" aria-hidden="true" name="select_designation">
                        <option value="" {{ @$deg_id == '' ? 'selected' : '' }}>Select Designations</option>
                        @foreach ($all_designations as $item)
                            <option value="{{ $item->id }}" {{ @$deg_id == $item->id ? 'selected' : '' }}>
                                {{ $item->designation_name }}</option>
                        @endforeach
                    </select>
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Date <span class="text-danger">*</span></label>
                    <input type="date" @if (isset($attendence_date))
                       value="{{ date('Y-m-d',strtotime($attendence_date)) }}"
                    @endif required class="form-control" name="selected_attendence_date">
                    @error('selected_attendence_date')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-4">
                    <button class="btn btn-primary" style="margin-top: 26px;">Search</button>
                </div>
            </div>
        </form>
    </div>
    <table id="example" class="table table-borderless text-nowrap key-buttons">
        <thead>
            <tr>
                <th scope="col">Sl No.</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Designation</th>
                <th scope="col">Status</th>
                @can('user profile || user active deactive || user edit || user delete')
                 <th scope="col"> Action</th>
                @endcan
            </tr>
        </thead>
        <tbody>
            @if(isset($all_user))
            @foreach($all_user as $item)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td><img alt="User Avatar" style="height:25px;width: 25px" class="rounded-circle" src="{{ asset('public/profile_picture') }}/{{$item->profile_image}}" >  {{ @$item->name }}</td>
                <td>{{ @$item->email }}</td>
                <td>{{ @$item->role_as }}</td>
                <td>
                @if($item->is_active == '1')
                  <span class="badge badge-success">Enable</span>
                @else
                  <span class="badge badge-secondary">Disable</span>
                @endif

                </td>

                @can('user profile || user active deactive || user edit || user delete')
                <td>
                    <div class="card-options">
                        <a href="#"  class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                        <div class="dropdown-menu dropdown-menu-right" style="">
                        @can('user profile')
                            <a class="dropdown-item" href="{{route('user-profile')}}/{{base64_encode($item->id)}}"><i class="fa fa-eye"></i>  View</a>
                        @endcan
                        @can('user active deactive')
                        @if($item->id != Auth::id())
                            <a class="dropdown-item" href="{{route('user-enable-disable',base64_encode($item->id))}}"><i class="fa fa-user-circle-o"></i> Enable/Disable</a>
                        @endif
                        @endcan

                        @if(auth()->user()->can('user edit') || $item->id == Auth::id())
                            <a class="dropdown-item" href="{{route('user-edit',base64_encode($item->id))}}"><i class="fa fa-pencil"></i> Edit</a>
                        @endif

                        @can('user delete')
                        @if($item->id != Auth::id())
                            <a class="dropdown-item" href="{{route('user-delete',base64_encode($item->id))}}"><i class="fa fa-trash"></i>  Delete</a>
                        @endif
                        @endcan
                        </div>
                    </div>
                </td>
                @endcan
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

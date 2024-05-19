@extends('layouts.layout')
@section('content')
    <div class="container-fluid">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">

            <div class="border-0">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab-7">
                        <form class="form-horizontal" enctype="multipart/form-data" method="POST" action="">
                            @csrf
                            <div class="card">
                                <div class="card-body">
                                    {{-- <h5 class="font-weight-bold"><i class="fa fa-cube"></i> User Details</h5> --}}
                                    <div class="row">

                                        <div class="form-group col-md-5">
                                            <label for="yst">User <span class="text-danger">*</span></label>
                                            <select name="user" class="form-control select2-show-search" id="yst">
                                                <option value="" selected disabled>Select an user</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}"
                                                        {{ isset($request) && $request->user == $user->id ? 'selected' : '' }}>
                                                        {{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('user_ids')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="col-md-5">
                                            <label class="form-label">Status</label>
                                            <select name="status" class="form-control select2-show-search">
                                                <option value="" selected disabled>Selecte a status</option>

                                                <option value="0"
                                                    {{ isset($request) && $request->status == '0' ? 'selected' : '' }}>
                                                    Pending</option>

                                                <option value="1"
                                                    {{ isset($request) && $request->status == '1' ? 'selected' : '' }}>
                                                    Approved</option>

                                                <option value="2"
                                                    {{ isset($request) && $request->status == '2' ? 'selected' : '' }}>
                                                    Decline</option>

                                            </select>
                                            @error('description')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-2 mt-5">
                                            <button class="btn btn-primary" type="submit">Filter</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">All Leaves</h4>
                </div>
                <!-- ================================ Alert Message===================================== -->

                @if (session('success'))
                    <div class="alert alert-success" role="alert"><button type="button" class="close"
                            data-dismiss="alert" aria-hidden="true">×</button>{{ session('success') }}</div>
                @endif
                @if (session()->has('error'))
                    <div class="alert alert-danger" role="alert"><button type="button" class="close"
                            data-dismiss="alert" aria-hidden="true">×</button>{{ session('error') }}</div>
                @endif

                <!-- ================================ Alert Message===================================== -->

                <div class="card-body">
                    <table id="example" class="table table-borderless text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th scope="col">Sl No. </th>
                                <th scope="col">Name</th>
                                <th scope="col">From Date</th>
                                <th scope="col">To Date</th>
                                <th scope="col">Total Days</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($leaves))
                                @foreach ($leaves as $item)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $item['getUser']['name'] ?? 'N/A' }}</td>
                                        <td>{{ date('d-m-Y', strtotime($item->from_date)) }}</td>
                                        <td>{{ date('d-m-Y', strtotime($item->to_date)) }}</td>
                                        <td>{{ $item->total_days }}</td>

                                        {{-- <td>
                                            @if ($item->status == '0')
                                                Pending
                                            @elseif($item->status == '1')
                                                Approved
                                            @else
                                                Decline
                                            @endif
                                        </td> --}}

                                        <td>
                                            <select class="" value="">
                                                <option value="0" onclick="statusChange({{ $item->id }}, value)"
                                                    {{ $item->status == '0' ? 'selected' : '' }}>Pending
                                                </option>
                                                <option value="1" {{ $item->status == '1' ? 'selected' : '' }}
                                                    onclick="statusChange({{ $item->id }}, value)">
                                                    Approved</option>
                                                <option value="2" {{ $item->status == '2' ? 'selected' : '' }}
                                                    onclick="statusChange({{ $item->id }}, value)">Decline
                                                </option>
                                            </select>
                                        </td>

                                        <td>
                                            <div class="card-options">
                                                <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">Action <i
                                                        class="fa fa-caret-down"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right" style="">
                                                    <a class="dropdown-item"
                                                        href="{{ route('leaves_details', ['id' => $item->id]) }}" target="_sdf"><i
                                                            class="fa fa-info"></i>&nbsp; Details</a>
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

    <script>
        function statusChange(id, status) {
            console.log(123546789);
            fetch(`{{ url('/') }}` + '/leave/status/' + id + '/' + status)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    // console.log('Data:', data);

                    if (data.success === '1') {
                        swal("Done", data.message, "success");
                    }
                })
                .catch(error => {
                    console.error('There was a problem with the fetch operation:', error);
                });
        }
    </script>
@endsection

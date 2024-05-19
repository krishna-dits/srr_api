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

                                        <div class="col-md-3">
                                            <label class="form-label">Category<span class="text-danger">*</span></label>
                                            <select name="category_id" class="form-control">
                                                <option value="" selected disabled>Selecte a category</option>
                                                <option value="Admin"
                                                    {{ isset($request) && $request->category_id == 'Admin' ? 'selected' : '' }}>
                                                    Admin
                                                </option>
                                                <option value="Office"
                                                    {{ isset($request) && $request->category_id == 'Office' ? 'selected' : '' }}>
                                                    Office</option>
                                                <option value="Logistic"
                                                    {{ isset($request) && $request->category_id == 'Logistic' ? 'selected' : '' }}>
                                                    Logistic</option>
                                                <option value="Tender"
                                                    {{ isset($request) && $request->category_id == 'Tender' ? 'selected' : '' }}>
                                                    Tender</option>
                                            </select>
                                            @error('title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Status</label>
                                            <select name="status" class="form-control">
                                                <option value="" selected disabled>Selecte a status</option>
                                                <option value="Yet to start"
                                                    {{ isset($request) && $request->status == 'Yet to start' ? 'selected' : '' }}>
                                                    Yet to start</option>
                                                <option value="In progress"
                                                    {{ isset($request) && $request->status == 'In progress' ? 'selected' : '' }}>
                                                    In progress</option>
                                                <option value="Completed"
                                                    {{ isset($request) && $request->status == 'Completed' ? 'selected' : '' }}>
                                                    Completed</option>
                                            </select>
                                            @error('description')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Priority</label>
                                            <select name="priority" id="" class="form-control">
                                                <option value="" selected disabled>Select priority</option>
                                                <option value="high"
                                                    {{ isset($request) && $request->priority == 'high' ? 'selected' : '' }}>
                                                    High</option>
                                                <option value="medium"
                                                    {{ isset($request) && $request->priority == 'medium' ? 'selected' : '' }}>
                                                    Medium</option>
                                                <option value="low"
                                                    {{ isset($request) && $request->priority == 'low' ? 'selected' : '' }}>
                                                    Low</option>
                                            </select>
                                            @error('description')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-3 mt-5 text-center">
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
                    <h4 class="card-title">Task List</h4>
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
                                <th scope="col">Title</th>
                                <th scope="col">Start Date</th>
                                <th scope="col">End Date</th>
                                <th scope="col">Members</th>
                                <th scope="col">Document</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($tasks))
                                @foreach ($tasks as $item)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ @$item->title }}</td>
                                        <td>{{ date('d-m-Y', strtotime($item->start_date)) }}</td>
                                        <td>{{ date('d-m-Y', strtotime($item->end_date)) }}</td>

                                        <td>
                                            @foreach ($item['user_names'] as $name)
                                                <span class="heading-inverse bg-primary rounded">{{ $name['name'] }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @if ($item['document'])
                                                <a href="{{ $item['document'] }}" download>
                                                    View document
                                                </a>
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>
                                            <select>
                                                <option value="Yet to start"
                                                    onclick="statusChange({{ $item->id }}, value)"
                                                    {{ $item->status == 'Yet to start' ? 'selected' : '' }}>Yet to start
                                                </option>
                                                <option value="In progress"
                                                    onclick="statusChange({{ $item->id }}, value)"
                                                    {{ $item->status == 'In progress' ? 'selected' : '' }}>In progress
                                                </option>
                                                <option value="Completed"
                                                    onclick="statusChange({{ $item->id }}, value)"
                                                    {{ $item->status == 'Completed' ? 'selected' : '' }}>Completed
                                                </option>
                                            </select>
                                        </td>

                                        <td>
                                            <div class="card-options">
                                                <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">Action <i
                                                        class="fa fa-caret-down"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right" style="">
                                                    @if (auth()->user()->can('user edit') || $item->id == Auth::id())
                                                        <a class="dropdown-item"
                                                            href="{{ route('update_task', ['id' => $item->id]) }}"><i
                                                                class="fa fa-edit"></i> Edit</a>
                                                    @endif

                                                    <a class="dropdown-item"
                                                        href="{{ route('delete_task', ['id' => $item->id]) }}"><i
                                                            class="fa fa-trash"></i> Delete</a>
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
            console.log(78956);
            fetch(`{{ url('/') }}` + '/task/status/' + id + '/' + status)
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

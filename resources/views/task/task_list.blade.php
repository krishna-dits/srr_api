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
                    <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert"
                            aria-hidden="true">×</button>{{ session('success') }}</div>
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
                                            <a href="">
                                                View document
                                            </a>
                                        </td>
                                        <td>
                                            <select onchange="statusChange({{ $item->id }}, value)">
                                                <option value="Yet to start"
                                                    {{ $item->status == 'Yet to start' ? 'selected' : '' }}>Yet to start
                                                </option>
                                                <option value="In progress"
                                                    {{ $item->status == 'In progress' ? 'selected' : '' }}>In progress
                                                </option>
                                                <option value="Completed"
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
                                                    @can('user active deactive')
                                                        @if ($item->id != Auth::id())
                                                            <a class="dropdown-item"
                                                                href="{{ route('user-enable-disable', base64_encode($item->id)) }}"><i
                                                                    class="fa fa-user-circle"></i> Enable/Disable</a>
                                                        @endif
                                                    @endcan

                                                    @if (auth()->user()->can('user edit') || $item->id == Auth::id())
                                                        <a class="dropdown-item"
                                                            href="{{ route('update_task', ['id' => $item->id]) }}"><i
                                                                class="fa fa-edit"></i> Edit</a>
                                                    @endif

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
            fetch(`{{ url('/') }}` + '/task/status/' + id + '/' + status)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    // console.log('Data:', data);

                    if (data.success == 1) {
                        swal("Done", data.message, "success");
                    }
                })
                .catch(error => {
                    console.error('There was a problem with the fetch operation:', error);
                });

        }
    </script>
@endsection

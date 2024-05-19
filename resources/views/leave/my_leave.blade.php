@extends('layouts.layout')
@section('content')
    <div class="container-fluid">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">My Leaves</h4>
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
                                <th scope="col">Description</th>
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
                                        <td>{{ substr($item->leave_desc, 0, 30) . '...' }}</td>
                                        <td>{{ date('d-m-Y', strtotime($item->from_date)) }}</td>
                                        <td>{{ date('d-m-Y', strtotime($item->to_date)) }}</td>
                                        <td>{{ $item->total_days }}</td>
                                        <td>
                                            @if ($item->status == '0')
                                                Pending
                                            @else
                                                Approved
                                            @endif
                                        </td>

                                        <td>
                                            <div class="card-options">
                                                <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">Action <i
                                                        class="fa fa-caret-down"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right" style="">
                                                    @if ($item->status == '0')
                                                        <a class="dropdown-item"
                                                            href="{{ route('update_leave', ['id' => $item->id]) }}"><i
                                                                class="fa fa-edit"></i> Edit</a>
                                                    @endif
                                                    <a class="dropdown-item"
                                                        href="{{ route('leaves_details', ['id' => $item->id]) }}"
                                                        target="_sdf"><i class="fa fa-info"></i>&nbsp; Details</a>
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

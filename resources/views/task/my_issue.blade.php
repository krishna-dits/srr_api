@extends('layouts.layout')
@section('content')
    <style>
        table td {
            word-wrap: break-word;
            /* For older browsers */
            overflow-wrap: break-word;
            word-break: break-word;
            /* To handle long words or URLs */
            white-space: normal;
            /* Ensure text wraps normally */
        }
    </style>
    <div class="container-fluid">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">My Issue</h4>
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
                                <th scope="col">Name</th>
                                <th scope="col">Task Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($issue))
                                @foreach ($issue as $item)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ @$item->getUser->name }}</td>
                                        <td>{{ @$item->getTask->title }}</td>

                                        <td>
                                            <p style="width: 300px">{{ @$item->issue_note }}</p>
                                        </td>
                                        <td>
                                            <div class="card-options">
                                                <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">Action <i
                                                        class="fa fa-caret-down"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right" style="">
                                                    <a class="dropdown-item"
                                                        href="{{ route('resolve_issue', ['issue_id' => $item->id]) }}"><i
                                                            class="fa fa-check"></i>&nbsp; Resolved Issue</a>

                                                    <a class="dropdown-item"
                                                        href="{{ route('update_issue', ['issue_id' => $item->id]) }}"><i
                                                            class="fa fa-edit"></i>&nbsp; Update Issue</a>
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

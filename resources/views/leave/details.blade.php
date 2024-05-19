@extends('layouts.layout')
@section('content')
    <div class="container-fluid">
        <div class="col-xl-12 col-lg-12 col-md-12">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger mt-3" role="alert">
                        {{ $error }}
                    </div>
                @endforeach
            @endif

            <div class="row d-flex justify-content-center">
                <div class="col-md-6 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Leave details for {{ @$leave->getUser->name }}</h3>
                            {{-- <div class="card-options">
                                <form>
                                    <div class="input-group">
                                        <select class="form-control form-control-sm">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </form>
                            </div> --}}
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">DESCRIPTION: </h5>
                            {{ $leave->leave_desc ?? 'N/A' }}
                            <br>
                            <br>

                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <h5>From Date: </h5> {{ date('d-m-Y', strtotime($leave->from_date)) }}
                                </li>
                                <li class="list-group-item">
                                    <h5>To Date: </h5> {{ date('d-m-Y', strtotime($leave->to_date)) }}
                                </li>
                                <li class="list-group-item">
                                    <h5>Total Days: </h5> {{ @$leave->total_days }}
                                </li>
                                <li class="list-group-item">
                                    <h5>Status: </h5>
                                    @if ($leave->status == '1')
                                        <h5 class="heading-inverse bg-success rounded">Approved</h5>
                                    @elseif($leave->status == '0')
                                        <h5 class="heading-inverse bg-warning rounded">Pending</h5>
                                    @else
                                        <h5 class="heading-inverse bg-danger rounded">Decline</h5>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


    </div>

@endsection

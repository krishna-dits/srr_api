@extends('layouts.layout')
@section('content')
    <div class="container-fluid">
        <div class="col-xl-12 col-lg-12 col-md-12">

            @if (session('success'))
                <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert"
                        aria-hidden="true">×</button>{{ session('success') }}</div>
            @endif
            @if (session()->has('error'))
                <div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert"
                        aria-hidden="true">×</button>{{ session('error') }}</div>
            @endif


            {{-- @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger mt-3" role="alert">
                        {{ $error }}
                    </div>
                @endforeach
            @endif --}}
            <div class="border-0">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab-7">
                        <form class="form-horizontal" enctype="multipart/form-data" method="POST" action="">
                            @csrf
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="font-weight-bold"><i class="fa fa-cube"></i> Task Details</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">Task Title <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                                name="title" placeholder="Title" required
                                                value="{{ old('title', isset($task) ? $task->title : '') }}">
                                            @error('title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Task Description</label>
                                            <input type="text"
                                                class="form-control @error('description') is-invalid @enderror"
                                                name="description" placeholder="Description" required
                                                value="{{ old('description', isset($task) ? $task->description : '') }}">
                                            @error('description')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Start Date <span class="text-danger">*</span></label>
                                            <input type="date"
                                                class="form-control @error('start_date') is-invalid @enderror"
                                                id="inputPassword3" name="start_date" placeholder="Password"
                                                value="{{ isset($task) ? date('Y-m-d', strtotime($task->start_date)) : '' }}"
                                                required>
                                            @error('start_date')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">End Date <span class="text-danger">*</span></label>
                                            <input type="date"
                                                class="form-control @error('end_date') is-invalid @enderror"
                                                id="inputPassword3" name="end_date" placeholder="Password" required
                                                value="{{ old('end_data', isset($task) ? date('Y-m-d', strtotime($task->end_date)) : '') }}">
                                            @error('end_date')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        @php
                                            $task_user = [];
                                            if (isset($task)) {
                                                $task_user = json_decode($task->user_ids, true);
                                            }
                                        @endphp

                                        <div class="form-group col-md-3">
                                            <label for="yst">Select User <span class="text-danger">*</span></label>
                                            <select name="user_ids[]" class="form-control select2-show-search"
                                                id="yst" required multiple>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user['id'] }}">
                                                        {{ $user['name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('user_ids')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror

                                            @foreach ($task_user as $user)
                                                @php
                                                    $data = DB::table('users')->whereId($user)->first();
                                                @endphp
                                                <span>{{ $data->name }}</span>,
                                            @endforeach
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="yst">Priority <span class="text-danger">*</span></label>
                                            <select name="priority" class="form-control select2-show-search" id="yst"
                                                required>
                                                <option value="high"
                                                    {{ isset($task) && $task->priority == 'high' ? 'selected' : '' }}>High
                                                </option>
                                                <option value="medium"
                                                    {{ isset($task) && $task->priority == 'medium' ? 'selected' : '' }}>
                                                    Medium
                                                </option>
                                                <option value="low"
                                                    {{ isset($task) && $task->priority == 'low' ? 'selected' : '' }}>Low
                                                </option>
                                            </select>
                                            @error('user_ids')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="yst">Select Category <span class="text-danger">*</span></label>
                                            <select name="category_id" class="form-control select2-show-search"
                                                id="yst" required>
                                                <option value="Admin"
                                                    {{ isset($task) && $task->category_id == 'Admin' ? 'selected' : '' }}>
                                                    Admin
                                                </option>
                                                <option value="Office"
                                                    {{ isset($task) && $task->category_id == 'Office' ? 'selected' : '' }}>
                                                    Office
                                                </option>
                                                <option value="Tender"
                                                    {{ isset($task) && $task->category_id == 'Tender' ? 'selected' : '' }}>
                                                    Tender
                                                </option>
                                                <option value="Logistic"
                                                    {{ isset($task) && $task->category_id == '	Logistic' ? 'selected' : '' }}>
                                                    Logistic
                                                </option>
                                            </select>
                                            @error('category_id')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">Upload File</label>
                                            <input type="file" name="document">
                                            @error('document')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                            @if (!empty($task->document))
                                                <a href="{{ url('/') . '/public/assets/task/document/' . $task->document }}"
                                                    download>View
                                                    Document</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body border-top">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i>
                                        Create Task</button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    </div>
@endsection

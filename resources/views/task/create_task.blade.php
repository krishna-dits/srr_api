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
            <div class="border-0">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab-7">
                        <form class="form-horizontal" enctype="multipart/form-data" method="POST" action="">
                            @csrf
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="font-weight-bold"><i class="fa fa-cube"></i> User Details</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">Task Title <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                                name="title" placeholder="Title" required value="{{ old('title') }}">
                                            @error('title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Task Description</label>
                                            <input type="text"
                                                class="form-control @error('description') is-invalid @enderror"
                                                name="description" placeholder="Description" required
                                                value="{{ old('description') }}">
                                            @error('description')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Start Date <span class="text-danger">*</span></label>
                                            <input type="date"
                                                class="form-control @error('start_date') is-invalid @enderror"
                                                id="inputPassword3" name="start_date" placeholder="Password" required>
                                            @error('start_date')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">End Date <span class="text-danger">*</span></label>
                                            <input type="date"
                                                class="form-control @error('end_date') is-invalid @enderror"
                                                id="inputPassword3" name="end_date" placeholder="Password" required>
                                            @error('end_date')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="yst">Select User <span class="text-danger">*</span></label>
                                            <select name="user_ids[]" class="form-control select2-show-search"
                                                id="yst" required multiple>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user['id'] }}">{{ $user['name'] }}</option>
                                                @endforeach
                                            </select>
                                            @error('user_ids')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>


                                        {{-- <div class="form-group col-md-3">
                                            <label class="form-label">Users list</label>
                                            <select class="form-control select2" name="user_ids[]" data-placeholder="Choose Browser" multiple>
                                                <option value="Firefox">
                                                    Firefox
                                                </option>
                                                <option value="Chrome selected">
                                                    Chrome
                                                </option>
                                                <option value="Safari">
                                                    Safari
                                                </option>
                                                <option selected value="Opera">
                                                    Opera
                                                </option>
                                                <option value="Internet Explorer">
                                                    Internet Explorer
                                                </option>
                                            </select>
                                        </div> --}}


                                        <div class="form-group col-md-3">
                                            <label for="yst">Priority <span class="text-danger">*</span></label>
                                            <select name="priority" class="form-control select2-show-search" id="yst"
                                                required>
                                                <option value="" selected disabled>Select priority</option>
                                                <option value="high">High</option>
                                                <option value="high">High</option>
                                                <option value="high">High</option>
                                                <option value="high">High</option>
                                            </select>
                                            @error('user_ids')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="yst">Select Category <span class="text-danger">*</span></label>
                                            <select name="category_id" class="form-control select2-show-search"
                                                id="yst" required>
                                                <option value="" selected disabled>Select Category</option>
                                                <option value="a">A</option>
                                                <option value="b">B</option>
                                                <option value="c">C</option>
                                                <option value="d">D</option>
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
                                        </div>


                                    </div>
                                </div>
                                <div class="card-body border-top">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i>
                                        Create
                                        User</button>

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

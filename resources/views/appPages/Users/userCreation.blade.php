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
                        <form class="form-horizontal" enctype="multipart/form-data" method="POST"
                            action="{{ route('UserCreateAction') }}">
                            @csrf
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="font-weight-bold"><i class="fa fa-cube"></i> User Details</h5>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="form-label">User Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                name="name" placeholder="Name" required value="{{ old('name') }}">
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Role <span class="text-danger">*</span></label>
                                            <select
                                                class="form-control @error('role') is-invalid

                                        @enderror select2-show-search select2-hidden-accessible"
                                                tabindex="-1" aria-hidden="true" name="role" required>
                                                <optgroup label="Users">
                                                    @foreach ($all_role as $item)
                                                        <option value="{{ $item->name }}"
                                                            {{ $item->name == 'user' ? 'selected' : '' }}>
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                </optgroup>
                                            </select>
                                            @error('role')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">Email <span class="text-danger">*</span></label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                name="email" placeholder="Email" required value="{{ old('email') }}">
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Password <span class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control @error('password') is-invalid @enderror"
                                                id="inputPassword3" name="password" placeholder="Password" required>
                                            @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">Phone No. <span class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control @error('phone_no') is-invalid @enderror" name="phone_no"
                                                required value="{{ old('phone_no') }}">
                                            @error('phone_no')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">Profile Image (512 x 512)</label>
                                            <input type="file" onchange="readURL(this);" name="profile_image">
                                            @error('profile_image')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                            <img id="blah" width="60px" height="40px" />
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Gender
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select class="form-control @error('gender') is-invalid @enderror"
                                                name="gender" required value="{{ old('gender') }}">
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                                <option value="other">Other</option>
                                            </select>
                                            @error('gender')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Date of Birth
                                                <span class="text-danger"></span>
                                            </label>
                                            <input type="date" class="form-control @error('dob') is-invalid @enderror"
                                                name="dob" value="{{ old('dob') }}">
                                            @error('dob')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Designation
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text"
                                                class="form-control @error('designation') is-invalid @enderror"
                                                name="designation" required value="{{ old('designation') }}">
                                            @error('designation')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Date of joining
                                                <span class="text-danger"></span>
                                            </label>
                                            <input type="date"
                                                class="form-control @error('date_of_joining') is-invalid @enderror"
                                                name="date_of_joining" value="{{ old('date_of_joining') }}">
                                            @error('date_of_joining')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Guardian Name
                                                <span class="text-danger"></span>
                                            </label>
                                            <input type="text"
                                                class="form-control @error('guardian_name') is-invalid @enderror"
                                                name="guardian_name" value="{{ old('guardian_name') }}">
                                            @error('guardian_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Marital Status
                                                <span class="text-danger"></span>
                                            </label>
                                            <select class="form-control @error('marital_status') is-invalid @enderror"
                                                name="marital_status"value="{{ old('marital_status') }}">
                                                <option value="married">Married</option>
                                                <option value="unmarried">Unmarried</option>
                                                <option value="divorce">Divorce</option>
                                            </select>
                                            @error('marital_status')
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


    <script type="text/javascript">
        function remove(i) {
            $('#rowid' + i).remove();
        }
    </script>

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#blah')
                        .attr('src', e.target.result)
                        .width(50)
                        .height(50);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>


    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
@endsection

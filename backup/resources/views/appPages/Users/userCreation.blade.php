@extends('layouts.layout')
@section('content')


   <div class="container-fluid">
   <div class="col-xl-12 col-lg-12 col-md-12">
        @if($errors->any())
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger mt-3" role="alert">
            {{$error}}
        </div>
        @endforeach
        @endif
        <div class="border-0">
            <div class="tab-content">
                <div class="tab-pane active" id="tab-7">
                    <form class="form-horizontal" enctype="multipart/form-data" method="POST" action="{{ route('UserCreateAction') }}">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <h5 class="font-weight-bold"><i class="fa fa-cube"></i> User Details</h5>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="form-label">User Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid

                                        @enderror" name="name" placeholder="Name">
                                        @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Role <span class="text-danger">*</span></label>
                                        <select class="form-control @error('role') is-invalid

                                        @enderror select2-show-search select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="role">
                                            <optgroup label="Users">
                                                @foreach ($all_role as $item)
                                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                                                @endforeach
                                            </optgroup>
                                        </select>
                                        @error('role')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control @error('email') is-invalid

                                        @enderror" name="email" placeholder="Email">
                                        @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Password <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('password') is-invalid

                                        @enderror" id="inputPassword3" name="password" placeholder="Password">
                                        @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Phone No. <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('phone_no') is-invalid

                                        @enderror" name="phone_no">
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
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <img id="blah" width="60px" height="40px" />
                                    </div>

                                    <!-- <div class="col-md-4">
                                        <label class="form-label">Basic Salary <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('basic_salary') is-invalid

                                        @enderror" name="basic_salary">
                                        @error('basic_salary')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div> -->

                                </div>
                            </div>





                            <div class="card-body border-top">

                                <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Create
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
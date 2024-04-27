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
                    <form class="form-horizontal" enctype="multipart/form-data" method="POST" action="{{ route('CustomerCreateAction') }}">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <h5 class="font-weight-bold"><i class="fa fa-cube"></i>Create Customer</h5>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label class="form-label">Customer Id<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('cust_id') is-invalid
                                        @enderror" name="cust_id" placeholder="Is Name" value="{{$CustNumber}}" readonly>
                                        @error('cust_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Customer Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('cus_name') is-invalid
                                        @enderror" name="cus_name" placeholder="Customer Name">
                                        @error('cus_name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Address 1 <span class="text-danger">*</span></label>
                                        <textarea class="form-control" name="address1" placeholder="Enter Address 1"></textarea>
                                        @error('address1')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Address 2 <span class="text-danger">*</span></label>
                                        <textarea class="form-control" name="address2" placeholder="Enter Address 2"></textarea>
                                        @error('address2')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                            </div>

                            <div class="card-body border-top">

                                <button type="submit" class="btn btn-primary" name="save"><i class="fa fa-paper-plane"></i> Create
                                    Customer</button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


</div>
<!-- 

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
</script> -->


<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
@endsection
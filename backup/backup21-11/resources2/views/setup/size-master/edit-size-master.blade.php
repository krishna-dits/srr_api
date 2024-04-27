@extends('layouts.layout')
@section('content')
<div class="container-fluid">
    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <!--div-->
        <div class="card">
            <div class="card-header">
                <div class="card-title">Add Size Master</div>
            </div>
            <div class="card-body">
                <div class="">
                    <form class="row g-3" method="POST" action="{{ route('size-master-update') }}">
                        @csrf
                        <div class="col-md-12">
                            <input type="hidden" name="id" value="{{ $editSizeMaster->id }}"/>
                            <div class="row">

                                <div class="col-md-3">
                                    <label class="form-label">Id<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="size_id" placeholder="Id" value="{{$editSizeMaster->size_id}}" readonly>
                                    @error('size_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">IS<span class="text-danger">*</span></label>
                                    <select class="form-control select2-show-search select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="is_name" onchange="getDesire()" id="is_name">
                                        <option value="">Select</option>
                                        @foreach ($is_number_list as $item)
                                        <option value="{{ $item->is_name }}" {{ $item->is_name == $editSizeMaster->is_name ? 'selected' : ""}}>{{ $item->is_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('is_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">Size <span class="text-danger">*</span></label>

                                    <input type="text" class="form-control" name="is_size" id="is_size"  placeholder="Enter Is Size" value="{{$editSizeMaster->is_size}}" onchange="getDesire()"/>
                                    @error('is_size')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <span style="margin-top: 35px;">MM</span>
                                <div class="col-md-2">
                                    <label class="form-label">Size1 <span class="text-danger">*</span></label>

                                    <input type="text" class="form-control" name="is_size1" id="is_size1" value="{{('NA')}}"  placeholder="Enter Is Size 1" value="{{$editSizeMaster->is_size1}}" />
                                    @error('is_size1')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <span style="margin-top: 35px;">MM</span>
                                <div class="col-md-3">
                                    <label class="form-label">Desier Size <span class="text-danger">*</span></label>

                                    <input type="text" class="form-control" name="desier_size" id="desier_size"  placeholder="Enter Desier Size" value="{{$editSizeMaster->desier_size}}" />
                                    @error('desier_size')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Desier <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="desier" id="desier"  value="{{$editSizeMaster->desier}}" />
                                    @error('desier')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="grade">Bend Test<span class="text-danger">*</span></label>
                                    <select name="bend" class="form-control select2-show-search" id="" >
                                        <option value="" for="flattening">Select</option>
                                        @foreach (Config::get('static.Drift') as $lang => $ysts)
                                        <option value="{{ $ysts }}" {{ $ysts == $editSizeMaster->bend ? 'selected' : ""}}> {{ $ysts }} 
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('bend')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="grade">Flattening Test <span class="text-danger">*</span></label>
                                    <select name="flattening" class="form-control select2-show-search" id="" >
                                        <option value="" for="flattening">Select</option>
                                        @foreach (Config::get('static.Drift') as $lang => $ysts)
                                        <option value="{{ $ysts }}" {{ $ysts == $editSizeMaster->flattening ? 'selected' : ""}}> {{ $ysts }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('flattening')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="grade">Free Bore Test <span class="text-danger">*</span></label>
                                    <select name="free_board_test" class="form-control select2-show-search" id="free_board_test" >
                                        <option value="" for="free_board_test">Select</option>
                                        @foreach (Config::get('static.Drift') as $lang => $ysts)
                                        <option value="{{ $ysts }}" {{ $ysts == $editSizeMaster->free_board_test ? 'selected' : ""}}> {{ $ysts }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('free_board_test')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>



                            </div>
                            <div class="text-right mt-3 ml-3" style="margin-right: 750px;">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-file"></i>&nbsp;Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script>
    // $(document).ready(function() {
    function getDesire() {

        $('#desier').val('');
        let is_name = $('#is_name').val();

        let tax = $('#desier_size').val();

        let is_size = $('#is_size').val();

        let name = is_size + 'MM';
        $('#desier_size').val(name);

        $.ajax({
            url: "{{ route('get-desire-by-is-master-type') }}",
            type: "post",
            data: {
                IsName: is_name,
                _token: '{{ csrf_token() }}',
            },
            dataType: 'json',
            success: function(res) {
                let type = res.type;
                let bendValue = is_size;
                let desireValue = res.type + name;
                if (desireValue != "") {
                    $('#desier').val(desireValue);
                }
                getBend(bendValue, type)

            }
        });

    }
</script>

<script>
    function getBend(value, type) {

        if (type == 'NB') {
            if (value >= 15 && value <= 50 && type == 'NB') {
                $('#bend').val('PASS').trigger('change');
                $('#flattening').val('NA').trigger('change');
            } else {
                $('#bend').val('NA').trigger('change');
                $('#flattening').val('PASS').trigger('change');
            }
        }
    }
</script>



@endsection
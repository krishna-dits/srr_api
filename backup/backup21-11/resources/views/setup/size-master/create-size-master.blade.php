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
                    <form class="row g-3" method="POST" action="{{ route('size-master-save') }}">
                        @csrf
                        <div class="col-md-12">
                            <div class="row">

                                <div class="col-md-3">
                                    <label class="form-label">Id<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="size_id" placeholder="Id" value="{{$SizeNumber}}" readonly>
                                    @error('size_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">IS<span class="text-danger">*</span></label>
                                    <select class="form-control select2-show-search select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="is_name" onchange="getDesire()" id="is_name">
                                        <option value="">Select</option>
                                        @foreach ($is_number_list as $item)
                                        <option value="{{ $item->is_name }}">{{ $item->is_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('is_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">Size <span class="text-danger">*</span></label>

                                    <input type="text" class="form-control" name="is_size" id="is_size" required placeholder="Enter Is Size" onchange="getDesire()" />
                                    @error('is_size')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <span style="margin-top: 35px;">MM</span>
                                <div class="col-md-2">
                                    <label class="form-label">Size1 <span class="text-danger">*</span></label>

                                    <input type="text" class="form-control" name="is_size1" id="is_size1" value="{{('NA')}}" required placeholder="Enter Is Size 1" onchange="getDesire()" />
                                    @error('is_size1')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <span style="margin-top: 35px;">MM</span>
                                <div class="col-md-3">
                                    <label class="form-label">Desier Size <span class="text-danger">*</span></label>

                                    <input type="text" class="form-control" name="desier_size" id="desier_size" required placeholder="Enter Desier Size" />
                                    @error('desier_size')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Desier <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="desier" id="desier" required />
                                    @error('desier')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="grade">Bend Test<span class="text-danger">*</span></label>
                                    <select name="bend" class="form-control select2-show-search" id="bend" required>
                                        <option value="" for="bend">Select</option>
                                        <option value="PASS">PASS </option>
                                        <option value="NA">NA </option>
                                    </select>
                                    @error('bend')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="grade">Flattening Test <span class="text-danger">*</span></label>
                                    <select name="flattening" class="form-control select2-show-search" id="flattening" required>
                                        <option value="" for="flattening">Select</option>
                                        @foreach (Config::get('static.Drift') as $lang => $ysts)
                                        <option value="{{ $ysts }}"> {{ $ysts }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('flattening')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="grade">Free Bore Test <span class="text-danger">*</span></label>
                                    <select name="free_board_test" class="form-control select2-show-search" id="free_board_test" required>
                                        <option value="" for="free_board_test">Select</option>
                                        @foreach (Config::get('static.Drift') as $lang => $ysts)
                                        <option value="{{ $ysts }}"> {{ $ysts }}
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
    function getDesire() {
        $('#desier').val('');
        let is_name = $('#is_name').val();
        let tax = $('#desier_size').val();
        let is_size = $('#is_size').val();
        let is_size1 = $('#is_size1').val();

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
                let desireValue;

                if (is_size === is_size1) {
                    desireValue = res.type + 'SHS' + name + is_size1 + 'MM';
                } else if (is_size1 === 'NA') {
                    desireValue = res.type + name;
                } else {
                    desireValue = res.type + 'RHS' + name + is_size1 + 'MM';
                }

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
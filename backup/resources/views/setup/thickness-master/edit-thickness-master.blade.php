@extends('layouts.layout')
@section('content')
<div class="container-fluid">
    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <!--div-->
        <div class="card">
            <div class="card-header">
                <div class="card-title">Edit Thickness Master</div>
            </div>
            <div class="card-body">
                <div class="">
                    <form class="row g-3" method="POST" action="{{ route('ThicknessMasterUpdate') }}">
                        @csrf
                        <div class="col-md-12">
                            <div class="row">
                                <input type="hidden" name="id" value="{{@$editThicknessMaster->id}}" />
                                <div class="col-md-3">
                                    <label class="form-label">Id<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="thickness_id" placeholder="Id" value="{{@$editThicknessMaster->thickness_id}}" readonly>
                                    @error('thickness_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Is Name <span class="text-danger">*</span></label>
                                    <select class="form-control select2-show-search select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="is_name" onchange="getThikness(this.value)">

                                        @foreach ($is_number_list as $item)
                                        <option value="{{ $item->is_name }}" {{ $item->is_name == $editThicknessMaster->is_name ? 'selected' : " " }}>{{ $item->is_name }}</option>
                                        @endforeach

                                    </select>
                                    @error('is_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Thik Value <span class="text-danger">*</span></label>

                                    <input type="text" class="form-control" name="thik_value" id="thik_value" value="{{@$editThicknessMaster->thik_value}}" required placeholder="Enter Thik Value" />
                                    @error('thik_value')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Thik Type <span class="text-danger">*</span></label>
                                    <select class="form-control select2-show-search select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="thik_type" onchange="getValue(this.value)">
                                        <option value="" for="draft_exp">Select</option>
                                        @foreach (Config::get('static.Thickness') as $lang => $Thik)
                                        <option value="{{ $Thik }}" {{ $Thik == $editThicknessMaster->thik_type ? 'selected' : " " }}> {{ $Thik }}
                                        </option>
                                        @endforeach
                                    </select>

                                    @error('thik_type')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Desire <span class="text-danger">*</span></label>

                                    <input type="text" class="form-control" name="desire" id="desire" value="{{@$editThicknessMaster->desire}}" required placeholder="Enter Desire" />
                                    @error('desire')
                                    <span class="text-danger">{{ $message }}</span>
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
    function getThikness(name) {
    
        // $('#thik_type').append('<option vaule="" >Select...</option>');
        var thikTypeSelect = $('select[name="thik_type"]');
        thikTypeSelect.empty(); // Remove existing options
        // thikTypeSelect.append($('<option value="">Select</option>'));

        if (name === 'IS 1239' || name === 'IS 10577') {
            $('#thik_value').val('NA');
            $('#thik_value').prop('readonly', true);

            // Add the 'NA' option

            $('#thik_value').prop('readonly', false);
            var isThicknessOptions = <?php echo json_encode(Config::get('static.Is_Thickness')); ?>;
            $.each(isThicknessOptions, function(key, value) {
                thikTypeSelect.append($('<option>', {
                    value: value,
                    text: value
                }));
            });

        } else {

            // $('#thik_value').val('');
            thikTypeSelect.append($('<option>', {
                value: 'MM',
                text: 'MM'
            }));

            // let ThikValue = $('#thik_value').val();
            // let name1 = ThikValue + 'MM';
            // $('#desire').val(name1);
        }
    }
</script>

<script>
    function getValue(name) {

        // $('#desire').val('');

        if (name == 'MM') {
            let ThikValue = $('#thik_value').val();
            let name1 = ThikValue + 'MM';
            $('#desire').val(name1);
        } else {

            $('#desire').val(name);
        }
    }
</script>

@endsection
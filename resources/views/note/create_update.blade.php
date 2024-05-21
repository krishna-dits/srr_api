@extends('layouts.layout')
@section('content')
    <div class="container-fluid">
        <div class="col-xl-12 col-lg-12 col-md-12">

            <div class="border-0">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab-7">
                        <form class="form-horizontal" method="POST" action="">
                            @csrf
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="font-weight-bold"><i class="fa fa-cube"></i> New Note</h5>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="form-label">Note Description <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="description"
                                                placeholder="Eg, Note description" required
                                                value="{{ old('description', isset($note) ? $note->description : '') }}">
                                            @error('description')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                                <div class="card-body border-top">
                                    <button type="submit" class="btn btn-primary"><i
                                            class="fa fa-paper-plane"></i>Save</button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row">

                @if (isset($notes))
                    @foreach ($notes as $item)
                        <div class="col-md-12 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    {{-- <h5 class="card-title">Card title</h5> --}}
                                    <p class="card-text">{{ $item['description'] }}</p>
                                    <a class="btn btn-primary" href="{{ route('update', ['id' => $item->id]) }}">Update</a>
                                    <a class="btn btn-danger"
                                        href="{{ route('delete_note', ['id' => $item->id]) }}">Delete</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            {{ $notes->links() }}
        </div>
    </div>


    </div>
@endsection

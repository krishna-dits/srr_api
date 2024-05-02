@extends('layouts.layout')
@section('content')
    <div class="container-fluid">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <!--div-->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Add New Category</div>
                </div>
                <div class="card-body">
                    <div class="">
                        <form class="row g-3" method="POST" action="">
                            @csrf
                            <div class="col-md-12">
                                <div class="row justify-content-center">
                                    <div class="col-md-3">
                                        <label class="form-label">Category Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name" id="name"
                                            value="{{ old('name', isset($category) ? $category['name'] : '') }}"
                                            placeholder="Eg, Documents" />
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="text-right mt-3 ml-3">
                                        <button type="submit" class="btn btn-primary mt-3"><i
                                                class="fa fa-file"></i>&nbsp;Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <table id="example" class="table table-borderless text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th scope="col">Sl No. </th>
                                <th scope="col">Category Name</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($data))
                                @foreach ($data as $item)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            <div class="card-options">
                                                <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">Action <i
                                                        class="fa fa-caret-down"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right" style="">

                                                    <a class="dropdown-item"
                                                        href="{{ route('category', ['id' => $item->id]) }}"><i
                                                            class="fa fa-edit"></i>
                                                        Edit</a>

                                                    <a class="dropdown-item" href=""><i class="fa fa-trash"></i>
                                                        Delete</a>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script></script>
@endsection

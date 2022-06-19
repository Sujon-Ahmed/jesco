@extends('backend.layouts.master')

@section('content')
    <div class="pagetitle">
        <h1>Product</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="">Products</a></li>
                <li class="breadcrumb-item active">Color</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between">
                    <h5>color list</h5>
                    <a href="" data-bs-toggle="modal" data-bs-target="#addColor" class="btn btn-dark btn-sm text-light"><i
                            class="fa fa-plus"></i> add new</a>
                </div>
                <div class="card-body mt-3">
                    <table class="table" id="myTable">
                        <thead>
                            <tr>
                                <th>sl</th>
                                <th>color name</th>
                                <th>color code</th>
                                <th>options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($colors as $color)
                                <tr>
                                    <td>{{ $color->id }}</td>
                                    <td>{{ $color->color_name }}</td>
                                    <td><span
                                            style="background: {{ $color->color_code }}; padding: 2px 5px; border-radius:5px;">{{ $color->color_code }}</span>
                                    </td>
                                    <td>
                                        <button type="button" value="{{ $color->id }}"
                                            class="btn btn-outline-success btn-sm colorEdit" data-bs-toggle="tooltip" data-bs-placement="left" title="Edit"><i
                                                class="fa fa-edit"></i></button>
                                        <button type="button" value="{{ $color->id }}"
                                            class="btn btn-outline-danger btn-sm deleteColor" data-bs-toggle="tooltip" data-bs-placement="right" title="Delete"><i
                                                class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal for add to color -->
    <div class="modal fade" id="addColor" tabindex="-1" aria-labelledby="addColor" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addColor">add color</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('color.insert') }}" method="POST">
                        @csrf
                        <div class="form-group mt-2">
                            <label for="color_name">Color Name</label>
                            <input type="text" name="color_name" value="{{ old('color_name') }}" class="form-control">
                            @error('color_name')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <label for="color_name">Color Code</label>
                            <input type="text" name="color_code" class="form-control" value="{{ old('color_code') }}">
                            @error('color_code')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-sm">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal for edit / update color -->
    <div class="modal fade" id="editUpdateColor" tabindex="-1" aria-labelledby="addColor" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addColor">edit / update color</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('color.update') }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="colorId" id="colorId">
                        <div class="form-group mt-2">
                            <label for="color_name">Color Name</label>
                            <input type="text" name="color_name" id="updated_color_name" class="form-control">
                            @error('color_name')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <label for="color_name">Color Code</label>
                            <input type="text" name="color_code" id="updated_color_code" class="form-control">
                            @error('color_code')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success btn-sm">update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal for delete to color -->
    <div class="modal fade" id="deleteColorModal" tabindex="-1" aria-labelledby="deleteColor" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-capitalize" id="deleteColor">color delete confirmed message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('color.delete') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        Are You Sure Delete This Color ?
                        <input type="hidden" name="colorDeleteId" id="colorDeleteId">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection
    @section('scripts')
        <script>
            $(document).ready(function() {
                // color edit script
                $(document).on('click', '.colorEdit', function() {
                    $('#editUpdateColor').modal('show');
                    let colorEditId = $(this).val();
                    $.ajax({
                        type: "GET",
                        url: "/admin/color/edit/" + colorEditId,
                        dataType: "json",
                        success: function (response) {
                            // console.log(response);
                            $('#colorId').val(colorEditId);
                            $('#updated_color_name').val(response.color_info.color_name);
                            $('#updated_color_code').val(response.color_info.color_code);
                        }
                    });
                });
                // color delete script
                $(document).on('click', '.deleteColor', function() {
                    let colorDelId = $(this).val();
                    $('#deleteColorModal').modal('show');
                    $('#colorDeleteId').val(colorDelId);
                });
            });
        </script>
    @endsection

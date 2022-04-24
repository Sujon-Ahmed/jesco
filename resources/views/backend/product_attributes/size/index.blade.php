@extends('backend.layouts.master')

@section('content')
    <div class="pagetitle">
        <h1>Product</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="">Products</a></li>
                <li class="breadcrumb-item active">Size</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5>color list</h5>
                </div>
                <div class="card-body mt-3">
                    <table class="table" id="myTable">
                        <thead>
                            <tr>
                                <th>sl</th>
                                <th>size</th>
                                <th>options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sizes as $size)
                                <tr>
                                    <td>{{ $size->id }}</td>
                                    <td>{{ $size->size }}</td>
                                    <td>
                                        <button type="button" value="{{ $size->id }}"
                                            class="btn btn-outline-success btn-sm sizeEditButton" data-bs-toggle="tooltip"
                                            data-bs-placement="left" title="Edit"><i class="fa fa-edit"></i></button>
                                        <button type="button" value="{{ $size->id }}"
                                            class="btn btn-outline-danger btn-sm sizeDeleteButton" data-bs-toggle="tooltip"
                                            data-bs-placement="right" title="Delete"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="text-center">add size</h5>
                </div>
                <div class="card-body">
                    <form action="{{ url('/size/insert') }}" method="POST">
                        @csrf
                        <div class="form-group mt-2">
                            <label for="size">size</label>
                            <input type="text" name="size" value="{{ old('size') }}" class="form-control">
                            @error('size')
                                <span style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal for edit / update size -->
    <div class="modal fade" id="editUpdateSizeModal" tabindex="-1" aria-labelledby="deleteColor" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-capitalize" id="deleteColor">edit / update size</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('size.update') }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="sizeId" id="sizeId">
                        <div class="form-group mt-2">
                            <label for="size">size</label>
                            <input type="text" name="size" id="size" value="{{ old('size') }}" class="form-control">
                            @error('size')
                                <span style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success btn-sm">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal for delete size -->
    <div class="modal fade" id="deleteSizeModal" tabindex="-1" aria-labelledby="deleteColor" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-capitalize" id="deleteColor">size delete confirmed message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('size.delete') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        Are You Sure Delete This size ?
                        <input type="hidden" name="sizeDeleteId" id="sizeDeleteId">
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
            // size edit / update
            $(document).on('click', '.sizeEditButton', function () {
                let sizeEditBtnId = $(this).val();
                $('#editUpdateSizeModal').modal('show');                
                $.ajax({
                    type: "GET",
                    url: "/size/edit/" + sizeEditBtnId,                    
                    dataType: "json",
                    success: function (response) {
                        $('#sizeId').val(sizeEditBtnId);
                        $('#size').val(response.size_info.size);
                    }
                });
            });
            // size destroy
            $(document).on('click', '.sizeDeleteButton', function() {
                let sizeDeleteBtnId = $(this).val();
                $('#deleteSizeModal').modal('show');
                $('#sizeDeleteId').val(sizeDeleteBtnId);
            });
        });
    </script>
@endsection

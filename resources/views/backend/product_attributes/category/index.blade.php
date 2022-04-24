@extends('backend.layouts.master')

@section('content')
    <div class="pagetitle">
        <h1>Product</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="">Products</a></li>
                <li class="breadcrumb-item active">Category</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between">
                    <h5>Category list</h5>
                    <button type="button" class="btn btn-dark btn-sm float-end addCategory">add category</button>
                </div>
                <div class="card-body mt-3">
                    <table class="table" id="myTable">
                        <thead>
                            <tr>
                                <th>sl</th>
                                <th>category</th>
                                <th>category thumbnail</th>
                                <th>options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $key=>$category)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $category->category_name }}</td>
                                    <td>
                                        <img src="{{ asset('backend_assets/uploads/category') }}/{{ $category->category_thumbnail }}" alt="category_image" class="img-fluid" style="width: 100px">
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-outline-success btn-sm" data-bs-toggle="tooltip" data-bs-placement="left" title="Edit"><i class="fa fa-edit"></i></button>
                                        <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="tooltip" data-bs-placement="right" title="Delete"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal for add category -->
    <div class="modal fade" id="addNewCategory" tabindex="-1" aria-labelledby="deleteColor" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-capitalize" id="category">add new category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('/category/insert') }}" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group mt-2">
                            <label for="category_name" class="form-label">Category Name</label>
                            <input type="text" name="category_name" id="category_name" class="form-control"
                                value="{{ old('category_name') }}">
                            @error('category_name')
                                <span style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <label for="category_thumbnail">Category Thumbnail</label>
                            <input type="file" name="category_thumbnail" id="category_thumbnail"
                                class="form-control file-control">
                            @error('category_thumbnail')
                                <span style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="modal-footer d-flex">
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal for delete size -->
    {{-- <div class="modal fade" id="deleteSizeModal" tabindex="-1" aria-labelledby="deleteColor" aria-hidden="true">
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
    </div> --}}
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.addCategory', function() {
                $('#addNewCategory').modal('show');
            });
        });
    </script>
@endsection

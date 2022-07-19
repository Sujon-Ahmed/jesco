@extends('backend.layouts.master')

@section('content')
    <div class="pagetitle">
        <h1>Sliders</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Sliders</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between">
                    <h5>Slider list</h5>
                    <button type="button" class="btn btn-dark btn-sm float-end addSlider">add slider</button>
                </div>
                <div class="card-body mt-3">
                    <table class="table" id="myTable">
                        <thead>
                            <tr>
                                <th>sl</th>
                                <th>sub-title</th>
                                <th>title</th>
                                <th>image</th>
                                <th>options</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal for add category -->
    <div class="modal fade" id="addNewSlider" tabindex="-1" aria-labelledby="slider" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-capitalize" id="category">add new slider</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('slider.store') }}" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group mt-2">
                            <label for="sub_title" class="form-label">Sub Title</label>
                            <input type="text" name="sub_title" id="sub_title" class="form-control"
                                value="{{ old('sub_title') }}">
                            @error('sub_title')
                                <span style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" name="title" id="title" class="form-control"
                                value="{{ old('title') }}">
                            @error('title')
                                <span style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <label for="image">Slider Image</label>
                            <input type="file" name="image" id="image"
                                class="form-control file-control">
                            @error('image')
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
    <!-- Modal for edit / update category -->
    {{-- <div class="modal fade" id="editUpdateCategory" tabindex="-1" aria-labelledby="category" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-capitalize" id="category">edit / update category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('/admin/category/update') }}" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="editUpdateCategoryId" id="editUpdateCategoryId">
                        <div class="form-group mt-2">
                            <label for="category_name" class="form-label">Category Name</label>
                            <input type="text" name="category_edit_name" id="category_edit_name" class="form-control"
                                value="{{ old('category_name') }}">
                            @error('category_name')
                                <span style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <label for="category_thumbnail">Category Thumbnail</label>
                            <input type="file" name="category_edit_thumbnail" id="category_edit_thumbnail"
                                class="form-control file-control"
                                oninput="pic.src=window.URL.createObjectURL(this.files[0])">
                            @error('category_thumbnail')
                                <span style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <img style="width: 300px" id="pic" alt="">
                        <div class="modal-footer d-flex">
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success btn-sm">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}
    <!-- Modal for delete size -->
    {{-- <div class="modal fade" id="deleteCategoryModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-capitalize" id="categoryDelete">confirmed message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('category.destroy') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        Are You Sure Delete This Category ?
                        <input type="hidden" name="category_id" id="category_id">
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
        $(document).ready(function () {
            $(document).on('click', '.addSlider', function () {
                $('#addNewSlider').modal('show');
            });
        });
    </script>
@endsection

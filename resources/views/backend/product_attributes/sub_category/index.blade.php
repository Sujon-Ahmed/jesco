@extends('backend.layouts.master')

@section('content')
    <div class="pagetitle">
        <h1>Product</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="">Products</a></li>
                <li class="breadcrumb-item active">Sub-Category</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between">
                    <h5>Subcategory list</h5>
                    <button type="button" class="btn btn-dark btn-sm float-end addSubcategory">add subcategory</button>
                </div>
                <div class="card-body mt-3">
                    <table class="table" id="myTable">
                        <thead>
                            <tr>
                                <th>sl</th>
                                <th>category</th>
                                <th>subcategory</th>
                                <th>options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subcategories as $key => $subcategory)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $subcategory->relation_to_category->category_name }}</td>
                                    <td>{{ $subcategory->subcategory_name }}</td>
                                    <td>
                                        <button type="button" value="{{ $subcategory->id }}" class="btn btn-outline-success btn-sm editSubcategorybtn"
                                            data-bs-toggle="tooltip" data-bs-placement="left" title="Edit"><i
                                                class="fa fa-edit"></i></button>
                                        <button type="button" value="{{ $subcategory->id }}"
                                            class="btn btn-outline-danger btn-sm deleteSubcategorybtn"
                                            data-bs-toggle="tooltip" data-bs-placement="right" title="Delete"><i
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
    <!-- Modal for add category -->
    <div class="modal fade" id="addNewSubCategory" tabindex="-1" aria-labelledby="subcategory" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-capitalize" id="subcategory">add new subcategory</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('subcategory.insert') }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        <select name="category_id" class="form-select" aria-label="Default select example">
                            <option value="">--Select Category--</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span style="color:red">{{ $message }}</span>
                        @enderror
                        <div class="form-group mt-2">
                            <label for="subcategory_name">Subcategory Name</label>
                            <input type="text" name="subcategory_name" id="subcategory_name" class="form-control">
                            @error('subcategory_name')
                                <span style="color:red">{{ $message }}</span>
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
    <div class="modal fade" id="editUpdateSubCategory" tabindex="-1" aria-labelledby="subcategory" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-capitalize" id="subcategory">edit / update subcategory</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('/subcategory/update') }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="updatedSubcategoryId" id="updatedSubcategoryId">
                        <select name="category_id_updated" id="category_id_updated" class="form-select" aria-label="Default select example">
                            <option value="">--Select Category--</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span style="color:red">{{ $message }}</span>
                        @enderror
                        <div class="form-group mt-2">
                            <label for="subcategory_name_updated">Subcategory Name</label>
                            <input type="text" name="subcategory_name_updated" id="subcategory_name_updated" class="form-control">
                            @error('subcategory_name')
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
    <div class="modal fade" id="deleteSubCategoryModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-capitalize" id="categoryDelete">confirmed message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('subcategory.destroy') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        Are You Sure Delete This SubCategory ?
                        <input type="hidden" name="subcategory_id" id="subcategory_id">
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
            // add modal 
            $(document).on('click', '.addSubcategory', function() {
                $('#addNewSubCategory').modal('show');
            });
            // edit
            $(document).on('click', '.editSubcategorybtn', function() {
                let editSubCategoryVal = $(this).val();
                $('#editUpdateSubCategory').modal('show');
                $.ajax({
                    type: "GET",
                    url: "/subcategory/edit/" + editSubCategoryVal,
                    dataType: "json",
                    success: function (response) {
                        console.log(response);
                        $('#subcategory_name_updated').val(response.subcategory_info.subcategory_name);
                        $('#category_id_updated').val(response.subcategory_info.category_id);
                        $('#updatedSubcategoryId').val(editSubCategoryVal);
                    }
                });
            });
            // delete modal
            $(document).on('click', '.deleteSubcategorybtn', function() {
                let subCategoryId = $(this).val();
                $('#deleteSubCategoryModal').modal('show');
                $('#subcategory_id').val(subCategoryId);
            });
        });
    </script>
@endsection

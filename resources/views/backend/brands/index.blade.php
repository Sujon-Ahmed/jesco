@extends('backend.layouts.master')

@section('content')
    <div class="pagetitle">
        <h1>Brands</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Category</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between">
                    <h5>Brands list</h5>
                    <button type="button" class="btn btn-dark btn-sm float-end addBrand">add brand</button>
                </div>
                <div class="card-body mt-3">
                    <table class="table" id="myTable">
                        <thead>
                            <tr>
                                <th>sl</th>
                                <th>brand name</th>
                                <th>brand thumbnail</th>
                                <th>status</th>
                                <th>options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brands as $key => $brand)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $brand->brand_name }}</td>
                                    <td>
                                        <img src="{{ asset('backend_assets/uploads/brands') }}/{{ $brand->brand_image }}"
                                            alt="brand-logo" width="80">
                                    </td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" onchange=""
                                                value="">
                                            <span class="slider"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <button type="button" value=""
                                            class="btn btn-outline-success btn-sm categoryEditButton"
                                            data-bs-toggle="tooltip" data-bs-placement="left" title="Edit"><i
                                                class="fa fa-edit"></i></button>
                                        <button type="button" value="{{ $brand->id }}"
                                            class="btn btn-outline-danger btn-sm brandDeleteBtn"
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
    {{-- modal section for add new brand--}}
    <div class="modal fade" id="addNewBrand" tabindex="-1" aria-labelledby="brand" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-capitalize" id="brand">add new brand</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('brand.store') }}" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group mt-2">
                            <label for="category_name" class="form-label">Brand Name</label>
                            <input type="text" name="brand_name" id="brand_name" class="form-control"
                                value="{{ old('category_name') }}">
                            @error('brand_name')
                                <span style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <label for="category_thumbnail">Brand Thumbnail</label>
                            <input type="file" name="brand_thumbnail" id="brand_thumbnail"
                                class="form-control file-control">
                            @error('brand_thumbnail')
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
    {{-- modal section for delete brand --}}
     <div class="modal fade" id="deleteBrandModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-capitalize" id="categoryDelete">confirmed message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('brand.delete') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        Are You Sure Delete This Brand ?
                        <input type="hidden" name="deleted_brand_id" id="deleted_brand_id">
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
    {{-- script for add new brand --}}
    <script>
        $(document).ready(function() {
            $(document).on('click', '.addBrand', function() {
                $('#addNewBrand').modal('show');
            });
        });
    </script>
    {{-- script for delete brand --}}
    <script>
        $(document).ready(function () {
            $(document).on('click', '.brandDeleteBtn', function () {
                let brandId = $(this).val();
                $('#deleteBrandModal').modal('show');
                $('#deleted_brand_id').val(brandId);
            });
        });
    </script>
@endsection

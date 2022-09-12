@extends('backend.layouts.master')

@section('content')
    <div class="pagetitle">
        <h1>Blogs</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Blogs</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between">
                    <h5>Blogs List</h5>
                    <button type="button" class="btn btn-dark btn-sm float-end" data-bs-toggle="modal"
                        data-bs-target="#addNewBlog">New Blog</button>
                </div>
                <div class="card-body mt-3">
                    <table class="table" id="myTable">
                        <thead>
                            <tr>
                                <th>sl</th>
                                <th>member name</th>
                                <th>member photo</th>
                                <th>status</th>
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
    <!-- add new blog modal -->
    <div class="modal" id="addNewBlog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-capitalize" id="addNewBlog">Add New Blog</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <input type="text" name="title" class="form-control" placeholder="Enter blog title..." />
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6 mt-3">
                                    <select name="category_id" class="form-select">
                                        <option>-Select Category-</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6 mt-3">
                                    <input type="file" name="thumbnail_image" id="thumbnail_image"
                                        class="form-control" />
                                    @error('thumbnail_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12 mt-3">
                                    <textarea name="description" id="description"></textarea>
                                </div>
                                <div class="col-md-12 mt-4">
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <button class="btn btn-primary btn-sm me-md-2" type="submit">Submit</button>
                                        <button type="button" class="btn btn-secondary btn-sm"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

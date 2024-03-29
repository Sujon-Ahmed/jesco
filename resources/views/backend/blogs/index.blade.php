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
                                <th>Thumbnail</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($blogs as $key=>$blog)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td><img src="{{ asset('backend_assets/uploads/blogs/' . $blog->image) }}"
                                            alt="blog image" class="img-fluid" width="100"></td>
                                    <td>{{ $blog->title }}</td>
                                    <td>{{ $blog->relationWithCategory->category_name }}</td>
                                    <td>
                                        @if ($blog->status == 0)
                                            <a href="{{ route('blogs.status-change', encrypt($blog->id)) }}"
                                                class="btn btn-warning btn-sm">Unpublish</a>
                                        @else
                                            <a href="{{ route('blogs.status-change', encrypt($blog->id)) }}"
                                                class="btn btn-success btn-sm">Publish</a>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('single.blog-details', encrypt($blog->id)) }}" target="_blank"
                                            class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                        <!-- blog edit update button -->
                                        <button data-bs-toggle="modal"
                                            data-bs-target="#blogEditUpdateModal_{{ $blog->id }}"
                                            class="btn btn-success btn-sm"><i class="fa fa-edit"></i></button>

                                        <!-- modal for blog edit update -->
                                        <div class="modal" id="blogEditUpdateModal_{{ $blog->id }}">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title text-capitalize">Edit/Update Blog
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('blogs.update', encrypt($blog->id)) }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="container">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <input type="text" name="title"
                                                                            class="form-control"
                                                                            value="{{ $blog->title }}"
                                                                            placeholder="Enter blog title..." />
                                                                        @error('title')
                                                                            <span
                                                                                class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="col-6 mt-3">
                                                                        <select name="category_id" class="form-select">
                                                                            <option>-Select Category-</option>
                                                                            @foreach ($categories as $category)
                                                                                <option
                                                                                    {{ $blog->category_id == $category->id ? 'selected' : '' }}
                                                                                    value="{{ $category->id }}">
                                                                                    {{ $category->category_name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        @error('category_id')
                                                                            <span
                                                                                class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="col-4 mt-3">
                                                                        <input type="file" name="thumbnail_image"
                                                                            oninput="picEdit.src=window.URL.createObjectURL(this.files[0])"
                                                                            id="thumbnail_image" class="form-control" />
                                                                        @error('thumbnail_image')
                                                                            <span
                                                                                class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="col-2 mt-3">
                                                                        <img src="{{ asset('backend_assets/uploads/blogs/' . $blog->image) }}"
                                                                            id="picEdit" alt="blog image"
                                                                            class="img-fluid">
                                                                    </div>
                                                                    <div class="col-md-12 mt-3">
                                                                        <textarea name="editDescription" id="editDescription">{{ $blog->description }}</textarea>
                                                                    </div>
                                                                    <div class="col-md-12 mt-4">
                                                                        <div
                                                                            class="d-grid gap-2 d-md-flex justify-content-md-end">
                                                                            <button class="btn btn-success btn-sm me-md-2"
                                                                                type="submit">Update</button>
                                                                            <button type="button"
                                                                                class="btn btn-secondary btn-sm"
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
                                        <!-- blog delete button -->
                                        <button data-bs-toggle="modal"
                                            data-bs-target="#blogDeleteConfirmMessage_{{ $blog->id }}"
                                            class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                        <!-- delete modal -->
                                        <div class="modal" tabindex="-1"
                                            id="blogDeleteConfirmMessage_{{ $blog->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Confirm Message</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Are you sure Delete This Blog ?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary btn-sm"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <a href="{{ route('blogs.delete', encrypt($blog->id)) }}"
                                                            class="btn btn-danger btn-sm">Yes Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">
                                        {{ 'No Blog Found!' }}
                                    </td>
                                </tr>
                            @endforelse
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
                                    <input type="text" name="title" class="form-control"
                                        placeholder="Enter blog title..." />
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
                                <div class="col-4 mt-3">
                                    <input type="file" name="thumbnail_image" id="thumbnail_image"
                                        oninput="picAdd.src=window.URL.createObjectURL(this.files[0])"
                                        class="form-control" />
                                    @error('thumbnail_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-2 mt-3">
                                    <img src="" id="picAdd" alt="" class="img-fluid">
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

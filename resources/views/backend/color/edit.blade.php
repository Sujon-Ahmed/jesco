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
    <div class="col-lg-6">
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="text-center">Edit Color</h5>
            </div>
            <div class="card-body">
                <form action="{{ url('/color/update') }}" method="POST">
                    @csrf
                    <div class="form-group mt-2">
                        <label for="color_name">Color Name</label>
                        <input type="text" name="color_name" value="{{ $color_info->color_name }}" class="form-control">
                    </div>
                    <div class="form-group mt-2">
                        <label for="color_name">Color Code</label>
                        <input type="text" name="color_code" value="{{ $color_info->color_code }}" class="form-control">                    
                    </div>
                    <div class="d-grid">
                        <input type="hidden" name="id" value="{{ $color_info->id }}">
                        <button type="submit" class="btn btn-success btn-block">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
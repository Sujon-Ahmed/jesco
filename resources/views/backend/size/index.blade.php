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
                                    <a href="#" class="btn btn-outline-success btn-sm"><i class="fa fa-edit"></i></a>
                                    <a href="#" class="btn btn-outline-danger btn-sm"><i class="fa fa-trash"></i></a>
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
                        <input type="text" name="size" class="form-control">
                    </div>                   
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
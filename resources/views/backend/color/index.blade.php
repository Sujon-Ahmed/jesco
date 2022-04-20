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
                <a href="" data-bs-toggle="modal" data-bs-target="#addColor" class="btn btn-dark btn-sm text-light"><i class="fa fa-plus"></i> add new</a>
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
                            <td><span style="background: {{ $color->color_code }}; padding: 2px 5px; border-radius:5px;">{{ $color->color_name }}</span></td>                        
                            <td>
                                <a href="{{ route('color.edit', $color->id) }}" class="btn btn-outline-success btn-sm" ><i class="fa fa-edit"></i></a>
                                <a href="" data-bs-toggle="modal" data-bs-target="#deleteColor{{$color->id}}" class="btn btn-outline-danger btn-sm"><i class="fa fa-trash"></i></a>
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
            <form action="{{ url('/color/insert') }}" method="POST">
                @csrf
                <div class="form-group mt-2">
                    <label for="color_name">Color Name</label>
                    <input type="text" name="color_name" value="{{ $color->name }}" class="form-control">
                </div>
                <div class="form-group mt-2">
                    <label for="color_name">Color Code</label>
                    <input type="text" name="color_code" class="form-control">                    
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
<!-- Modal for delete to color -->
<div class="modal fade" id="deleteColor{{$color->id}}" tabindex="-1" aria-labelledby="deleteColor" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-capitalize" id="deleteColor">color delete confirmed message</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Are You Sure Delete This Color ?
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                <a href="{{ route('color.delete', $color->id) }}" class="btn btn-danger btn-sm">Delete</a>
            </div>
        </form>
      </div>
    </div>
</div>


@endsection
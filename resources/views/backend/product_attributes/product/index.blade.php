@extends('backend.layouts.master')

@section('content')
    <div class="pagetitle">
        <h1>Product</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="">Products</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between">
                    <h5>product list</h5>
                    <a href="" data-bs-toggle="modal" data-bs-target="#addProduct"
                        class="btn btn-dark btn-sm text-light"><i class="fa fa-plus"></i> add new</a>
                </div>
                <div class="card-body mt-3">
                    <table class="table" id="myTable">
                        <thead>
                            <tr>
                                <th>sl</th>
                                <th>product img</th>
                                <th>name</th>
                                <th>qty</th>
                                <th>reg-price</th>
                                <th>sale-price</th>
                                <th>discount</th>
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
    <!-- Modal for add to color -->
    <div class="modal fade" id="addProduct" tabindex="-1" aria-labelledby="addColor" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addColor">Add New Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <input type="text" name="product_name" class="form-control" placeholder="Product name">
                            </div>
                            <div class="col">
                                <input type="number" name="product_price" class="form-control" placeholder="Product Price">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <select name="category_id" id="category_id" class="form-control">
                                    <option value="" class="form-control">-- Select Category --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" class="form-control">
                                            {{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <select name="subcategory_id" id="subcategory_id" class="form-control">
                                    <option value="" class="form-control">-- Select Subcategory --</option>
                                </select>
                            </div>
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
    <!-- Modal for edit / update color -->
    {{-- <div class="modal fade" id="editUpdateColor" tabindex="-1" aria-labelledby="addColor" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addColor">edit / update color</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('color.update') }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="colorId" id="colorId">
                        <div class="form-group mt-2">
                            <label for="color_name">Color Name</label>
                            <input type="text" name="color_name" id="updated_color_name" class="form-control">
                            @error('color_name')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <label for="color_name">Color Code</label>
                            <input type="text" name="color_code" id="updated_color_code" class="form-control">
                            @error('color_code')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success btn-sm">update</button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}
    <!-- Modal for delete to color -->
    {{-- <div class="modal fade" id="deleteColorModal" tabindex="-1" aria-labelledby="deleteColor" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-capitalize" id="deleteColor">color delete confirmed message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('color.delete') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        Are You Sure Delete This Color ?
                        <input type="hidden" name="colorDeleteId" id="colorDeleteId">
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
        $('#category_id').change(function(){
            var category_id = $('#category_id').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax ({
                type:'POST',
                url:'/admin/getCategory',
                data:{'category_id':category_id},
                success:function(data) {
                   $('#subcategory_id').html(data);
                }
            });
        });
    </script>
@endsection

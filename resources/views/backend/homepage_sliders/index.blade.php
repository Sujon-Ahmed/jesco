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
                                <th>status</th>
                                <th>options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sliders as $key => $slider)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $slider->sub_title }}</td>
                                    <td>{{ $slider->title }}</td>
                                    <td><img src="{{ asset('backend_assets/uploads/slider') }}/{{ $slider->image }}"
                                            width="50" alt=""></td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" onchange="update_slider_status(this)"
                                                value="{{ $slider->id }}" {{ $slider->status == '1' ? 'checked' : '' }}>
                                            <span class="slider"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <button type="button" data-id="{{ $slider->id }}"
                                            class="btn btn-outline-success btn-sm brandEditBtn" data-bs-toggle="tooltip"
                                            data-bs-placement="left" title="Edit"><i class="fa fa-edit"></i></button>
                                        <button type="button" value="{{ $slider->id }}"
                                            class="btn btn-outline-danger btn-sm brandDeleteBtn" data-bs-toggle="tooltip"
                                            data-bs-placement="right" title="Delete"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal for add slider -->
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
                            <input type="file" name="image" id="image" class="form-control file-control">
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
    <!-- Modal for edit / update slider -->
    <div class="modal fade" id="ModifySlider" tabindex="-1" aria-labelledby="slider" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-capitalize" id="category">Edit / Update Slider</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('slider.update') }}" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="sliderId" id="sliderId">
                        <div class="form-group mt-2">
                            <label for="modify_sub_title" class="form-label">Sub Title</label>
                            <input type="text" name="modify_sub_title" id="modify_sub_title" class="form-control"
                                value="{{ old('modify_sub_title') }}">
                            @error('modify_sub_title')
                                <span style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <label for="modify_title" class="form-label">Title</label>
                            <input type="text" name="modify_title" id="modify_title" class="form-control"
                                value="{{ old('modify_title') }}">
                            @error('modify_title')
                                <span style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <label for="modify_image">Slider Image</label>
                            <input type="file" name="modify_image" id="modify_image"
                                class="form-control file-control">
                            @error('modify_image')
                                <span style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="modal-footer d-flex">
                            <button type="button" class="btn btn-secondary btn-sm"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
        $(document).ready(function() {
            $(document).on('click', '.addSlider', function() {
                $('#addNewSlider').modal('show');
            });
            $(document).on('click', '.brandEditBtn', function() {
                $('#ModifySlider').modal('show');
                var bannerSliderId = $(this).data('id');
                $.ajax({
                    type: "GET",
                    url: "/admin/getBannerSlider/" + bannerSliderId,
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        $('#modify_sub_title').val(response.data.sub_title);
                        $('#modify_title').val(response.data.title);
                        $('#modify_image').val(response.data.image);
                    }
                });
            });
        });
    </script>
    {{-- slider banner status update --}}
    <script>
        function update_slider_status(el) {
            var slider_status = 0;
            if (el.checked) {
                var slider_status = 1;
            }
            $.post('{{ route('slider.status.update') }}', {
                _token: '{{ csrf_token() }}',
                id: el.value,
                slider_status: slider_status
            }, function(data) {
                if (data == 1) {
                    toastr.success('success', 'Status changed Successfully');
                } else {
                    toastr.error('error', 'Something went wrong');
                }
            });
        }
    </script>

@endsection

@extends('backend.layouts.master')

@section('content')
    <div class="pagetitle">
        <h1>Teams</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Team Members</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between">
                    <h5>Team Members</h5>
                    <button type="button" class="btn btn-dark btn-sm float-end addMember">add member</button>
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
    {{-- modal section for add new team --}}
    <div class="modal fade" id="addNewMember" tabindex="-1" aria-labelledby="team" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-capitalize" id="team">Add New Member</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('team.member.store') }}" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group mt-2">
                            <label for="member_name" class="form-label">Member Name</label>
                            <input type="text" name="member_name" id="member_name" class="form-control"
                                value="{{ old('member_name') }}">
                            @error('member_name')
                                <span style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <label for="member_designation" class="form-label">Member Designation</label>
                            <input type="text" name="member_designation" id="member_designation" class="form-control"
                                value="{{ old('member_designation') }}">
                            @error('member_designation')
                                <span style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <label for="member_photo">Brand Thumbnail</label>
                            <input type="file" name="member_photo" id="member_photo"
                                class="form-control file-control">
                            @error('member_photo')
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
    {{-- <div class="modal fade" id="deleteBrandModal">
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
    </div> --}}
    {{-- modal section for edit / update brand --}}
    {{-- <div class="modal fade" id="editUpdatebrand" tabindex="-1" aria-labelledby="category" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-capitalize" id="category">edit / update brand</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('brand.update') }}" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="edited_brand_id" id="edited_brand_id">
                        <div class="form-group mt-2">
                            <label for="edited_brand_name" class="form-label">Brand Name</label>
                            <input type="text" name="edited_brand_name" id="edited_brand_name" class="form-control"
                                value="{{ old('edited_brand_name') }}">
                            @error('edited_brand_name')
                                <span style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <label for="edited_brand_image">Brand Thumbnail</label>
                            <input type="file" name="edited_brand_image" id="edited_brand_image"
                                class="form-control file-control"
                                oninput="pic.src=window.URL.createObjectURL(this.files[0])">
                            @error('edited_brand_image')
                                <span style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <img style="width: 300px" id="pic" alt="">
                        <div class="modal-footer d-flex">
                            <button type="button" class="btn btn-secondary btn-sm"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success btn-sm">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}
@endsection
@section('scripts')
    {{-- script for add new brand --}}
    <script>
        $(document).ready(function() {
            $(document).on('click', '.addMember', function() {
                $('#addNewMember').modal('show');
            });
        });
    </script>
    {{-- script for delete brand --}}
    <script>
        $(document).ready(function() {
            $(document).on('click', '.brandDeleteBtn', function() {
                let brandId = $(this).val();
                $('#deleteBrandModal').modal('show');
                $('#deleted_brand_id').val(brandId);
            });
        });
    </script>
    {{-- script for edit / update brand --}}
    <script>
        $(document).ready(function() {
            $(document).on('click', '.brandEditBtn', function() {
                $('#editUpdatebrand').modal('show');
                let = brandId = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "/admin/get-brand-info/" + brandId,
                    dataType: "json",
                    success: function(response) {
                        $('#edited_brand_id').val(brandId);
                        $('#edited_brand_name').val(response.brand_info.brand_name);
                    }
                });
            });
        });
    </script>
    {{-- script for update brand status --}}
    <script>
        $(document).ready(function() {
            function update_brand_status(el) {
                var brand_status = 0;
                if (el.checked) {
                    var brand_status = 1;
                }
                $.post('{{ route('brand.change-status') }}', {
                    _token: '{{ csrf_token() }}',
                    id: el.value,
                    brand_status: brand_status
                }, function(data) {
                    if (data == 1) {
                        toastr.success('success', 'Status changed Successfully');
                    } else {
                        toastr.error('error', 'Something went wrong');
                    }
                });
            }
        });
    </script>
@endsection

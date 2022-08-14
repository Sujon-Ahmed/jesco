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
                            @foreach ($members as $key => $member)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $member->name }}</td>
                                    <td>
                                        <img src="{{ asset('backend_assets/uploads/teams') }}/{{ $member->photo }}"
                                            alt="team member" width="100">
                                    </td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" onchange="update_team_status(this)"
                                                value="{{ $member->id }}" {{ $member->status == '1' ? 'checked' : '' }}>
                                            <span class="slider"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <button type="button" value="{{ $member->id }}"
                                            class="btn btn-outline-success btn-sm memberEditBtn" data-bs-toggle="tooltip"
                                            data-bs-placement="left" title="Edit"><i class="fa fa-edit"></i></button>
                                        <button type="button" value="{{ $member->id }}"
                                            class="btn btn-outline-danger btn-sm memberDeleteBtn" data-bs-toggle="tooltip"
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
                            <input type="file" name="member_photo" id="member_photo" class="form-control file-control">
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
    <div class="modal fade" id="deleteMemberModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-capitalize" id="categoryDelete">confirmed message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('team.member.delete') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        Are You Sure Delete This Brand ?
                        <input type="hidden" name="deleted_tem_member_id" id="deleted_tem_member_id">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- modal section for edit / update brand --}}
    <div class="modal fade" id="editUpdateMember" tabindex="-1" aria-labelledby="team" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-capitalize" id="team">edit / update brand</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('team.member.update') }}" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="edit_member_id" id="edit_member_id" class="form-control">
                        <div class="form-group mt-2">
                            <label for="edit_member_name" class="form-label">Member Name</label>
                            <input type="text" name="edit_member_name" id="edit_member_name" class="form-control"
                                value="{{ old('edit_member_name') }}">
                            @error('edit_member_name')
                                <span style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <label for="edit_member_designation" class="form-label">Member Designation</label>
                            <input type="text" name="edit_member_designation" id="edit_member_designation" class="form-control"
                                value="{{ old('edit_member_designation') }}">
                            @error('edit_member_designation')
                                <span style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <label for="edit_member_photo">Brand Thumbnail</label>
                            <input type="file" name="edit_member_photo" id="edit_member_photo" class="form-control file-control">
                            @error('edit_member_photo')
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
            $(document).on('click', '.memberDeleteBtn', function() {
                let memberId = $(this).val();
                $('#deleteMemberModal').modal('show');
                $('#deleted_tem_member_id').val(memberId);
            });
        });
    </script>
    {{-- script for edit / update brand --}}
    <script>
        $(document).ready(function() {
            $(document).on('click', '.memberEditBtn', function() {
                $('#editUpdateMember').modal('show');
                let = teamMemberId = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "/admin/get-team-member-info/" + teamMemberId,
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        $('#edit_member_id').val(teamMemberId);
                        $('#edit_member_name').val(response.member_info.name);
                        $('#edit_member_designation').val(response.member_info.designation);
                        $('#edit_member_photo').val(response.member_info.photo);
                    }
                });
            });
        });
    </script>
    {{-- script for update brand status --}}
    <script>
        function update_team_status(el) {
            var team_status = 0;
            if (el.checked) {
                var team_status = 1;
            }
            $.post('{{ route('team.member.status.update') }}', {
                _token: '{{ csrf_token() }}',
                id: el.value,
                team_status: team_status
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

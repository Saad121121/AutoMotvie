@extends('layouts.dashboardlayout')
@section('title', 'Roles')
@section('breadcrumb1', 'User Management')

@section('breadcrumb', 'Roles')
@section('pageTitle', 'Roles')
@section('content')

    <div class="body-content">
        <!-- Create Role Button -->
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createRoleModal">Create
            Role</button>

        <!-- Roles Table -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>Success - </strong> {{ session('success') }}
            </div>
        @endif
        <table id="roleTable" class="table table-striped table-centered mb-0">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Role Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $index => $role)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $role->name }}</td>
                        <td class="table-action">
                            <a href="#" class="action-icon"
                                onclick="showUpdateRoleModal({{ $role->id }}, '{{ $role->name }}')"> <i
                                    class="mdi mdi-pencil"></i></a>
                            @if ($role->id == 1)
                            @else
                                <a href="#" class="action-icon" onclick="deleteRole({{ $role->id }})"> <i
                                        class="mdi mdi-delete"></i></a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Create Role Modal -->
    <div class="modal fade" id="createRoleModal" tabindex="-1" aria-labelledby="createRoleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createRoleModalLabel">Create Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Role Form -->
                    <form action="{{ route('roles.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="createRoleName" class="form-label">Role Name</label>
                            <input type="text" id="createRoleName" name="name" class="form-control"
                                placeholder="Role Name" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Role Modal -->
    <div class="modal fade" id="updateRoleModal" tabindex="-1" aria-labelledby="updateRoleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateRoleModalLabel">Update Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Role Form -->
                    <form id="updateRoleForm" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="updateRoleId" name="roleId" value="">
                        <div class="mb-3">
                            <label for="updateRoleName" class="form-label">Role Name</label>
                            <input type="text" id="updateRoleName" name="name" class="form-control"
                                placeholder="Role Name" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#roleTable').DataTable({
                // DataTables configuration
                paging: true, // Enable pagination
                searching: true, // Enable search
                ordering: true, // Enable sorting
                lengthChange: false, // Disable page length change
                info: true, // Show table information
                pageLength: 15,
                language: {
                    searchPlaceholder: "Search records...", // Placeholder text for search
                    paginate: {
                        previous: "Prev",
                        next: "Next"
                    },
                    info: "Showing _START_ to _END_ of _TOTAL_ entries", // Info text
                    infoEmpty: "No entries found", // Info text when no entries
                    infoFiltered: "(filtered from _MAX_ total entries)"
                }
            });
        });
        // Function to show the update role modal with pre-filled data
        function showUpdateRoleModal(id, name) {
            document.getElementById('updateRoleId').value = id;
            document.getElementById('updateRoleName').value = name;
            document.getElementById('updateRoleForm').action = "{{ url('roles') }}/" + id;
            var updateModal = new bootstrap.Modal(document.getElementById('updateRoleModal'));
            updateModal.show();
        }

        // Function to handle role deletion with SweetAlert2
        function deleteRole(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Perform AJAX request to delete the role
                    $.ajax({
                        url: `/roles/${id}`,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                'The role has been deleted.',
                                'success'
                            ).then(() => {
                                // Reload the page or update the table
                                location.reload();
                            });
                        },
                        error: function(xhr) {
                            Swal.fire(
                                'Error!',
                                'There was an issue deleting the role.',
                                'error'
                            );
                        }
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire(
                        'Cancelled',
                        'The role is safe :)',
                        'error'
                    );
                }
            });
        }
    </script>
@endpush

@extends('layouts.dashboardlayout')
@section('title', 'Vehicle Make')
@section('breadcrumb1', 'Vehicle Management')
@section('breadcrumb', 'Vehicle Make')
@section('pageTitle', 'Vehicle Make')
@section('content')

    <div class="container">
        <!-- Create Role Button -->
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createRoleModal">Create
            Vehicle Make</button>

        <!-- Roles Table -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>Success - </strong> {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                    aria-label="Close"></button>
                <strong>Error - </strong> {{ session('error') }}
            </div>
        @endif
        <div class="table-responsive">
            <table id="vehiclemakeTable" class="table table-striped table-centered mb-0">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Name</th>
                        <th>Country Of Origin</th>
                        <th>Year Established</th>
                        <th>Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($makes as $index => $make)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $make->name }}</td>
                            <td>{{ $make->country_of_origin ?? '-' }}</td>
                            <td>{{ $make->year_established ?? '-' }}</td>
                            <td>{{ $make->vehicle_type ?? '-' }}</td>
                            <td class="table-action">
                                <a href="#" class="action-icon"
                                    onclick="showUpdateRoleModal(
                                     {{ $make->id }},
                                    '{{ $make->name }}',
                                    '{{ $make->country_of_origin ?? '' }}',
                                     {{ $make->year_established ?? '' }},
                                    '{{ $make->vehicle_type ?? '' }}')">
                                    <i class="mdi mdi-pencil"></i>
                                </a>

                                <a href="#" class="action-icon" onclick="deletemake({{ $make->id }})"> <i
                                        class="mdi mdi-delete"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- Chart Section -->
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <canvas id="vehicleMakeChart"></canvas>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Create Role Modal -->
    <div class="modal fade" id="createRoleModal" tabindex="-1" aria-labelledby="createRoleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createRoleModalLabel">Create Vehicle Make</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Role Form -->
                    <form action="{{ route('vehicle-make.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="createRoleName" class="form-label">Name</label>
                            <input type="text" id="createRoleName" name="name" class="form-control"
                                placeholder="e.g :Toyota" required>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
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
                    <h5 class="modal-title" id="updateRoleModalLabel">Update Vehicle Make</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Role Form -->
                    <form id="updateRoleForm" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="updateRoleId" name="makeId" value="">
                        <div class="mb-3">
                            <label for="updateRoleName" class="form-label">Name</label>
                            <input type="text" id="updateRoleName" name="name" class="form-control" placeholder="Name"
                                required>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
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
        document.addEventListener('DOMContentLoaded', function() {
            // Get data for the chart
            var vehicleMakeData = @json($vehicleCountsByMake);
            var makeNames = @json($makes->pluck('name', 'id'));

            // Data for Chart.js
            var labels = [];
            var data = [];

            for (const [makeId, count] of Object.entries(vehicleMakeData)) {
                labels.push(makeNames[makeId]);
                data.push(count);
            }

            // Create the chart
            var ctx = document.getElementById('vehicleMakeChart').getContext('2d');
            var vehicleMakeChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Number of Vehicles by Make',
                        data: data,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
        $(document).ready(function() {
            $('#vehiclemakeTable').DataTable({
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
            document.getElementById('updateRoleForm').action = "{{ url('vehicle-make') }}/" + id;
            var updateModal = new bootstrap.Modal(document.getElementById('updateRoleModal'));
            updateModal.show();
        }

        // Function to handle role deletion with SweetAlert2
        function deletemake(id) {
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
                    $.ajax({
                        url: `/vehicle-make/${id}`, // Updated URL to match the owner route
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}' // Ensure CSRF token is included
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                'The Vehicle make has been deleted.',
                                'success'
                            ).then(() => {
                                location.reload(); // Reload the page to reflect changes
                            });
                        },
                        error: function(xhr) {
                            Swal.fire(
                                'Error!',
                                'There was an issue deleting the Vehicle Make.',
                                'error'
                            );
                        }
                    });
                }
            });
        }
    </script>
@endpush

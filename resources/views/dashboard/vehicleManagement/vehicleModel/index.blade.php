@extends('layouts.dashboardlayout')
@section('title', 'Vehicle Model')
@section('breadcrumb1', 'Vehicle Management')
@section('breadcrumb', 'Vehicle Model')
@section('pageTitle', 'Vehicle Model')
@section('content')

    <div class="container">
        <!-- Create models Button -->
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createRoleModal">Create
            Vehicle Model</button>

        <!-- models Table -->
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
            <table id="vehiclemodelTable" class="table table-striped table-centered mb-0">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Name</th>
                        <th>Make</th>
                        <th>Year of Release</th>
                        <th>Fuel Type</th>
                        <th>Transmission Type</th>
                        <th>Body Style</th>
                        <th>Engine Type</th>
                        <th>Engine Capacity</th>
                        <th>Horsepower</th>
                        <th>Torque</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($models as $index => $model)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $model->name }}</td>
                            <td>{{ $model->make ? $model->make->name : '-' }}</td>
                            <td>{{ $model->year_of_release ?? '-' }}</td>
                            <td>{{ $model->fuel_type ?? '-' }}</td>
                            <td>{{ $model->transmission_type ?? '-' }}</td>
                            <td>{{ $model->body_style ?? '-' }}</td>
                            <td>{{ $model->engine_type ?? '-' }}</td>
                            <td>{{ $model->engine_capacity ?? '-' }}</td>
                            <td>{{ $model->horsepower ?? '-' }}</td>
                            <td>{{ $model->torque ?? '-' }}</td>
                            <td class="table-action">
                                <a href="#" class="action-icon"
                                    onclick='showUpdateRoleModal(@json($model))'>
                                    <i class="mdi mdi-pencil"></i>
                                </a>

                                <a href="#" class="action-icon" onclick="deletemodels({{ $model->id }})"> <i
                                        class="mdi mdi-delete"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body" style="height: 500px; position: relative;">
                        <h5 class="card-title">Vehicle Models by Make</h5>
                        <canvas id="vehicleModelChart" style="max-height: 100%;"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Create models Modal -->
    <div class="modal fade" id="createRoleModal" tabindex="-1" aria-labelledby="createRoleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createRoleModalLabel">Create Vehicle Model</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Model Form -->
                    <form action="{{ route('vehicle-model.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="createRoleName" class="form-label">Name</label>
                            <input type="text" id="createRoleName" name="name" class="form-control"
                                placeholder="e.g :Camry" required>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- MAke --}}
                        <div class="mb-3">
                            <label for="make_id" class="form-label">Make</label>
                            <select class="form-select" name="make_id" id="make_id">
                                <option value="" disabled selected>Select...</option>
                                @foreach ($makes as $make)
                                    <option value="{{ $make->id }}"
                                        {{ old('make_id') == $make->id ? 'selected' : '' }}>
                                        {{ $make->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('make_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Update models Modal -->
    <div class="modal fade" id="updateRoleModal" tabindex="-1" aria-labelledby="updateRoleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateRoleModalLabel">Update Vehicle Model</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Models Form -->
                    <form id="updateRoleForm" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="updateRoleId" name="ModelId" value="">
                        <div class="mb-3">
                            <label for="updateRoleName" class="form-label">Name</label>
                            <input type="text" id="updateRoleName" name="name" class="form-control"
                                placeholder="Name" required>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="editMake" class="form-label">Make</label>
                            <select id="editMake" name="make_id" class="form-select">
                                <option value="" disabled {{ $make->id ? '' : 'selected' }}>Select...</option>
                                @foreach ($makes as $make)
                                    <option value="{{ $make->id }}">{{ $make->name }}</option>
                                @endforeach
                            </select>
                            @error('make_id')
                                <div id="editMakeError" class="text-danger">{{ $message }}</div>
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
            var ctx = document.getElementById('vehicleModelChart').getContext('2d');
            var vehicleModelChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($makeNames),
                    datasets: [{
                        label: 'Number of Models',
                        data: @json($modelCounts),
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
        $(document).ready(function() {
            $('#vehiclemodelTable').DataTable({
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
        function showUpdateRoleModal(id, name, makeId) {
            document.getElementById('updateRoleId').value = id;
            document.getElementById('updateRoleName').value = name;
            document.getElementById('editMake').value = makeId;
            document.getElementById('updateRoleForm').action = "{{ url('vehicle-model') }}/" + id;
            var updateModal = new bootstrap.Modal(document.getElementById('updateRoleModal'));
            updateModal.show();
        }

        // Function to handle role deletion with SweetAlert2
        function deletemodels(id) {
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
                        url: `/vehicle-models/${id}`, // Updated URL to match the owner route
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

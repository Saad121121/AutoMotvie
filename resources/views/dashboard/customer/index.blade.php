@extends('layouts.dashboardlayout')
@section('title', 'Customers')
@section('breadcrumb1', 'Company')
@section('breadcrumb', 'Customers')
@section('pageTitle', 'Customers')
@section('content')

    <div class="container">

        <!-- Create Role Button -->
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createUserModal">Create
            Customer</button>

        <!-- User Table -->
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
            <table id="userTable" class="table table-striped table-centered mb-0">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Dealer</th>
                        <th>Image</th>
                        <th>Actions</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $index => $user)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->showroom->shr_name ?? '-' }}</td>
                            <td><img src="{{ $user->image ? asset('storage/users/' . $user->image) : asset('build/assets/images/users/avatar-1.jpg') }}"
                                    alt="image" class="img-fluid avatar-lg rounded-circle"></td>
                            <td class="table-action">
                                <a href="#" class="action-icon"
                                    onclick="showUpdateUserModal({{ $user->id }}, '{{ $user->name }}', '{{ $user->email }}', '{{ $user->image }}', '{{ $user->showroom->id ?? '' }}')">
                                    <i class="mdi mdi-pencil"></i>
                                </a>
                                <a href="#" class="action-icon" onclick="deleteUser({{ $user->id }})">
                                    <i class="mdi mdi-delete"></i>
                                </a>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="row mt-4">
            <!-- Bar Chart -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body" style="height: 500px; position: relative;">
                        <h5 class="card-title">Number of Customers per Showroom</h5>
                        <canvas id="customerBarChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Doughnut Chart -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body" style="height: 500px; position: relative;">
                        <h5 class="card-title">Customer Distribution by Showroom</h5>
                        <canvas id="customerDoughnutChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create user Modal -->
    <div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createUserModalLabel">Create User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- User Form -->
                    <form action="{{ route('customer.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Name --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="John Doe"
                                value="{{ old('name') }}" required>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control"
                                placeholder="John@gmail.com" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group input-group-merge">
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="Enter your password" required>
                                <div class="input-group-text" data-password="false">
                                    <span class="password-eye"></span>
                                </div>
                            </div>
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" onchange="previewNewwImage()" name="image" id="image"
                                class="form-control" required>
                            @error('image')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Preview Image -->
                        <div class="mb-3">
                            <label class="form-label">Image Preview</label>
                            <img id="imagePreview" src="" alt="Image Preview"
                                class="img-fluid avatar-xl rounded-circle" style="display: none;">
                        </div>
                        @if (Auth::user()->role_id == 5)
                            {{-- Showroom --}}
                            <div class="mb-3">
                                <label for="showroom_id" class="form-label">Showroom</label>
                                <select id="showroom_id" name="showroom_id" class="form-select" required>
                                    <option value="" selected>Select...</option>
                                    @foreach ($showrooms as $showroom)
                                        <option value="{{ $showroom->id }}">{{ $showroom->shr_name }}</option>
                                    @endforeach
                                </select>
                                @error('showroom_id')
                                    <div id="editUserRoleError" class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        @else
                            <input type="hidden" style="display: none !important;"
                                value="{{ Auth::user()->showroom_id }}">
                        @endif

                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- User Form -->
                    <form id="editUserForm" method="POST" enctype="multipart/form-data"
                        action="{{ route('customer.update', ['id' => 'id']) }}">

                        @csrf
                        @method('PUT')

                        <!-- Hidden ID Field -->
                        <input type="hidden" id="editUserId" name="userId">

                        <!-- Name -->
                        <div class="mb-3">
                            <label for="editUserName" class="form-label">Name</label>
                            <input type="text" id="editUserName" name="name" class="form-control"
                                placeholder="John Doe" required>
                            @error('name')
                                <div id="editUserNameError" class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="editUserEmail" class="form-label">Email</label>
                            <input type="email" id="editUserEmail" name="email" class="form-control"
                                placeholder="John@gmail.com">
                            @error('email')
                                <div id="editUserEmailError" class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password (Optional) -->
                        <div class="mb-3">
                            <label for="editUserPassword" class="form-label">Password (leave empty if not
                                changing)</label>
                            <input type="password" id="editUserPassword" name="password" class="form-control"
                                placeholder="Enter new password">
                            @error('password')
                                <div id="editUserPasswordError" class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Current Image Display -->
                        <div class="mb-3">
                            <label for="currentUserImageDisplay" class="form-label">Current Image</label>
                            <img id="currentUserImageDisplay" src="" alt="User Image"
                                class="img-fluid avatar-xl rounded-circle" style="display: block;">
                        </div>

                        <!-- New Image -->
                        <div class="mb-3">
                            <label for="editUserImage" class="form-label">New Image (optional)</label>
                            <input type="file" id="editUserImage" name="image" class="form-control"
                                onchange="previewNewImage()">
                            @error('image')
                                <div id="editUserImageError" class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        @if (Auth::user()->role_id == 5)

                            <!-- Showroom -->
                            <div class="mb-3">
                                <label for="edit_showroom_id" class="form-label">Showroom</label>
                                <select id="edit_showroom_id" name="showroom_id" class="form-select" required>
                                    <option value="">Select...
                                    </option>
                                    @foreach ($showrooms as $showroom)
                                        <option value="{{ $showroom->id }}">{{ $showroom->shr_name }}</option>
                                    @endforeach
                                </select>
                                @error('showroom_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        @else
                            <input type="hidden" style="display: none !important;"
                                value="{{ Auth::user()->showroom_id }}">
                        @endif



                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Bar Chart for Customer Count per Showroom
            var ctxBar = document.getElementById('customerBarChart').getContext('2d');
            var customerBarChart = new Chart(ctxBar, {
                type: 'bar',
                data: {
                    labels: @json($showroomNames), // Showroom names from the controller
                    datasets: [{
                        label: 'Number of Customers',
                        data: @json($customerCounts), // Customer counts from the controller
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
                    },
                    plugins: {
                        legend: {
                            display: true
                        }
                    }
                }
            });

            // Doughnut Chart for Customer Distribution by Showroom
            var ctxDoughnut = document.getElementById('customerDoughnutChart').getContext('2d');
            var customerDoughnutChart = new Chart(ctxDoughnut, {
                type: 'doughnut',
                data: {
                    labels: @json($showroomNames), // Showroom names from the controller
                    datasets: [{
                        label: 'Customer Distribution',
                        data: @json($customerCounts), // Customer counts from the controller
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'bottom'
                        }
                    }
                }
            });
        });

        function previewNewwImage() {
            const fileInput = document.getElementById('image');
            const imagePreview = document.getElementById('imagePreview');

            if (fileInput.files && fileInput.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block'; // Show the image preview
                }

                reader.readAsDataURL(fileInput.files[0]);
            } else {
                imagePreview.style.display = 'none'; // Hide the image preview if no file is selected
            }
        }
        $(document).ready(function() {
            $('#userTable').DataTable({
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
        function showUpdateUserModal(id, name, email, image, showroomId) {
            var userRoleId = "{{ Auth::user()->role_id }}";
            if (image === '') {
                image = 'build/assets/images/users/avatar-1.jpg';
            }
            document.getElementById('editUserId').value = id;
            document.getElementById('editUserName').value = name;
            document.getElementById('editUserEmail').value = email;
            if (userRoleId == 5) {

                document.getElementById('edit_showroom_id').value = showroomId;
            }

            // Handle image display
            const imageDisplay = document.getElementById('currentUserImageDisplay');
            if (image) {
                imageDisplay.src = `{{ asset('storage/users') }}/${image}`;
            } else {
                imageDisplay.src = '';
            }

            // Clear the file input
            document.getElementById('editUserImage').value = '';

            // Show the modal
            var editUserModal = new bootstrap.Modal(document.getElementById('editUserModal'));
            editUserModal.show();
        }

        function previewNewImage() {
            const fileInput = document.getElementById('editUserImage');
            const imageDisplay = document.getElementById('currentUserImageDisplay');

            if (fileInput.files && fileInput.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    imageDisplay.src = e.target.result;
                }

                reader.readAsDataURL(fileInput.files[0]);
            }
        }
        // For deleting a user
        function deleteUser(id) {
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
                        url: `/users/${id}`, // URL must match the route
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}' // Ensure CSRF token is included
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                'The user has been deleted.',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        },
                        error: function(xhr) {
                            Swal.fire(
                                'Error!',
                                'There was an issue deleting the user.',
                                'error'
                            );
                        }
                    });
                }
            });
        }
    </script>
@endpush

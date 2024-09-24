@extends('layouts.dashboardlayout')
@if (Auth::user()->role_id == 5)
    @section('title', 'Accident Report')
    @section('breadcrumb1', 'Accident Management')
    @section('breadcrumb', 'Accident Report')
    @section('pageTitle', 'Accident Report')
    @section('content')
    @else
    @section('title', 'Accidents')
    @section('breadcrumb1', 'Accident Management')
    @section('breadcrumb', 'Accidents')
    @section('pageTitle', 'Accidents')
    @section('content')
    @endif


    <div class="">
        <!-- Create Service Button -->
        <form method="POST" action="{{ route('accidents.search') }}">
            @csrf
            <div class="row gy-2 gx-2 align-items-center">
                <div class="col-auto">
                    <label class="form-label">Input VIN</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="vin" placeholder="e.g HEX234GON45"
                            aria-label="VIN" required>
                        <button type="submit" class="btn btn-dark">Search</button>
                    </div>
                </div>
            </div>
        </form>
        <div class="d-flex justify-content-end align-items-center">
            <form id="resetForm" action="{{ route('accidents.index') }}" method="GET">
                <button type="submit" class="btn btn-primary mb-3">
                    <i class="mdi mdi-autorenew"></i>
                    Reset
                </button>
            </form>
            @if ($accidents)
                <button type="button" class="btn btn-primary mb-3 ms-3" data-bs-toggle="modal"
                    data-bs-target="#createServiceModal">Create
                    Accident Report
                </button>
            @endif
        </div>
        <!-- Services Table -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                    aria-label="Close"></button>
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
        @if (isset($message))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>{{ $message }}</strong>
            </div>
        @endif
        <div class="table-responsive">
            <table id="serviceTable" class="table table-striped table-centered mb-0">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Accident Image</th>
                        <th>Vehicle VIN</th>
                        <th>Dealer</th>
                        <th>Owner</th>
                        <th>Accident Date</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($accidents as $index => $accident)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                @if (isset($accident->images) && count($accident->images) > 0)
                                    <img src="{{ asset('storage/' . $accident->images[0]['image_path']) }}" alt="image"
                                        class="img-fluid avatar-lg rounded-circle">
                                @else
                                    <img src="{{ asset('build/assets/images/default_car.jpg') }}" alt="default image"
                                        class="img-fluid avatar-lg rounded-circle">
                                @endif
                            </td>
                            <td>{{ $accident->vehicle ? $accident->vehicle->vin : '-' }}</td>
                            <td>{{ $accident->vehicle->showroom ? $accident->vehicle->showroom->shr_name : '-' }}</td>
                            <td>{{ $accident->vehicle->owner ? $accident->vehicle->owner->name : '-' }}</td>
                            <td>{{ $accident->accident_date ?? '-' }}</td>
                            <td>{{ $accident->description ?? '-' }}</td>
                            <td class="table-action">
                                @if (isset($accidents))
                                    @if (Auth::user()->showroom_id == $accident->vehicle->showroom->id)
                                        @if (isset($accident))
                                            <a href="#" class="action-icon"
                                                onclick="showUpdateAccidentModal({{ $accident->id }})">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>
                                        @endif
                                    @endif
                                    <a href="#" class="action-icon" data-bs-toggle="modal"
                                        data-bs-target="#imageGalleryModal"
                                        onclick="loadGalleryImages({{ $accident->id }})">
                                        <i class="dripicons-camera"></i>
                                    </a>
                                @endif
                                @if (Auth::user()->role_id == 5)
                                    <a href="#" class="action-icon" onclick="deleteService({{ $accident->id }})">
                                        <i class="mdi mdi-delete"></i>
                                    </a>
                                @endif

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if (Auth::user()->role_id == 5)
            <div class="row mt-4">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body" style="height: 500px; position: relative;">
                            <h5 class="card-title">Accidents by Vehicle</h5>
                            <canvas id="accidentsByVehicleChart" style="max-height: 100%;"></canvas>
                        </div>
                    </div>
                </div>
                <!-- Accidents by Date Chart -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body" style="height: 500px; position: relative;">
                            <h5 class="card-title">Accidents by Date</h5>
                            <canvas id="accidentsByDateChart" style="max-height: 100%;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    {{-- {{ dd($vehicle, $showrooms) }} --}}
    <!-- Image Gallery Modal -->
    <div class="modal fade" id="imageGalleryModal" tabindex="-1" aria-labelledby="imageGalleryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageGalleryModalLabel">Vehicle Accident Images</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row" id="galleryImages">
                        <!-- Images will be injected here -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Create Service Modal -->
    <div class="modal fade" id="createServiceModal" tabindex="-1" aria-labelledby="createServiceModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createServiceModalLabel">Create Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Service Form -->
                    <form action="{{ route('accidents.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Existing Fields -->
                        <div class="mb-3">
                            <label for="vehicle_vin" class="form-label">Vehicle VIN</label>
                            @if (isset($accident) && $accident->vehicle)
                                <input type="text" id="vehicle_vin" name="vehicle_vin" class="form-control"
                                    value="{{ $accident->vehicle->vin }}" readonly>
                            @elseif(isset($vehicle))
                                <input type="text" id="vehicle_vin" name="vehicle_vin" class="form-control"
                                    value="{{ $vehicle->vin }}" readonly>
                            @else
                                <input type="text" id="vehicle_vin" name="vehicle_vin" class="form-control"
                                    value="">
                            @endif

                        </div>
                        @if (Auth::user()->role_id == 4)
                            <!-- New State and City Fields -->
                            <div class="mb-3">
                                <label for="state" class="form-label">State</label>
                                <select id="state" name="state" class="form-select" required>
                                    <option value="">Select State</option>
                                    <option value="Sindh">Sindh</option>
                                    <option value="Punjab">Punjab</option>
                                    <option value="Balochistan">Balochistan</option>
                                    <option value="KPK">KPK</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="city" class="form-label">City</label>
                                <select id="city" name="city" class="form-select" required>
                                    <option value="">Select City</option>
                                </select>
                            </div>
                            <!-- ENDDDD New State and City Fields -->
                        @endif
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea id="description" name="description" class="form-control" rows="4"
                                placeholder="Describe the accident" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="accident_date" class="form-label">Accident Date</label>
                            <input type="datetime-local" id="accident_date" name="accident_date" class="form-control"
                                required>
                        </div>

                        <!-- Image Upload Fields -->
                        <div class="mb-3">
                            <label for="accident_images" class="form-label">Accident Images</label>
                            <input type="file" id="accident_images" name="accident_images[]" class="form-control"
                                multiple>
                            <small class="form-text text-muted">You can upload multiple images. (Max: 4 images, 4MB
                                each)</small>
                        </div>

                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    @if (isset($accident))
        <!-- Update Accident Modal -->
        <div class="modal fade" id="updateAccidentModal" tabindex="-1" aria-labelledby="updateAccidentModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateAccidentModalLabel">Update Accident</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Accident Form -->
                        <form id="updateAccidentForm" action="{{ route('accidents.update', ['id' => $accident->id]) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" id="updateAccidentId" name="accident_id" value="{{ $accident->id }}">

                            <!-- Vehicle Field -->
                            <div class="mb-3">
                                <label for="update_vehicle_id" class="form-label">Vehicle VIN</label>
                                <input type="text" id="update_vehicle_id" name="vehicle_id" class="form-control"
                                    readonly>
                            </div>

                            <!-- Description Field -->
                            <div class="mb-3">
                                <label for="update_description" class="form-label">Description</label>
                                <textarea id="update_description" name="description" class="form-control" rows="4"></textarea>
                            </div>

                            <!-- Accident Date Field -->
                            <div class="mb-3">
                                <label for="update_accident_date" class="form-label">Accident Date</label>
                                <input type="datetime-local" id="update_accident_date" name="accident_date"
                                    class="form-control" required>
                            </div>

                            <!-- Accident Images Field -->
                            <div class="mb-3">
                                <label for="update_accident_images" class="form-label">Accident Images</label>
                                <input type="file" id="update_accident_images" name="accident_images[]"
                                    class="form-control" multiple>
                                <small class="form-text text-muted">You can upload multiple images. (Max: 4 images, 4MB
                                    each) Dnt add if u dnt want to update pics</small>
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif




@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Accidents by Vehicle Chart
            var ctxVehicle = document.getElementById('accidentsByVehicleChart').getContext('2d');
            new Chart(ctxVehicle, {
                type: 'bar',
                data: {
                    labels: ['Vehicle A', 'Vehicle B', 'Vehicle C', 'Vehicle D',
                        'Vehicle E'
                    ], // Replace with actual vehicle names
                    datasets: [{
                        label: 'Number of Accidents',
                        data: [5, 2, 8, 3, 1], // Replace with actual data
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Accidents by Date Chart
            var ctxDate = document.getElementById('accidentsByDateChart').getContext('2d');
            new Chart(ctxDate, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'], // Replace with actual months or dates
                    datasets: [{
                        label: 'Accidents',
                        data: [2, 5, 1, 6, 3], // Replace with actual data
                        backgroundColor: 'rgba(153, 102, 255, 0.2)',
                        borderColor: 'rgba(153, 102, 255, 1)',
                        borderWidth: 1,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            const stateCityMapping = {
                'Sindh': ['Karachi', 'Hyderabad', 'Sukkur', 'Larkana'],
                'Punjab': ['Lahore', 'Faisalabad', 'Rawalpindi', 'Multan'],
                'Balochistan': ['Quetta', 'Gwadar', 'Turbat', 'Khuzdar'],
                'KPK': ['Peshawar', 'Abbottabad', 'Mardan', 'Swat']
            };

            document.getElementById('state').addEventListener('change', function() {
                const state = this.value;
                const citySelect = document.getElementById('city');

                // Clear the current city options
                citySelect.innerHTML = '<option value="">Select City</option>';

                if (state && stateCityMapping[state]) {
                    // Populate city dropdown with cities from the selected state
                    stateCityMapping[state].forEach(function(city) {
                        const option = document.createElement('option');
                        option.value = city;
                        option.text = city;
                        citySelect.appendChild(option);
                    });
                }
            });
        });
        $(document).ready(function() {
            $('#serviceTable').DataTable({
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

        function loadGalleryImages(accidentId) {
            fetch(`/accidents/${accidentId}/images`) // Define this route in your Laravel routes file
                .then(response => response.json())
                .then(data => {
                    const galleryContainer = document.getElementById('galleryImages');
                    galleryContainer.innerHTML = ''; // Clear previous images

                    data.images.forEach(image => {
                        const imgElement = document.createElement('img');
                        imgElement.src = `/storage/${image.image_path}`;
                        imgElement.className = 'img-fluid mb-2'; // Add styling for larger images
                        imgElement.style.maxWidth = '100%';
                        imgElement.style.height = 'auto';
                        galleryContainer.appendChild(imgElement);
                    });
                })
                .catch(error => console.error('Error loading images:', error));
        }
        // Function to show the update service modal with pre-filled data
        function showUpdateAccidentModal(id) {
            $.ajax({
                url: `/accidents/${id}/edit`,
                type: 'GET',
                success: function(response) {
                    document.getElementById('updateAccidentId').value = response.accident.id;
                    document.getElementById('update_vehicle_id').value = response.accident.vehicle.vin;
                    document.getElementById('update_description').value = response.accident.description;
                    document.getElementById('update_accident_date').value = response.accident.accident_date;

                    // Clear previous images
                    document.getElementById('update_accident_images').value = '';

                    // Handle existing images (if needed)
                    if (response.accident.images.length > 0) {
                        // Process and display existing images if necessary
                    }

                    var updateModal = new bootstrap.Modal(document.getElementById('updateAccidentModal'));
                    updateModal.show();
                }
            });
        }
        // Function to handle service deletion with SweetAlert2
        function deleteService(id) {
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
                        url: `/accident/${id}`,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                'The service has been deleted.',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        },
                        error: function(xhr) {
                            Swal.fire(
                                'Error!',
                                'There was an issue deleting the service.',
                                'error'
                            );
                        }
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire(
                        'Cancelled',
                        'The service is safe :)',
                        'error'
                    );
                }
            });
        }
    </script>
@endpush

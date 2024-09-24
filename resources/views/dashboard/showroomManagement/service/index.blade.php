@extends('layouts.dashboardlayout')
@section('title', 'Services')
@section('breadcrumb1', 'Service Management')
@section('breadcrumb', 'Services')
@section('pageTitle', 'Services')
@section('content')

    <div class="container">
        <!-- Create Service Button -->
        <form method="POST" action="{{ route('services.search') }}">
            @csrf
            <div class="row gy-2 gx-2 align-items-center">
                <div class="col-auto">
                    <label class="form-label">Input VIN</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="vin" placeholder="e.g HEX234GON45"
                            aria-label="VIN" required>
                        <button type="submit" class="btn btn-primary ms-2">Search</button>
                    </div>
                </div>
            </div>
        </form>


        <div class="d-flex justify-content-end align-items-center">
            <form id="resetForm" action="{{ route('services.index') }}" method="GET">
                <button type="submit" class="btn btn-primary mb-3">
                    <i class="mdi mdi-autorenew"></i>
                    Reset
                </button>
            </form>

            @if (isset($create))
                <a href="{{ route('services.create', ['vehicle_id' => $vehicle->id]) }}" class="btn btn-primary mb-3 ms-3">
                    Create Service
                </a>
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
                        <th>Vehicle VIN</th>
                        <th>Showroom</th>
                        <th>Service Date</th>
                        <th>Kilometers</th>
                        <th>Service Type</th>
                        <th>Status</th>
                        <th>Service Items</th> <!-- Added Service Items Column -->
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($services as $index => $service)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $service->vehicle ? $service->vehicle->vin : '-' }}</td>
                            <td>{{ $service->showroom ? $service->showroom->shr_name : '-' }}</td>
                            <td>{{ $service->service_date ?? '-' }}</td>
                            <td>{{ $service->kilometers_driven . ' Km' ?? '0 Km' }}</td>
                            <td>{{ $service->service_type ?? '-' }}</td>
                            <td>
                                @if ($service->status === 'Pending')
                                    <span class="badge badge-outline-warning">{{ $service->status }}</span>
                                @elseif ($service->status === 'Upcoming')
                                    <span class="badge badge-outline-info">{{ $service->status }}</span>
                                @elseif ($service->status === 'Completed')
                                    <span class="badge badge-outline-success">{{ $service->status }}</span>
                                @else
                                    <span class="badge badge-secondary">{{ $service->status ?? '-' }}</span>
                                @endif
                            </td>

                            <td>
                                <!-- Display service items -->
                                @foreach ($service->serviceItems as $item)
                                    <span class="badge bg-secondary">{{ $item->item }}</span>
                                @endforeach
                            </td>
                            <td class="table-action">
                                @if (isset($services))
                                    {{-- @if (Auth::user()->showroom_id == $service->showroom_id)
                                        <a href="#" class="action-icon"
                                            onclick="showUpdateServiceModal({{ $service->id }})">
                                            <i class="mdi mdi-pencil"></i>
                                        </a>
                                    @endif --}}
                                @endif
                                @if (Auth::user()->role_id == 5)
                                    <a href="#" class="action-icon" onclick="deleteService({{ $service->id }})">
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
            <!-- Service Types Chart -->
            <div class="row mt-4">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body" style="height: 100%; position: relative;">
                            <h5 class="card-title">Service Types Distribution</h5>
                            <canvas id="serviceTypesChart" style="max-height: 100%;"></canvas>
                        </div>
                    </div>
                </div>


                <!-- Service Statuses Chart -->

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body" style="height: 100%; position: relative;">
                            <h5 class="card-title">Service Status Distribution</h5>
                            <canvas id="serviceStatusesChart" style="max-height: 100%;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>
    {{-- {{ dd($vehicle, $showrooms) }} --}}

    {{-- <!-- Create Service Modal -->
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
                    <form action="{{ route('services.store') }}" method="POST">
                        @csrf
                        <!-- Existing Fields -->
                        <div class="mb-3">
                            <label for="vehicle_vin" class="form-label">Vehicle VIN</label>
                            @if (isset($service) && $service->vehicle)
                                <input type="text" id="vehicle_vin" name="vehicle_vin" class="form-control"
                                    value="{{ $service->vehicle->vin }}" readonly>
                            @elseif(isset($vehicle))
                                <input type="text" id="vehicle_vin" name="vehicle_vin" class="form-control"
                                    value="{{ $vehicle->vin }}" readonly>
                            @else
                                <input type="text" id="vehicle_vin" name="vehicle_vin" class="form-control"
                                    value="">
                            @endif

                        </div>
                        <div class="mb-3">
                            @if (Auth::user()->role_id == 5)
                                <label for="showroom_id" class="form-label">Showroom</label>
                                <select id="showroom_id" name="showroom_id" class="form-select" required>
                                    @foreach ($showrooms as $showroom)
                                        <option value="{{ $showroom->id }}">{{ $showroom->shr_name }}</option>
                                    @endforeach
                                </select>
                            @else
                                <label for="showroom_name" class="form-label">Showroom</label>
                                @if (isset($service) && $service->showroom)
                                    <input type="text" id="showroom_name" name="showroom_name" class="form-control"
                                        value="{{ $service->showroom ? $service->showroom->shr_name : '' }}" readonly>
                                @elseif(isset($vehicle))
                                    <input type="text" id="showroom_name" name="showroom_name" class="form-control"
                                        value="{{ $vehicle->showroom ? $vehicle->showroom->shr_name : '' }}" readonly>
                                @else
                                    <input type="text" id="showroom_name" name="showroom_name" class="form-control"
                                        value="">
                                @endif
                            @endif
                            @if ($errors->has('vehicle_vin'))
                                <div class="text-danger">{{ $errors->first('vehicle_vin') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="service_date" class="form-label">Service Date</label>
                            <input type="date" id="service_date" name="service_date" class="form-control" required>
                            @if ($errors->has('service_date'))
                                <div class="text-danger">{{ $errors->first('service_date') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="kilometers_driven" class="form-label">Kilometers Driven</label>
                            <input type="number" id="kilometers_driven" name="kilometers_driven" class="form-control"
                                placeholder="Kilometers Driven" required>
                            @if ($errors->has('kilometers_driven'))
                                <div class="text-danger">{{ $errors->first('kilometers_driven') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="service_type" class="form-label">Service Type</label>
                            <select id="service_type" name="service_type" class="form-select" required>
                                <option value="Routine maintenance">Routine maintenance</option>
                                <option value="Repair">Repair</option>
                                <option value="Specific request">Specific request</option>
                            </select>
                            @if ($errors->has('service_type'))
                                <div class="text-danger">{{ $errors->first('service_type') }}</div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select id="statuss" name="status" class="form-select" required>
                                <option value="Pending">Pending</option>
                                <option value="Completed">Completed</option>
                                <option value="Upcoming">Upcoming</option>
                            </select>
                            @if ($errors->has('status'))
                                <div class="text-danger">{{ $errors->first('status') }}</div>
                            @endif
                        </div>

                        <!-- New Fields -->
                        <div class="mb-3">
                            <label for="additional_requests" class="form-label">Additional Requests</label>
                            <textarea id="additional_requests" name="additional_requests" class="form-control" rows="4"
                                placeholder="Any specific issues reported by the owner" draggable="false"></textarea>
                            @if ($errors->has('additional_requests'))
                                <div class="text-danger">{{ $errors->first('additional_requests') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="estimated_completion_time" class="form-label">Estimated Completion Time</label>
                            <input type="time" id="estimated_completion_time" name="estimated_completion_time"
                                class="form-control">
                            @if ($errors->has('estimated_completion_time'))
                                <div class="text-danger">{{ $errors->first('estimated_completion_time') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="cost_estimate" class="form-label">Cost Estimate</label>
                            <input type="number" min="0" step="0.01" id="cost_estimate" name="cost_estimate"
                                class="form-control" placeholder="Estimated cost">
                            @if ($errors->has('cost_estimate'))
                                <div class="text-danger">{{ $errors->first('cost_estimate') }}</div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="service_items" class="form-label">Service Items</label>
                            <div class="form-check form-checkbox-dark">
                                <input type="checkbox" name="items_serviced[]" value="Oil Change"
                                    class="form-check-input">
                                <label for="update_oil_change1" class="form-check-label">Oil Change</label>
                            </div>

                            <div class="form-check form-checkbox-dark">
                                <input type="checkbox" name="items_serviced[]" value="Filter Replacement"
                                    class="form-check-input">
                                <label for="update_filter_replacement1" class="form-check-label">Filter
                                    Replacement</label>
                            </div>

                            <div class="form-check form-checkbox-dark">
                                <input type="checkbox" name="items_serviced[]" value="Engine Tuning"
                                    class="form-check-input">
                                <label for="update_engine_tuning1" class="form-check-label">Engine Tuning</label>
                            </div>

                            <div class="form-check form-checkbox-dark">
                                <input type="checkbox" name="items_serviced[]" value="Brake Inspection"
                                    class="form-check-input">
                                <label for="update_brake_inspection1" class="form-check-label">Brake Inspection</label>
                            </div>

                            <div class="form-check form-checkbox-dark">
                                <input type="checkbox" name="items_serviced[]" value="Tire Rotation"
                                    class="form-check-input">
                                <label for="update_tire_rotation1" class="form-check-label">Tire Rotation</label>
                            </div>

                            <div class="form-check form-checkbox-dark">
                                <input type="checkbox" name="items_serviced[]" value="Battery Check"
                                    class="form-check-input">
                                <label for="update_battery_check1" class="form-check-label">Battery Check</label>
                            </div>
                            <div class="form-check form-checkbox-dark">
                                <input type="checkbox" id="other_check" value="Other" class="form-check-input"
                                    onchange="toggleOtherTextBox()">
                                <label for="other_check" class="form-check-label">Other</label>
                            </div>

                            <div id="other_text_box" class="d-none">
                                <input type="text" id="other_item" name="items_serviced[]" class="form-control"
                                    placeholder="Specify other item">
                            </div>
                            @if ($errors->has('items_serviced'))
                                <div class="text-danger">{{ $errors->first('items_serviced') }}</div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="remarks" class="form-label">Remarks</label>
                            <textarea id="remarks" name="remarks" class="form-control" rows="4" placeholder="Additional remarks"
                                draggable="false"></textarea>
                            @if ($errors->has('remarks'))
                                <div class="text-danger">{{ $errors->first('remarks') }}</div>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}


    <!-- Update Service Modal -->
    <div class="modal fade" id="updateServiceModal" tabindex="-1" aria-labelledby="updateServiceModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateServiceModalLabel">Update Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Service Form -->
                    @if (isset($service))
                        <form id="updateServiceForm" action="{{ route('services.update', ['id' => $service->id]) }}"
                            method="POST">
                        @else
                            <form id="updateServiceForm" method="POST">
                    @endif
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="updateServiceId" name="serviceId" value="">

                    <!-- Vehicle VIN Field -->
                    <div class="mb-3">
                        <label for="update_vehicle_id" class="form-label">Vehicle VIN</label>
                        @if (isset($service) && $service->vehicle)
                            <input type="text" id="update_vehicle_id" name="vehicle_id" class="form-control"
                                value="{{ $service->vehicle->vin }}" readonly>
                        @else
                            <input type="text" id="update_vehicle_id" name="vehicle_id" class="form-control"
                                value="">
                        @endif
                    </div>

                    <!-- Showroom Field -->
                    <div class="mb-3">
                        @if (Auth::user()->role_id == 5)
                            <label for="update_showroom_id" class="form-label">Showroom</label>
                            <select id="update_showroom_id" name="showroom_id" class="form-select" required>
                                @foreach ($showrooms as $showroom)
                                    <option value="{{ $showroom->id }}">{{ $showroom->shr_name }}</option>
                                @endforeach
                            </select>
                        @else
                            <label for="update_showroom_name" class="form-label">Showroom</label>
                            @if (isset($service) && $service->showroom)
                                <input type="text" id="update_showroom_name" name="showroom_name"
                                    class="form-control" value="{{ $service->showroom->shr_name }}" readonly>
                            @else
                                <input type="text" id="update_showroom_name" name="showroom_name"
                                    class="form-control" value="">
                            @endif
                        @endif
                    </div>

                    <!-- Service Date Field -->
                    <div class="mb-3">
                        <label for="update_service_date" class="form-label">Service Date</label>
                        <input type="date" id="update_service_date" name="service_date" class="form-control"
                            required>
                    </div>

                    <!-- Kilometers Driven Field -->
                    <div class="mb-3">
                        <label for="update_kilometers_driven" class="form-label">Kilometers</label>
                        <input type="number" id="update_kilometers_driven" name="kilometers_driven"
                            class="form-control" required>
                    </div>

                    <!-- Service Type Field -->
                    <div class="mb-3">
                        <label for="update_service_type" class="form-label">Service Type</label>
                        <select id="update_service_type" name="service_type" class="form-select" required>
                            <option value="Routine maintenance">Routine maintenance</option>
                            <option value="Repair">Repair</option>
                            <option value="Specific request">Specific request</option>
                        </select>
                    </div>

                    <!-- Status Field -->
                    <div class="mb-3">
                        <label for="update_status" class="form-label">Status</label>
                        <select id="update_status" name="status" class="form-select" required>
                            <option value="Pending">Pending</option>
                            <option value="Completed">Completed</option>
                            <option value="Upcoming">Upcoming</option>
                        </select>
                    </div>

                    <!-- Additional Requests Field -->
                    <div class="mb-3">
                        <label for="update_additional_requests" class="form-label">Additional Requests</label>
                        <textarea id="update_additional_requests" name="additional_requests" class="form-control" rows="4"
                            placeholder="Any specific issues reported by the owner" draggable="false" style="resize: none"></textarea>
                    </div>

                    <!-- Estimated Completion Time Field -->
                    <div class="mb-3">
                        <label for="update_estimated_completion_time" class="form-label">Estimated Completion
                            Time</label>
                        <input type="time" id="update_estimated_completion_time" name="estimated_completion_time"
                            class="form-control">
                    </div>

                    <!-- Cost Estimate Field -->
                    <div class="mb-3">
                        <label for="update_cost_estimate" class="form-label">Cost Estimate</label>
                        <input type="number" step="0.01" id="update_cost_estimate" name="cost_estimate"
                            class="form-control" placeholder="Estimated cost">
                    </div>

                    <!-- Service Items Field -->
                    <div class="mb-3">
                        <label for="update_service_items" class="form-label">Service Items</label>
                        <div class="form-check form-checkbox-dark">
                            <input type="checkbox" name="items_serviced1[]" value="Oil Change" class="form-check-input">
                            <label for="update_oil_change" class="form-check-label">Oil Change</label>
                        </div>

                        <div class="form-check form-checkbox-dark">
                            <input type="checkbox" name="items_serviced1[]" value="Filter Replacement"
                                class="form-check-input">
                            <label for="update_filter_replacement" class="form-check-label">Filter Replacement</label>
                        </div>

                        <div class="form-check form-checkbox-dark">
                            <input type="checkbox" name="items_serviced1[]" value="Engine Tuning"
                                class="form-check-input">
                            <label for="update_engine_tuning" class="form-check-label">Engine Tuning</label>
                        </div>

                        <div class="form-check form-checkbox-dark">
                            <input type="checkbox" name="items_serviced1[]" value="Brake Inspection"
                                class="form-check-input">
                            <label for="update_brake_inspection" class="form-check-label">Brake Inspection</label>
                        </div>

                        <div class="form-check form-checkbox-dark">
                            <input type="checkbox" name="items_serviced1[]" value="Tire Rotation"
                                class="form-check-input">
                            <label for="update_tire_rotation" class="form-check-label">Tire Rotation</label>
                        </div>

                        <div class="form-check form-checkbox-dark">
                            <input type="checkbox" name="items_serviced1[]" value="Battery Check"
                                class="form-check-input">
                            <label for="update_battery_check" class="form-check-label">Battery Check</label>
                        </div>

                        <div class="form-check form-checkbox-dark">
                            <input type="checkbox" id="update_other_check" name="items_serviced1[]" value="Other"
                                class="form-check-input" onchange="toggleOtherTextBox1()">
                            <label for="update_other_check" class="form-check-label">Other</label>
                        </div>

                        <div id="update_other_text_box" class="d-none">
                            <input type="text" id="update_other_item" name="items_serviced1[]" class="form-control"
                                placeholder="Specify other item">
                        </div>
                    </div>

                    <!-- Remarks Field -->
                    <div class="mb-3">
                        <label for="update_remarks" class="form-label">Remarks</label>
                        <textarea id="update_remarks" name="remarks" class="form-control" rows="4" placeholder="Additional remarks"
                            draggable="false" style="resize: none"></textarea>
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
            // Static data for Service Types Chart
            const serviceTypeCounts = {
                'Regular': 5,
                'Maintenance': 3,
                'Repair': 7
            };

            const typeLabels = Object.keys(serviceTypeCounts);
            const typeData = Object.values(serviceTypeCounts);

            const ctxTypes = document.getElementById('serviceTypesChart').getContext('2d');
            new Chart(ctxTypes, {
                type: 'pie',
                data: {
                    labels: typeLabels,
                    datasets: [{
                        label: 'Service Types Distribution',
                        data: typeData,
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true
                }
            });

            // Static data for Service Statuses Chart
            const serviceStatusCounts = {
                'Completed': 8,
                'Pending': 4,
                'In Progress': 3
            };

            const statusLabels = Object.keys(serviceStatusCounts);
            const statusData = Object.values(serviceStatusCounts);

            const ctxStatuses = document.getElementById('serviceStatusesChart').getContext('2d');
            new Chart(ctxStatuses, {
                type: 'bar',
                data: {
                    labels: statusLabels,
                    datasets: [{
                        label: 'Service Status Distribution',
                        data: statusData,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });

        function toggleOtherTextBox() {
            var otherCheck = document.getElementById('other_check');
            var otherTextBox = document.getElementById('other_text_box');
            if (otherCheck.checked) {
                otherTextBox.classList.remove('d-none');
            } else {
                otherTextBox.classList.add('d-none');
            }
        }
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
        // Function to show the update service modal with pre-filled data
        function showUpdateServiceModal(id) {
            $.ajax({
                url: `/services/${id}/edit`,
                type: 'GET',
                success: function(response) {
                    document.getElementById('updateServiceId').value = response.service.id;
                    document.getElementById('update_vehicle_id').value = response.service.vehicle.vin;
                    //issue
                    // document.getElementById('update_showroom_id').value = response.service.showroom.shr_name;
                    document.getElementById('update_service_date').value = response.service.service_date;
                    document.getElementById('update_kilometers_driven').value = response.service
                        .kilometers_driven;
                    document.getElementById('update_service_type').value = response.service.service_type;
                    document.getElementById('update_status').value = response.service.status;
                    document.getElementById('update_additional_requests').value = response.service
                        .additional_requests;
                    document.getElementById('update_estimated_completion_time').value = response.service
                        .estimated_completion_time;
                    document.getElementById('update_cost_estimate').value = response.service.cost_estimate;
                    document.getElementById('update_remarks').value = response.service.remarks;

                    // Handle checkboxes for service items
                    const serviceItems = response.service.service_items.map(item => item.item);
                    console.log(serviceItems);

                    // Check specific checkboxes based on service items
                    document.querySelector("input[name='items_serviced1[]'][value='Oil Change']").checked =
                        serviceItems.includes('Oil Change');
                    document.querySelector("input[name='items_serviced1[]'][value='Filter Replacement']")
                        .checked =
                        serviceItems.includes('Filter Replacement');
                    document.querySelector("input[name='items_serviced1[]'][value='Engine Tuning']")
                        .checked =
                        serviceItems.includes('Engine Tuning');
                    document.querySelector("input[name='items_serviced1[]'][value='Brake Inspection']")
                        .checked =
                        serviceItems.includes('Brake Inspection');
                    document.querySelector("input[name='items_serviced1[]'][value='Tire Rotation']")
                        .checked =
                        serviceItems.includes('Tire Rotation');
                    document.querySelector("input[name='items_serviced1[]'][value='Battery Check']")
                        .checked =
                        serviceItems.includes('Battery Check');



                    // Handle 'Other' checkbox and textbox
                    const otherCheckbox = document.getElementById('update_other_check');
                    const otherTextBox = document.getElementById('update_other_text_box');
                    const otherItem = serviceItems.find(item => !['Oil Change', 'Filter Replacement',
                        'Engine Tuning', 'Brake Inspection', 'Tire Rotation', 'Battery Check'
                    ].includes(item));

                    if (otherItem) {
                        otherCheckbox.checked = true;
                        otherTextBox.classList.remove('d-none');
                        document.getElementById('update_other_item').value = otherItem;
                    } else {
                        otherCheckbox.checked = false;
                        otherTextBox.classList.add('d-none');
                        document.getElementById('update_other_item').value = '';
                    }

                    var updateModal = new bootstrap.Modal(document.getElementById('updateServiceModal'));
                    updateModal.show();
                }
            });
        }

        function toggleOtherTextBox1() {
            const otherCheckbox = document.getElementById('update_other_check');
            const otherTextBox = document.getElementById('update_other_text_box');
            if (otherCheckbox.checked) {
                otherTextBox.classList.remove('d-none');
            } else {
                otherTextBox.classList.add('d-none');
            }
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
                        url: `/services/${id}`,
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

@extends('layouts.dashboardlayout')
@section('title', 'Schedule Service')
@section('breadcrumb1', 'Service')
@section('breadcrumb', 'Schedule Services')
@section('pageTitle', 'Schedule Services')
@section('content')
    <div class="body-content">

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bs-example-modal-lg">Schedule
            Service</button>

        <!-- Services Table -->
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
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{-- {{ dd($vehicle, $showrooms) }} --}}

    <!-- Create Service Modal -->
    <!-- Large modal -->

    <div class="modal fade" id="bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Schedule Your Service!</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <!-- Error Display Block -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Service Form -->
                    <form action="{{ route('store-schedule-service') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="vehicle_id" class="form-label">Select Vehicle</label>
                            <select id="vehicle_id" name="vehicle_id" class="form-select" required>
                                <option value="">Select a vehicle</option>
                                @foreach ($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}"
                                        {{ old('vehicle_id') == $vehicle->id ? 'selected' : '' }}>
                                        {{ $vehicle->vin }}
                                    </option>
                                @endforeach
                            </select>
                            @error('vehicle_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="showroom_id" class="form-label">Showroom</label>
                            <select id="showroom_id" name="showroom_id" class="form-select" required>
                                @foreach ($showrooms as $showroom)
                                    <option value="{{ $showroom->id }}"
                                        {{ old('showroom_id') == $showroom->id ? 'selected' : '' }}>
                                        {{ $showroom->shr_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('showroom_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="service_date" class="form-label">Service Date</label>
                            <input type="date" id="service_date" name="service_date" class="form-control"
                                min="{{ \Carbon\Carbon::tomorrow()->toDateString() }}" required
                                value="{{ old('service_date') }}">
                            @error('service_date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="kilometers_driven" class="form-label">Kilometers </label>
                            <input type="number" id="kilometers_driven" name="kilometers_driven" class="form-control"
                                placeholder="Kilometers " required value="{{ old('kilometers_driven') }}">
                            @error('kilometers_driven')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="service_type" class="form-label">Service Type</label>
                            <select id="service_type" name="service_type" class="form-select" required>
                                <option value="Routine maintenance"
                                    {{ old('service_type') == 'Routine maintenance' ? 'selected' : '' }}>
                                    Routine maintenance
                                </option>
                                <option value="Repair" {{ old('service_type') == 'Repair' ? 'selected' : '' }}>
                                    Repair
                                </option>
                                <option value="Specific request"
                                    {{ old('service_type') == 'Specific request' ? 'selected' : '' }}>
                                    Specific request
                                </option>
                            </select>
                            @error('service_type')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="additional_requests" class="form-label">Additional Requests</label>
                            <textarea id="additional_requests" name="additional_requests" class="form-control" rows="4"
                                placeholder="Any specific issues reported by the owner" draggable="false">{{ old('additional_requests') }}</textarea>
                            @error('additional_requests')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Service Items -->
                        <div class="mb-3">
                            <label for="service_items" class="form-label">Service Items</label>
                            @foreach (['Oil Change', 'Filter Replacement', 'Engine Tuning', 'Brake Inspection', 'Tire Rotation', 'Battery Check'] as $item)
                                <div class="form-check form-checkbox-dark">
                                    <input type="checkbox" name="items_serviced[]" value="{{ $item }}"
                                        class="form-check-input"
                                        {{ in_array($item, old('items_serviced', [])) ? 'checked' : '' }}>
                                    <label for="update_{{ strtolower(str_replace(' ', '_', $item)) }}1"
                                        class="form-check-label">{{ $item }}</label>
                                </div>
                            @endforeach
                            <div class="form-check form-checkbox-dark">
                                <input type="checkbox" id="other_check" value="Other" class="form-check-input"
                                    onchange="toggleOtherTextBox()"
                                    {{ in_array('Other', old('items_serviced', [])) ? 'checked' : '' }}>
                                <label for="other_check" class="form-check-label">Other</label>
                            </div>
                            <div id="other_text_box"
                                class="{{ in_array('Other', old('items_serviced', [])) ? '' : 'd-none' }}">
                                <input type="text" id="other_item" name="items_serviced[]" class="form-control"
                                    placeholder="Specify other item"
                                    value="{{ old('items_serviced')[array_search('Other', old('items_serviced', [])) + 1] ?? '' }}">
                            </div>
                            @error('items_serviced')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.


@endsection
@push('scripts')
    <script>
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
    </script>
@endpush

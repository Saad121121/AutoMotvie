@extends('layouts.dashboardlayout')
@section('title', 'Services')
@section('breadcrumb1', 'Service Management')
@section('breadcrumb', 'Services')
@section('pageTitle', 'Services')
@section('content')
    <div class="container mt-5">
        {{-- {{ dd($vehicle->toArray()) }} --}}
        <h3 class="text-center mb-4">Create Service</h3>
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

        <form action="{{ route('services.store') }}" method="POST" id="serviceForm">
            @csrf

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="vehicle_vin" class="form-label">Vehicle VIN</label>
                    <input type="text" id="vehicle_vin" name="vehicle_vin" class="form-control"
                        value="{{ $vehicle->vin }}" readonly>
                    @error('vehicle_vin')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="showroom_id" class="form-label">Showroom</label>
                    <select id="showroom_id" name="showroom_id" class="form-select" required>
                        @foreach ($showrooms as $showroom)
                            <option value="{{ $showroom->id }}">{{ $showroom->shr_name }}</option>
                        @endforeach
                    </select>
                    @error('showroom_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="service_date" class="form-label">Service Date</label>
                    <input type="date" id="service_date" name="service_date" class="form-control" required>
                    @error('service_date')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="kilometers_driven" class="form-label">Kilometers Driven</label>
                    <input type="number" id="kilometers_driven" name="kilometers_driven" class="form-control"
                        placeholder="Kilometers Driven" required>
                    @error('kilometers_driven')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="service_type" class="form-label">Service Type</label>
                    <select id="service_type" name="service_type" class="form-select" required>
                        <option value="Routine maintenance">Routine maintenance</option>
                        <option value="Repair">Repair</option>
                        <option value="Specific request">Specific request</option>
                    </select>
                    @error('service_type')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="Pending">Pending</option>
                        <option value="Completed">Completed</option>
                        <option value="Upcoming">Upcoming</option>
                    </select>
                    @error('status')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="additional_requests" class="form-label">Additional Requests</label>
                <textarea id="additional_requests" name="additional_requests" class="form-control" rows="4"
                    placeholder="Any specific issues reported by the owner"></textarea>
                @error('additional_requests')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="estimated_completion_time" class="form-label">Estimated Completion Time</label>
                    <input type="time" id="estimated_completion_time" name="estimated_completion_time"
                        class="form-control">
                    @error('estimated_completion_time')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="cost_estimate" class="form-label">Cost Estimate</label>
                    <input type="number" min="0" step="0.01" id="cost_estimate" name="cost_estimate"
                        class="form-control" placeholder="Estimated cost">
                    @error('cost_estimate')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="service_items" class="form-label">Service Items</label>
                <div class="form-check">
                    <input type="checkbox" name="items_serviced[]" value="Oil Change" class="form-check-input">
                    <label class="form-check-label">Oil Change</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" name="items_serviced[]" value="Filter Replacement" class="form-check-input">
                    <label class="form-check-label">Filter Replacement</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" name="items_serviced[]" value="Engine Tuning" class="form-check-input">
                    <label class="form-check-label">Engine Tuning</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" name="items_serviced[]" value="Brake Inspection" class="form-check-input">
                    <label class="form-check-label">Brake Inspection</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" name="items_serviced[]" value="Tire Rotation" class="form-check-input">
                    <label class="form-check-label">Tire Rotation</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" name="items_serviced[]" value="Battery Check" class="form-check-input">
                    <label class="form-check-label">Battery Check</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" id="other_check" value="Other" class="form-check-input"
                        onchange="toggleOtherTextBox()">
                    <label for="other_check" class="form-check-label">Other</label>
                </div>
                <div id="other_text_box" class="d-none mt-2">
                    <input type="text" id="other_item" name="items_serviced[]" class="form-control"
                        placeholder="Specify other item">
                </div>
                @error('items_serviced')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="remarks" class="form-label">Remarks</label>
                <textarea id="remarks" name="remarks" class="form-control" rows="4" placeholder="Additional remarks"></textarea>
                @error('remarks')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>

@endsection

@push('scripts')
    <script>
        function toggleOtherTextBox() {
            var otherCheckBox = document.getElementById('other_check');
            var otherTextBox = document.getElementById('other_text_box');
            if (otherCheckBox.checked) {
                otherTextBox.classList.remove('d-none');
            } else {
                otherTextBox.classList.add('d-none');
                document.getElementById('other_item').value = '';
            }
        }




        // Function to handle service deletion with SweetAlert2
    </script>
@endpush

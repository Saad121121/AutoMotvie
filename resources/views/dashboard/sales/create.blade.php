@extends('layouts.dashboardlayout')
@section('title', 'Vehicle Sales Form')
@section('breadcrumb1', 'Sales Management')
@section('breadcrumb', 'Vehicle Sales')
@section('pageTitle', 'Vehicle Sales Form')
@section('content')

    <div class="container">
        <!-- Success and Error Messages -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>Success - </strong> {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>Error - </strong> {{ session('error') }}
            </div>
        @endif
        <form action="{{ route('sales.store') }}" method="POST">
            @csrf

            <!-- 1. Customer Information Section -->
            <div class="mb-3">
                <label for="invoice_number" class="form-label">Invoice Number</label>
                <input type="text" id="invoice_number" name="invoice_number" class="form-control" readonly>
            </div>
            <h4 class="d-flex justify-content-center">Customer Information</h4>
            <div class="mb-3">
                <label for="customer_id" class="form-label">Customer ID</label>
                <input type="text" id="customer_id" name="customer_id" class="form-control" readonly>
            </div>
            <div class="mb-3">
                <label for="full_name" class="form-label">Full Name</label>
                <input type="text" id="full_name" name="full_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="contact_info" class="form-label">Contact Information</label>
                <textarea id="contact_info" name="contact_info" class="form-control" required></textarea>
            </div>
            <div class="mb-3">
                <label for="driver_license" class="form-label">Driver's License Number</label>
                <input type="text" id="driver_license" name="driver_license" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="customer_type" class="form-label">Customer Type</label>
                <select id="customer_type" name="customer_type" class="form-select">
                    <option value="new">New</option>
                    <option value="returning">Returning</option>
                    <option value="vip">VIP</option>
                </select>
            </div>

            <!-- 2. Vehicle Details Section -->
            <h4 class="d-flex justify-content-center">Vehicle Details</h4>
            <div class="mb-3">
                <label for="make" class="form-label">Make</label>
                <input type="text" id="make" name="make" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="model" class="form-label">Model</label>
                <input type="text" id="model" name="model" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="year" class="form-label">Year</label>
                <input type="number" id="year" name="year" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="vin" class="form-label">VIN</label>
                <input type="text" id="vin" name="vin" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="color" class="form-label">Color</label>
                <input type="text" id="color" name="color" class="form-control">
            </div>
            <div class="mb-3">
                <label for="mileage" class="form-label">Mileage</label>
                <input type="text" id="mileage" name="mileage" class="form-control">
            </div>
            <div class="mb-3">
                <label for="condition" class="form-label">Condition</label>
                <select id="condition" name="condition" class="form-select">
                    <option value="new">New</option>
                    <option value="used">Used</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="additional_features" class="form-label">Additional Features</label>
                <textarea id="additional_features" name="additional_features" class="form-control"></textarea>
            </div>

            <!-- 3. Sales Details Section -->
            <h4 class="d-flex justify-content-center">Sales Details</h4>
            <div class="mb-3">
                <label for="sales_date" class="form-label">Sales Date</label>
                <input type="date" id="sales_date" name="sales_date" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="sales_person_name" class="form-label">Sales Person Name</label>
                <input type="text" id="sales_person_name" name="sales_person_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="payment_method" class="form-label">Payment Method</label>
                <select id="payment_method" name="payment_method" class="form-select">
                    <option value="cash">Cash</option>
                    <option value="financing">Financing</option>
                    <option value="lease">Lease</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="financing_details" class="form-label">Financing Details</label>
                <textarea id="financing_details" name="financing_details" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label for="trade_in_details" class="form-label">Trade-in Details</label>
                <textarea id="trade_in_details" name="trade_in_details" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label for="discounts_offers" class="form-label">Discounts/Offers</label>
                <textarea id="discounts_offers" name="discounts_offers" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label for="total_price" class="form-label">Total Price</label>
                <input type="number" id="total_price" name="total_price" class="form-control" required>
            </div>

            <!-- 4. Warranty and Service Section -->
            <h4 class="d-flex justify-content-center">Warranty and Service</h4>
            <div class="mb-3">
                <label for="warranty_type" class="form-label">Warranty Type</label>
                <select id="warranty_type" name="warranty_type" class="form-select">
                    <option value="standard">Standard</option>
                    <option value="extended">Extended</option>
                    <option value="none">No Warranty</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="warranty_duration" class="form-label">Warranty Duration</label>
                <input type="text" id="warranty_duration" name="warranty_duration" class="form-control">
            </div>
            <div class="mb-3">
                <label for="service_plan" class="form-label">Service Plan</label>
                <textarea id="service_plan" name="service_plan" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label for="scheduled_delivery_date" class="form-label">Scheduled Delivery Date</label>
                <input type="date" id="scheduled_delivery_date" name="scheduled_delivery_date" class="form-control">
            </div>

            <!-- 5. Documentation and Compliance Section -->
            <h4 class="d-flex justify-content-center">Documentation and Compliance</h4>
            <div class="mb-3">
                <label for="documents_required" class="form-label">Documents Required</label>
                <textarea id="documents_required" name="documents_required" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label for="signed_contract" class="form-label">Signed Contract</label>
                <select id="signed_contract" name="signed_contract" class="form-select">
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="regulatory_compliance" class="form-label">Regulatory Compliance</label>
                <textarea id="regulatory_compliance" name="regulatory_compliance" class="form-control"></textarea>
            </div>

            <!-- 6. Delivery Information Section -->
            <h4 class="d-flex justify-content-center">Delivery Information</h4>
            <div class="mb-3">
                <label for="delivery_method" class="form-label">Delivery Method</label>
                <select id="delivery_method" name="delivery_method" class="form-select">
                    <option value="pickup">Pickup</option>
                    <option value="delivery">Delivery</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="delivery_address" class="form-label">Delivery Address</label>
                <textarea id="delivery_address" name="delivery_address" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label for="delivery_status" class="form-label">Delivery Status</label>
                <select id="delivery_status" name="delivery_status" class="form-select">
                    <option value="pending">Pending</option>
                    <option value="shipped">Shipped</option>
                    <option value="delivered">Delivered</option>
                </select>
            </div>

            <!-- 7. Notes and Additional Information Section -->
            <h4 class="d-flex justify-content-center">Notes and Additional Information</h4>
            <div class="mb-3">
                <label for="special_instructions" class="form-label">Special Instructions</label>
                <textarea id="special_instructions" name="special_instructions" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label for="comments" class="form-label">Comments</label>
                <textarea id="comments" name="comments" class="form-control"></textarea>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Fetch the unique part number when the page loads
            fetch("{{ route('generate.invoice.number') }}")
                .then(response => response.json())
                .then(data => {
                    document.getElementById('invoice_number').value = data.invoice_number;
                })
                .catch(error => console.error('Error fetching invoice number:', error));
        });
        document.addEventListener("DOMContentLoaded", function() {
            // Fetch the unique part number when the page loads
            fetch("{{ route('generate.customer.number') }}")
                .then(response => response.json())
                .then(data => {
                    document.getElementById('customer_id').value = data.customer_id;
                })
                .catch(error => console.error('Error fetching customer number:', error));
        });
    </script>
@endpush

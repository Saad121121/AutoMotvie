@extends('layouts.dashboardlayout')

@section('title', 'Sale Details')
@section('breadcrumb1', 'Sales Management')
@section('breadcrumb', 'Sale Details')
@section('pageTitle', 'Sale Details')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Sale Details Card -->
                <div class="card">
                    <div class="card-header">
                        <h4>Sale Details</h4>
                        <a href="{{ route('sales.pdf', $sale->id) }}" class="btn btn-primary">Download PDF</a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Customer Information</h5>
                                <p><strong>Customer ID:</strong> {{ $sale->customer_id }}</p>
                                <p><strong>Full Name:</strong> {{ $sale->full_name }}</p>
                                <p><strong>Contact Information:</strong> {{ $sale->contact_info }}</p>
                                <p><strong>Driver's License Number:</strong> {{ $sale->driver_license }}</p>
                                <p><strong>Customer Type:</strong> {{ $sale->customer_type }}</p>
                            </div>
                            <div class="col-md-6">
                                <h5>Vehicle Details</h5>
                                <p><strong>Make:</strong> {{ $sale->make }}</p>
                                <p><strong>Model:</strong> {{ $sale->model }}</p>
                                <p><strong>Year:</strong> {{ $sale->year }}</p>
                                <p><strong>VIN:</strong> {{ $sale->vin }}</p>
                                <p><strong>Color:</strong> {{ $sale->color }}</p>
                                <p><strong>Mileage:</strong> {{ $sale->mileage }}</p>
                                <p><strong>Condition:</strong> {{ $sale->condition }}</p>
                                <p><strong>Additional Features:</strong> {{ $sale->additional_features }}</p>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <h5>Sales Details</h5>
                                <p><strong>Sales Order ID:</strong> {{ $sale->invoice_number }}</p>
                                <p><strong>Sales Date:</strong> {{ $sale->sales_date }}</p>
                                <p><strong>Salesperson Name:</strong> {{ $sale->sales_person_name }}</p>
                                <p><strong>Payment Method:</strong> {{ $sale->payment_method }}</p>
                                <p><strong>Financing Details:</strong> {{ $sale->financing_details }}</p>
                                <p><strong>Trade-in Details:</strong> {{ $sale->trade_in_details }}</p>
                                <p><strong>Discounts/Offers:</strong> {{ $sale->discounts_offers }}</p>
                                <p><strong>Total Price:</strong> ${{ number_format($sale->total_price, 2) }}</p>
                            </div>
                            <div class="col-md-6">
                                <h5>Warranty and Service</h5>
                                <p><strong>Warranty Type:</strong> {{ $sale->warranty_type }}</p>
                                <p><strong>Warranty Duration:</strong> {{ $sale->warranty_duration }}</p>
                                <p><strong>Service Plan:</strong> {{ $sale->service_plan }}</p>
                                <p><strong>Scheduled Delivery Date:</strong> {{ $sale->scheduled_delivery_date }}</p>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <h5>Documentation and Compliance</h5>
                                <p><strong>Documents Required:</strong> {{ $sale->documents_required }}</p>
                                <p><strong>Signed Contract:</strong> {{ $sale->signed_contract }}</p>
                                <p><strong>Regulatory Compliance:</strong> {{ $sale->regulatory_compliance }}</p>
                            </div>
                            <div class="col-md-6">
                                <h5>Delivery Information</h5>
                                <p><strong>Delivery Method:</strong> {{ $sale->delivery_method }}</p>
                                <p><strong>Delivery Address:</strong> {{ $sale->delivery_address }}</p>
                                <p><strong>Delivery Status:</strong> {{ $sale->delivery_status }}</p>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <h5>Notes and Additional Information</h5>
                                <p><strong>Special Instructions:</strong> {{ $sale->special_instructions }}</p>
                                <p><strong>Comments:</strong> {{ $sale->comments }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Sale Details Card -->
            </div>
        </div>
    </div>
@endsection

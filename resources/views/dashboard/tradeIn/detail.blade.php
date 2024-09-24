@extends('layouts.dashboardlayout')
@section('title', 'Trade-In Request Details')
@section('breadcrumb1', 'Trade-In Management')
@section('breadcrumb', 'Trade-In Request Details')
@section('pageTitle', 'Trade-In Request Details')
@section('styles')
    <style>
        #carPhotosCarousel .carousel-item img {
            max-height: 500px;
            /* Adjust as needed */
            object-fit: cover;
            /* Ensure the image covers the container */
        }
    </style>
@endsection


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- Trade-In Request Details -->

                <ul class="list-group">
                    <li class="list-group-item"><strong>Full Name:</strong> {{ $tradeInRequest->full_name }}</li>
                    <li class="list-group-item"><strong>Email Address:</strong> {{ $tradeInRequest->email_address }}</li>
                    <li class="list-group-item"><strong>Phone Number:</strong> {{ $tradeInRequest->phone_number }}</li>
                    <li class="list-group-item"><strong>Street Address:</strong> {{ $tradeInRequest->street_address }}</li>
                    <li class="list-group-item"><strong>City:</strong> {{ $tradeInRequest->city }}</li>
                    <li class="list-group-item"><strong>State:</strong> {{ $tradeInRequest->state }}</li>
                    <li class="list-group-item"><strong>Zip Code:</strong> {{ $tradeInRequest->zip_code }}</li>
                    <li class="list-group-item"><strong>Make:</strong> {{ $tradeInRequest->make }}</li>
                    <li class="list-group-item"><strong>Model:</strong> {{ $tradeInRequest->model }}</li>
                    <li class="list-group-item"><strong>Year:</strong> {{ $tradeInRequest->year }}</li>
                    <li class="list-group-item"><strong>Mileage:</strong> {{ $tradeInRequest->mileage }}</li>
                    <li class="list-group-item"><strong>VIN:</strong> {{ $tradeInRequest->vin }}</li>
                    <li class="list-group-item"><strong>Condition:</strong> {{ $tradeInRequest->condition }}</li>
                    <li class="list-group-item"><strong>Color:</strong> {{ $tradeInRequest->color }}</li>
                    <li class="list-group-item"><strong>Current Market Value:</strong>
                        ${{ number_format($tradeInRequest->current_market_value, 2) }}</li>
                    <li class="list-group-item"><strong>Additional Comments:</strong>
                        {{ $tradeInRequest->additional_comments }}</li>
                    <li class="list-group-item"><strong>Preferred Contact Method:</strong>
                        {{ $tradeInRequest->preferred_contact_method }}</li>
                    <li class="list-group-item"><strong>Trade-In Timing:</strong> {{ $tradeInRequest->trade_in_timing }}
                    </li>
                    <li class="list-group-item"><strong>Preferred Dealership Location:</strong>
                        {{ $tradeInRequest->preferred_dealership_location }}</li>
                </ul>

                <!-- Image Slider -->
                @if ($tradeInRequest->car_photos)
                    @php
                        $photos = json_decode($tradeInRequest->car_photos);
                    @endphp
                    <div id="carPhotosCarousel" class="carousel slide mt-4" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($photos as $index => $photo)
                                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                    <img src="{{ asset('storage/' . $photo) }}" class="d-block w-100" alt="Car Photo">
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carPhotosCarousel"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carPhotosCarousel"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>

                @endif
            </div>
        </div>
    </div>
@endsection

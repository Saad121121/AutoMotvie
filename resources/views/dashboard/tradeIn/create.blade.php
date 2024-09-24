@extends('layouts.dashboardlayout')
@section('title', 'Create Trade-In Request')
@section('breadcrumb1', 'Trade-In Management')
@section('breadcrumb', 'Create Trade-In Request')
@section('pageTitle', 'Create Trade-In Request')

@section('content')
    <div class="container">
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
        <form method="POST" action="{{ route('tradein.store') }}" enctype="multipart/form-data">
            @csrf
            <!-- Personal Information -->
            <h4>Personal Information</h4>

            <div class="mb-3">
                <label for="full_name" class="form-label">Full Name</label>
                <input type="text" id="full_name" name="full_name" class="form-control" placeholder="John Doe"
                    value="{{ old('full_name') }}" required>
                @error('full_name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email_address" class="form-label">Email Address</label>
                <input type="email" id="email_address" name="email_address" class="form-control"
                    placeholder="john.doe@example.com" value="{{ old('email_address') }}" required>
                @error('email_address')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="phone_number" class="form-label">Phone Number</label>
                <input type="text" id="phone_number" name="phone_number" class="form-control"
                    placeholder="(123) 456-7890" value="{{ old('phone_number') }}" required>
                @error('phone_number')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="street_address" class="form-label">Street Address</label>
                <input type="text" id="street_address" name="street_address" class="form-control"
                    placeholder="Street Address" value="{{ old('street_address') }}" required>
                @error('street_address')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <input type="text" id="city" name="city" class="form-control mt-2" placeholder="City"
                    value="{{ old('city') }}" required>
                @error('city')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <input type="text" id="state" name="state" class="form-control mt-2" placeholder="State"
                    value="{{ old('state') }}" required>
                @error('state')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <input type="text" id="zip_code" name="zip_code" class="form-control mt-2" placeholder="Zip Code"
                    value="{{ old('zip_code') }}" required>
                @error('zip_code')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Car Details -->
            <h4>Car Details</h4>

            <div class="mb-3">
                <label for="make" class="form-label">Make</label>
                <select id="make" name="make" class="form-select" required>
                    <option value="">Select Make...</option>
                    <option value="Toyota" {{ old('make') == 'Toyota' ? 'selected' : '' }}>Toyota</option>
                    <option value="Honda" {{ old('make') == 'Honda' ? 'selected' : '' }}>Honda</option>
                    <option value="Ford" {{ old('make') == 'Ford' ? 'selected' : '' }}>Ford</option>
                    <!-- Add more makes as needed -->
                </select>
                @error('make')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="model" class="form-label">Model</label>
                <input type="text" id="model" name="model" class="form-control" placeholder="Model"
                    value="{{ old('model') }}" required>
                @error('model')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="year" class="form-label">Year</label>
                <select id="year" name="year" class="form-select" required>
                    <option value="">Select Year...</option>
                    @for ($i = 2000; $i <= 2024; $i++)
                        <option value="{{ $i }}" {{ old('year') == $i ? 'selected' : '' }}>
                            {{ $i }}
                        </option>
                    @endfor
                </select>
                @error('year')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="mileage" class="form-label">Mileage</label>
                <input type="number" id="mileage" name="mileage" class="form-control" placeholder="123456"
                    value="{{ old('mileage') }}" required>
                @error('mileage')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="vin" class="form-label">Vehicle Identification Number (VIN)</label>
                <input type="text" id="vin" name="vin" class="form-control"
                    placeholder="1HGBH41JXMN109186" value="{{ old('vin') }}" required>
                @error('vin')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="condition" class="form-label">Condition</label>
                <select id="condition" name="condition" class="form-select" required>
                    <option value="">Select Condition...</option>
                    <option value="Excellent" {{ old('condition') == 'Excellent' ? 'selected' : '' }}>Excellent</option>
                    <option value="Good" {{ old('condition') == 'Good' ? 'selected' : '' }}>Good</option>
                    <option value="Fair" {{ old('condition') == 'Fair' ? 'selected' : '' }}>Fair</option>
                    <option value="Poor" {{ old('condition') == 'Poor' ? 'selected' : '' }}>Poor</option>
                </select>
                @error('condition')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="color" class="form-label">Color</label>
                <input type="color" id="color" name="color" class="form-control" placeholder="Blue"
                    value="{{ old('color') }}" required>
                @error('color')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Additional Details -->
            <h4>Additional Details</h4>

            <div class="mb-3">
                <label for="current_market_value" class="form-label">Current Market Value (if known)</label>
                <input type="number" id="current_market_value" name="current_market_value" class="form-control"
                    placeholder="15000" step="0.01" value="{{ old('current_market_value') }}">
                @error('current_market_value')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="car_photos" class="form-label">Upload Car Photos</label>
                <input type="file" id="car_photos" name="car_photos[]" class="form-control" multiple>
                <small class="form-text text-muted">Upload photos of your car. (Max 5 files, each up to 5MB)</small>
                @error('car_photos.*')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="additional_comments" class="form-label">Additional Comments or Notes</label>
                <textarea id="additional_comments" name="additional_comments" class="form-control"
                    placeholder="Any additional information about the car">{{ old('additional_comments') }}</textarea>
                @error('additional_comments')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Trade-In Preferences -->
            <h4>Trade-In Preferences</h4>

            <div class="mb-3">
                <label for="preferred_contact_method" class="form-label">Preferred Contact Method</label>
                <select id="preferred_contact_method" name="preferred_contact_method" class="form-select" required>
                    <option value="">Select Contact Method...</option>
                    <option value="Email" {{ old('preferred_contact_method') == 'Email' ? 'selected' : '' }}>Email
                    </option>
                    <option value="Phone" {{ old('preferred_contact_method') == 'Phone' ? 'selected' : '' }}>Phone
                    </option>
                    <option value="Text" {{ old('preferred_contact_method') == 'Text' ? 'selected' : '' }}>Text</option>
                </select>
                @error('preferred_contact_method')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="trade_in_timing" class="form-label">Trade-In Timing</label>
                <input type="date" id="trade_in_timing" name="trade_in_timing" class="form-control"
                    value="{{ old('trade_in_timing') }}" required>
                @error('trade_in_timing')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="preferred_dealership_location" class="form-label">Preferred Dealership Location</label>
                <select id="preferred_dealership_location" name="preferred_dealership_location" class="form-select"
                    required>
                    <option value="">Select Dealership Location...</option>
                    @foreach ($showrooms as $showroom)
                        <option value="{{ $showroom->shr_name }}"
                            {{ old('preferred_dealership_location') == $showroom->shr_name ? 'selected' : '' }}>
                            {{ $showroom->shr_name }}
                        </option>
                    @endforeach
                </select>
                @error('preferred_dealership_location')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit -->
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Submit Trade-In Request</button>
            </div>
        </form>
    </div>
@endsection

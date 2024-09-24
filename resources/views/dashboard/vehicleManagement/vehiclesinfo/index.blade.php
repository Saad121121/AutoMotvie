@extends('layouts.dashboardlayout')
@section('title', 'Vehicle')
@section('breadcrumb1', 'Vehicle Management')
@section('breadcrumb', 'Vehicle')
@section('pageTitle', 'Vehicles')
@section('content')

<div class="">
    <!-- Create Vehicle Button -->
    <form method="POST" action="{{ route('vehicles.filter') }}">
            @csrf
            <div class="row gy-2 gx-2 align-items-center">
                <div class="col-auto">
                    <div class="mb-2">
                        <label for="make_filter_id" class="form-label">Make</label>
                        <select id="make_filter_id" name="make_filter_id" class="form-select">
                            <option value="" selected>Select Make...</option>
                            @foreach ($makes as $make)
                                <option value="{{ $make->id }}">{{ $make->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="mb-2" id="model_filter_div">
                        <label for="model_filter_id" class="form-label">Model</label>
                        <select id="model_filter_id" name="model_filter_id" class="form-select">
                            <option value="" selected>Select Model...</option>
                            <!-- Models will be populated dynamically -->
                        </select>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="mb-2">
                        <label for="owner_id" class="form-label">Owner</label>
                        <select id="owner_id" name="owner_id" class="form-select">
                            <option value="" selected>Select...</option>
                            @foreach ($owners as $owner)
                                <option value="{{ $owner->id }}">{{ $owner->name }}</option>
                            @endforeach
                        </select>
 
                    </div>
                </div>
                @if (Auth::user()->role_id === 5)
 
                    <div class="col-auto">
                        <div class="mb-2">
                            <label for="showroom_id" class="form-label">Dealer</label>
                            <select id="showroom_id" name="showroom_id" class="form-select">
                                <option value="" selected>Select...</option>
                                @foreach ($showrooms as $showroom)
                                    <option value="{{ $showroom->id }}">{{ $showroom->shr_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
 
                @endif
                <div class="col-auto">
                    <div class="mb-2">
                        <label class="form-label">Date Range</label>
                        <input type="text" class="form-control date" id="singledaterange" data-toggle="date-picker"
                            data-cancel-class="btn-warning">
 
                    </div>
                </div>
                <div class="col-auto">
                    <div class="mb-2">
 
                        <label for="showroom_id" class="form-label">Condition</label>
                        <select id="showroom_id" name="showroom_id" class="form-select">
                            <option selected>Select...</option>
                            <option value="1">New</option>
                            <option value="2">Used</option>
                            <option value="3">Accident</option>
                        </select>
 
                    </div>
                </div>
 
                <div class="col-auto">
                    <div class="mb-0">
                        <label for="showroom_id" class="form-label"></label>
                        <button type="submit" class="btn btn-primary mb-2 form-select">Apply Filter</button>
                    </div>
                </div>
            </div>
        </form>

    <div class="d-flex justify-content-end align-items-center">
        <form id="resetForm" action="{{ route('vehicle.index') }}" method="GET">
            <button type="submit" class="btn btn-primary mb-3">
                <i class="mdi mdi-autorenew"></i>
                Reset</button>
        </form>
        <button type="button" class="btn btn-primary mb-3 ms-3" data-bs-toggle="modal"
            data-bs-target="#createUserModal">Create Vehicle</button>
    </div>



    <!-- Vehicle Table -->
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
    <div class="table-responsive">
        <table id="vehicleTable" class="table table-striped table-centered mb-0">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Image</th>
                    <th>Vehicle Identification Number</th>
                    <th>Make</th>
                    <th>Model</th>
                    <th>Year of Manufacture</th>
                    <th>Color</th>
                    <th>Engine Type</th>
                    <th>Mileage</th>
                    <th>Registration Number</th>
                    <th>Owner</th>
                    <th>Dealer</th>
                    <th class="no-export">Actions</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($vehicles as $index => $vehicle)
                <tr>
                    {{-- {{ dd($vehicle) }} --}}
                    <td>{{ $index + 1 }}</td>
                    <td>
                        @if (isset($vehicle->images) && count($vehicle->images) > 0)
                        <img src="{{ asset('storage/' . $vehicle->images[0]['image_path']) }}" alt="image"
                            class="img-fluid avatar-lg rounded-circle">
                        @else
                        <img src="{{ asset('build/assets/images/default_car.jpg') }}" alt="default image"
                            class="img-fluid avatar-lg rounded-circle">
                        @endif
                    </td>

                    <td>{{ $vehicle->vin ?? '-' }}</td>
                    <td>{{ $vehicle->make ? $vehicle->make->name : '-' }}</td>
                    <td>{{ $vehicle->model ? $vehicle->model->name : '-' }}</td>
                    <td>{{ $vehicle->year_of_manufacture ?? '-' }}</td>
                    <td>
                        <div
                            style="width: 20px; height: 20px; background-color: {{ $vehicle->color ?? '#FFFFFF' }}; display: inline-block; border: 1px solid #ccc;">
                        </div>
                        <span style="display: none">{{ $vehicle->color ?? '#FFFFFF' }}</span>

                    </td>
                    <td>{{ $vehicle->engine_type ?? '-' }}</td>
                    <td>{{ $vehicle->mileage . ' MPG' ?? '-' }}</td>
                    <td>{{ $vehicle->registration_number ?? '-' }}</td>
                    <td>{{ $vehicle->owner ? $vehicle->owner->name : '-' }}</td>
                    <td>{{ $vehicle->showroom ? $vehicle->showroom->shr_name : '-' }}</td>

                    @if (Auth::user()->role_id === 2 || Auth::user()->role_id === 1)
                    <td class="table-action">
                        <a href="#" class="action-icon"
                            onclick="showUpdateVehicleModal({{ $vehicle->id }}, '{{ $vehicle->vin }}', '{{ $vehicle->make->id }}', '{{ $vehicle->model->id }}', '{{ $vehicle->year_of_manufacture }}', '{{ $vehicle->color }}', '{{ $vehicle->engine_type }}', '{{ $vehicle->mileage }}', '{{ $vehicle->registration_number }}', '{{ $vehicle->owner->id }}', '{{ $vehicle->showroom->id ?? '' }}')">
                            <i class="mdi mdi-pencil"></i>
                        </a>
                        <a href="#" class="action-icon" onclick="deleteVehicle({{ $vehicle->id }})">
                            <i class="mdi mdi-delete"></i>
                        </a>
                        <a href="#" class="action-icon" data-bs-toggle="modal"
                            data-bs-target="#imageGalleryModal"
                            onclick="loadGalleryImages({{ $vehicle->id }})">
                            <i class="dripicons-camera"></i>
                        </a>
                    </td>
                    @else
                    <td></td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if (Auth::user()->role_id == 5)
    <!-- Vehicle Make Chart -->
    <div class="row mt-4">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body" style="height: 500px; position: relative;">
                    <h5 class="card-title">Vehicle Counts by Make</h5>
                    <canvas id="vehicleMakeChart" style="max-height: 100%;"></canvas>
                </div>
            </div>
        </div>


        <!-- Vehicle Model Chart -->

        <div class="col-lg-6">
            <div class="card">
                <div class="card-body" style="height: 500px; position: relative;">
                    <h5 class="card-title">Vehicle Counts by Model</h5>
                    <canvas id="vehicleModelChart" style="max-height: 100%;"></canvas>
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="">
        <div class="nav nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <button class="btn btn-primary me-1 active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-vehicle" type="button" role="tab" aria-controls="v-pills-vehicle" aria-selected="true">Add Vehicle</button>
            <button class="btn btn-primary me-1" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-model" type="button" role="tab" aria-controls="v-pills-model" aria-selected="false">Vehicle Model</button>
            <button class="btn btn-primary me-1" id="v-pills-make-tab" data-bs-toggle="pill" data-bs-target="#v-pills-make" type="button" role="tab" aria-controls="v-pills-make" aria-selected="false">Vehicle Make</button>
        </div>
        <div class="tab-content mt-4" id="v-pills-tabContent">
            <div class="tab-pane fade show active" id="v-pills-vehicle" role="tabpanel" aria-labelledby="v-pills-vehicle-tab">
                <div class="card mb-5">
                    <div class="card-body">
                        <!-- First Form -->
                        <div id="form1" style="display:block;">
                            <h1 class="mb-3" style="font-weight:900;">Create Vehicle</h1>
                            <form action="{{ route('vehicle.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-4">
                                        <!-- VIN -->
                                        <div class="mb-3">
                                            <label for="vin" class="form-label">Vehicle Identification Number (VIN)</label>
                                            <input type="text" id="vin" name="vin" class="form-control"
                                                placeholder="1HGBH41JXMN109186" value="{{ old('vin') }}" required>
                                            @error('vin')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <!-- Make -->
                                        <div class="mb-3">
                                            <label for="make_id" class="form-label">Make</label>
                                            <select id="make_id" name="make_id" class="form-select" required>
                                                <option value="" disabled selected>Select Make...</option>
                                                @foreach ($makes as $make)
                                                <option value="{{ $make->id }}">{{ $make->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('make_id')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <!-- Model -->
                                        <div class="mb-3" id="model_div">
                                            <label for="model_id" class="form-label">Model</label>
                                            <select id="model_id" name="model_id" class="form-select" required>
                                                <option value="" disabled selected>Select Model...</option>
                                                <!-- Models will be populated dynamically -->
                                            </select>
                                            @error('model_id')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <!-- Year of Manufacture -->
                                        <div class="mb-3">
                                            <label for="year_of_manufacture" class="form-label">Year of Manufacture</label>
                                            <input type="number" id="year_of_manufacture" min="1940" max="2099"
                                                name="year_of_manufacture" class="form-control" placeholder="2024"
                                                value="{{ old('year_of_manufacture') }}" required>
                                            @error('year_of_manufacture')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <!-- Color -->
                                        <div class="mb-3">
                                            <label for="color" class="form-label">Color</label>
                                            <input type="color" id="color" name="color" class="form-control" placeholder="Red"
                                                value="{{ old('color') }}" required>
                                            @error('color')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <!-- Engine Type -->
                                        <div class="mb-3">
                                            <label for="engine_type" class="form-label">Engine Type</label>
                                            <input type="text" id="engine_type" name="engine_type" class="form-control"
                                                placeholder="Petrol" value="{{ old('engine_type') }}" required>
                                            @error('engine_type')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <!-- Mileage -->
                                        <div class="mb-3">
                                            <label for="mileage" class="form-label">Mileage</label>
                                            <input type="number" id="mileage" min="0" name="mileage" class="form-control"
                                                placeholder="15000" value="{{ old('mileage') }}" required>
                                            @error('mileage')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <!-- Registration Number -->
                                        <div class="mb-3">
                                            <label for="registration_number" class="form-label">Registration Number</label>
                                            <input type="text" id="registration_number" name="registration_number"
                                                class="form-control" placeholder="ABC-1234" value="{{ old('registration_number') }}"
                                                required>
                                            @error('registration_number')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <!-- Owner -->
                                        <div class="mb-3">
                                            <label for="owner_id" class="form-label">Owner</label>
                                            <select id="owner_id" name="owner_id" class="form-select" required>
                                                <option value="" disabled selected>Select Owner...</option>
                                                @foreach ($owners as $owner)
                                                <option value="{{ $owner->id }}">{{ $owner->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('owner_id')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <!-- File Input for Images -->
                                        <div class="mb-3">
                                            <label for="images" class="form-label">Upload Vehicle Images (Add 4 or less Images) </label>
                                            <input type="file" id="images" name="images[]" class="form-control" multiple>
                                            @error('images.*')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        @if (Auth::user()->role_id == 5)

                                        <!-- Showroom -->
                                        <div class="mb-3">
                                            <label for="showroom_id" class="form-label">Showroom</label>
                                            <select id="showroom_id" name="showroom_id" class="form-select" required>
                                                <option value="" disabled selected>Select Showroom...</option>
                                                @foreach ($showrooms as $showroom)
                                                <option value="{{ $showroom->id }}">{{ $showroom->shr_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('showroom_id')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <!-- Button to go to next form -->
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="v-pills-model" role="tabpanel" aria-labelledby="v-pills-model-tab">
                <div class="card mb-5">
                    <div class="card-body">
                        <!-- Second Form (Initially Hidden) -->
                        <div id="form2">
                            <h1 class="mb-3" style="font-weight:900;">Create Vehicle Model</h1>
                            <form id="updateRoleForm" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" id="updateRoleId" name="ModelId" value="">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="updateRoleName" class="form-label">Name</label>
                                            <input type="text" id="updateRoleName" name="name" class="form-control"
                                                placeholder="Name" required>
                                            @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
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
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <!-- Button to go to next form -->
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="v-pills-make" role="tabpanel" aria-labelledby="v-pills-make-tab">
                <div class="card mb-5">
                    <div class="card-body">
                        <!-- Second Form (Initially Hidden) -->
                        <div id="form2">
                            <h1 class="mb-3" style="font-weight:900;">Create Vehicle Make</h1>
                            <form action="{{ route('vehicle-make.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="createRoleName" class="form-label">Name</label>
                                            <input type="text" id="createRoleName" name="name" class="form-control"
                                                placeholder="e.g :Toyota" required>
                                            @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <!-- Button to go to next form -->
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Image Gallery Modal -->
<div class="modal fade" id="imageGalleryModal" tabindex="-1" aria-labelledby="imageGalleryModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageGalleryModalLabel">Vehicle Images</h5>
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

<!-- Create Vehicle Modal -->
<!-- <div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createVehicleModalLabel">Add Vehicle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('vehicle.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="vin" class="form-label">Vehicle Identification Number (VIN)</label>
                        <input type="text" id="vin" name="vin" class="form-control"
                            placeholder="1HGBH41JXMN109186" value="{{ old('vin') }}" required>
                        @error('vin')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="make_id" class="form-label">Make</label>
                        <select id="make_id" name="make_id" class="form-select" required>
                            <option value="" disabled selected>Select Make...</option>
                            @foreach ($makes as $make)
                            <option value="{{ $make->id }}">{{ $make->name }}</option>
                            @endforeach
                        </select>
                        @error('make_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3" id="model_div" style="display: none;">
                        <label for="model_id" class="form-label">Model</label>
                        <select id="model_id" name="model_id" class="form-select" required>
                            <option value="" disabled selected>Select Model...</option>
                        </select>
                        @error('model_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="year_of_manufacture" class="form-label">Year of Manufacture</label>
                        <input type="number" id="year_of_manufacture" min="1940" max="2099"
                            name="year_of_manufacture" class="form-control" placeholder="2024"
                            value="{{ old('year_of_manufacture') }}" required>
                        @error('year_of_manufacture')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="color" class="form-label">Color</label>
                        <input type="color" id="color" name="color" class="form-control" placeholder="Red"
                            value="{{ old('color') }}" required>
                        @error('color')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="engine_type" class="form-label">Engine Type</label>
                        <input type="text" id="engine_type" name="engine_type" class="form-control"
                            placeholder="Petrol" value="{{ old('engine_type') }}" required>
                        @error('engine_type')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="mileage" class="form-label">Mileage</label>
                        <input type="number" id="mileage" min="0" name="mileage" class="form-control"
                            placeholder="15000" value="{{ old('mileage') }}" required>
                        @error('mileage')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="registration_number" class="form-label">Registration Number</label>
                        <input type="text" id="registration_number" name="registration_number"
                            class="form-control" placeholder="ABC-1234" value="{{ old('registration_number') }}"
                            required>
                        @error('registration_number')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="owner_id" class="form-label">Owner</label>
                        <select id="owner_id" name="owner_id" class="form-select" required>
                            <option value="" disabled selected>Select Owner...</option>
                            @foreach ($owners as $owner)
                            <option value="{{ $owner->id }}">{{ $owner->name }}</option>
                            @endforeach
                        </select>
                        @error('owner_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="images" class="form-label">Upload Vehicle Images (Add 4 or less Images) </label>
                        <input type="file" id="images" name="images[]" class="form-control" multiple>
                        @error('images.*')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    @if (Auth::user()->role_id == 5)

                    <div class="mb-3">
                        <label for="showroom_id" class="form-label">Showroom</label>
                        <select id="showroom_id" name="showroom_id" class="form-select" required>
                            <option value="" disabled selected>Select Showroom...</option>
                            @foreach ($showrooms as $showroom)
                            <option value="{{ $showroom->id }}">{{ $showroom->shr_name }}</option>
                            @endforeach
                        </select>
                        @error('showroom_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    @endif

                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div> -->
<!-- Edit vehicle Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editVehicleModalLabel">Edit Vehicle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Vehicle Form -->
                <form id="editVehicleForm" method="POST" action="{{ route('vehicle.update', ['id' => 'id']) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Hidden ID Field -->
                    <input type="hidden" id="edit_vehicle_id" name="vehicle_id">

                    <!-- VIN -->
                    <div class="mb-3">
                        <label for="edit_vin" class="form-label">VIN</label>
                        <input type="text" id="edit_vin" name="vin" class="form-control" required>
                        @error('vin')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Make -->
                    <div class="mb-3">
                        <label for="edit_make_id" class="form-label">Make</label>
                        <select id="edit_make_id" name="make_id" class="form-select" required>
                            <option value="" disabled>Select...
                            </option>
                            @foreach ($makes as $make)
                            <option value="{{ $make->id }}">{{ $make->name }}</option>
                            @endforeach
                        </select>
                        @error('make_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Model -->
                    <div class="mb-3">
                        <label for="edit_model_id" class="form-label">Model</label>
                        <select id="edit_model_id" name="model_id" class="form-select" required>
                            <!-- Model options will be populated dynamically -->
                        </select>
                        @error('model_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Year of Manufacture -->
                    <div class="mb-3">
                        <label for="edit_year_of_manufacture" class="form-label">Year of Manufacture</label>
                        <input type="text" id="edit_year_of_manufacture" name="year_of_manufacture"
                            class="form-control" required>
                        @error('year_of_manufacture')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Color -->
                    <div class="mb-3">
                        <label for="edit_color" class="form-label">Color</label>
                        <input type="color" id="edit_color" name="color" class="form-control" required>
                        @error('color')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Engine Type -->
                    <div class="mb-3">
                        <label for="edit_engine_type" class="form-label">Engine Type</label>
                        <input type="text" id="edit_engine_type" name="engine_type" class="form-control"
                            required>
                        @error('engine_type')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Mileage -->
                    <div class="mb-3">
                        <label for="edit_mileage" class="form-label">Mileage</label>
                        <input type="text" id="edit_mileage" name="mileage" class="form-control" required>
                        @error('mileage')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Registration Number -->
                    <div class="mb-3">
                        <label for="edit_registration_number" class="form-label">Registration Number</label>
                        <input type="text" id="edit_registration_number" name="registration_number"
                            class="form-control" required>
                        @error('registration_number')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Owner -->
                    <div class="mb-3">
                        <label for="edit_owner_id" class="form-label">Owner</label>
                        <select id="edit_owner_id" name="owner_id" class="form-select" required>
                            <option value="" disabled>Select...
                            </option>
                            @foreach ($owners as $owner)
                            <option value="{{ $owner->id }}">{{ $owner->name }}</option>
                            @endforeach
                        </select>
                        @error('owner_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    @if (Auth::user()->role_id == 5)
                    <!-- Showroom -->
                    <div class="mb-3">
                        <label for="edit_showroom_id" class="form-label">Showroom</label>
                        <select id="edit_showroom_id" name="showroom_id" class="form-select" required>
                            <option value="" disabled>Select...
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
                    <input type="hidden" name="showroom_id" id="hid_showroom_id" value="">
                    @endif
                    <!-- Gallery Images -->
                    <!-- Images -->
                    <div class="mb-3">
                        <label for="edit_images" class="form-label">Upload Vehicle Images (Leave it null if dnt want
                            to update images)</label>
                        <input type="file" id="edit_images" name="imagess[]" class="form-control" multiple>
                        @error('imagess.*')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<!-- <script>
    document.getElementById('nextButton').addEventListener('click', function() {
        // Hide the first form
        document.getElementById('form1').style.display = 'none';
        // Show the second form
        document.getElementById('form2').style.display = 'block';
    });

    document.getElementById('backButton').addEventListener('click', function() {
        // Show the first form
        document.getElementById('form1').style.display = 'block';
        // Hide the second form
        document.getElementById('form2').style.display = 'none';
    });
</script> -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Static data for Vehicle Make Chart
        const vehicleCountsByMake = {
            1: 10,
            2: 5,
            3: 8
        };
        const makeNames = {
            1: "Toyota",
            2: "Honda",
            3: "Nissan"
        };

        const makeLabels = Object.values(makeNames);
        const makeData = Object.values(vehicleCountsByMake);

        const ctxMake = document.getElementById('vehicleMakeChart').getContext('2d');
        new Chart(ctxMake, {
            type: 'bar',
            data: {
                labels: makeLabels,
                datasets: [{
                    label: 'Vehicle Counts by Make',
                    data: makeData,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Static data for Vehicle Model Chart
        const vehicleCountsByModel = {
            1: 7,
            2: 6,
            3: 4,
            4: 2
        };
        const modelNames = {
            1: "Corolla",
            2: "Civic",
            3: "Altima",
            4: "Maxima"
        };

        const modelLabels = Object.values(modelNames);
        const modelData = Object.values(vehicleCountsByModel);

        const ctxModel = document.getElementById('vehicleModelChart').getContext('2d');
        new Chart(ctxModel, {
            type: 'bar',
            data: {
                labels: modelLabels,
                datasets: [{
                    label: 'Vehicle Counts by Model',
                    data: modelData,
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });

    function loadGalleryImages(vehicleId) {
        fetch(`/vehicles/${vehicleId}/images`) // Define this route in your Laravel routes file
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

    function resetFilters() {
        const form = document.getElementById('filterForm');
        form.reset(); // Reset the form fields

        // Optionally, you can redirect to the index route directly
        window.location.href = "{{ route('vehicle.index') }}";
    }
    document.addEventListener('DOMContentLoaded', function() {
        const makeSelectFilter = document.getElementById('make_filter_id');
        const modelSelectFilter = document.getElementById('model_filter_id');
        const modelDiv = document.getElementById('model_filter_div');

        makeSelectFilter.addEventListener('change', function() {
            const makeId = makeSelectFilter.value;

            if (makeId) {

                fetch(`/vehicle/models/${makeId}`)
                    .then(response => response.json())
                    .then(data => {
                        // Clear existing options
                        modelSelectFilter.innerHTML =
                            '<option value="" selected>Select Model...</option>';

                        // Check if data.models exists and is an array
                        if (data.models && Array.isArray(data.models)) {
                            data.models.forEach(model => {
                                const option = document.createElement('option');
                                option.value = model.id;
                                option.textContent = model.name;
                                modelSelectFilter.appendChild(option);
                            });
                        } else {
                            console.error(
                                'No models property in response data or models is not an array');
                        }
                    })
                    .catch(error => console.error('Error fetching models:', error));
            } else {

                modelSelectFilter.innerHTML =
                    '<option value="" disabled selected>Select Model...</option>';
            }
        });

    });

    document.addEventListener('DOMContentLoaded', function() {
        const makeSelect = document.getElementById('make_id');
        const modelSelect = document.getElementById('model_id');
        const modelDiv = document.getElementById('model_div');

        makeSelect.addEventListener('change', function() {
            const makeId = makeSelect.value;

            if (makeId) {
                modelDiv.style.display = 'block';
                modelSelect.required = true; // Make it required when visible

                fetch(`/vehicle/models/${makeId}`)
                    .then(response => response.json())
                    .then(data => {
                        // Clear existing options
                        modelSelect.innerHTML =
                            '<option value="" disabled selected>Select Model...</option>';

                        // Check if data.models exists and is an array
                        if (data.models && Array.isArray(data.models)) {
                            data.models.forEach(model => {
                                const option = document.createElement('option');
                                option.value = model.id;
                                option.textContent = model.name;
                                modelSelect.appendChild(option);
                            });
                        } else {
                            console.error(
                                'No models property in response data or models is not an array');
                        }
                    })
                    .catch(error => console.error('Error fetching models:', error));
            } else {
                modelDiv.style.display = 'none';
                modelSelect.required = false; // Remove required when hidden
                modelSelect.innerHTML = '<option value="" disabled selected>Select Model...</option>';
            }
        });
    });
    // $(document).ready(function() {
    //     $('#vehicleTable').DataTable({
    //         paging: true,
    //         searching: true,
    //         ordering: true,
    //         lengthChange: false,
    //         info: true,
    //         pageLength: 15,
    //         language: {
    //             searchPlaceholder: "Search records...",
    //             paginate: {
    //                 previous: "Prev",
    //                 next: "Next"
    //             },
    //             info: "Showing _START_ to _END_ of _TOTAL_ entries",
    //             infoEmpty: "No entries found",
    //             infoFiltered: "(filtered from _MAX_ total entries)"
    //         }
    //     });
    // });
    //datatable recent
    // $(document).ready(function() {
    //     $('#vehicleTable').DataTable({
    //         paging: true,
    //         searching: true,
    //         ordering: true,
    //         lengthChange: false,
    //         info: true,
    //         pageLength: 15,
    //         dom: 'Bfrtip',
    //         buttons: [{
    //                 extend: 'csv',
    //                 text: 'CSV',
    //                 exportOptions: {
    //                     columns: ':visible'
    //                 }
    //             },
    //             {
    //                 extend: 'excel',
    //                 text: 'Excel',
    //                 exportOptions: {
    //                     columns: ':visible'
    //                 }
    //             },
    //             {
    //                 extend: 'pdf',
    //                 text: 'PDF',
    //                 pageSize: 'A3',
    //                 exportOptions: {
    //                     columns: ':visible',
    //                     modifier: {
    //                         page: 'all' // Include all pages
    //                     }
    //                 }
    //             }
    //         ],
    //         columnDefs: [{
    //             targets: 11, // Targets the "Actions" column (12th column, zero-based index)
    //             className: 'no-export' // Add class to hide in export
    //         }],
    //         responsive: true, // Add this line to make the table responsive
    //         language: {
    //             searchPlaceholder: "Search records...",
    //             paginate: {
    //                 previous: "Prev",
    //                 next: "Next"
    //             },
    //             info: "Showing _START_ to _END_ of _TOTAL_ entries",
    //             infoEmpty: "No entries found",
    //             infoFiltered: "(filtered from _MAX_ total entries)"
    //         }
    //     });
    // });
    $(document).ready(function() {
        $('#vehicleTable').DataTable({
            paging: true,
            searching: true,
            ordering: true,
            lengthChange: false,
            info: true,
            pageLength: 15,
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'csv',
                    text: 'CSV',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'excel',
                    text: 'Excel',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    text: 'PDF',
                    action: function(e, dt, node, config) {
                        var data = dt.buttons.exportData();
                        var docDefinition = {
                            pageSize: 'A3', // Set the page size to A3
                            content: [{
                                    text: 'Vehicles',
                                    style: 'header'
                                },
                                {
                                    table: {
                                        headerRows: 1,
                                        body: [
                                            data.header,
                                            ...data.body
                                        ]
                                    }
                                }
                            ],
                            styles: {
                                header: {
                                    fontSize: 18,
                                    bold: true
                                }
                            }
                        };

                        // Open PDF in new window/tab
                        pdfMake.createPdf(docDefinition).open();
                    }
                }
            ],
            columnDefs: [{
                targets: 11, // Targets the "Actions" column (12th column, zero-based index)
                className: 'no-export' // Add class to hide in export
            }],
            responsive: true, // Add this line to make the table responsive
            language: {
                searchPlaceholder: "Search records...",
                paginate: {
                    previous: "Prev",
                    next: "Next"
                },
                info: "Showing _START_ to _END_ of _TOTAL_ entries",
                infoEmpty: "No entries found",
                infoFiltered: "(filtered from _MAX_ total entries)"
            }
        });
    });



    function showUpdateVehicleModal(id, vin, makeId, modelId, yearOfManufacture, color, engineType, mileage,
        registrationNumber, ownerId, showroomId) {
        // Set form values
        var userRoleId = "{{ Auth::user()->role_id }}";
        // console.log('userRoleId>>>>', userRoleId);


        document.getElementById('edit_vehicle_id').value = id;
        document.getElementById('edit_vin').value = vin;
        document.getElementById('edit_make_id').value = makeId;
        document.getElementById('edit_year_of_manufacture').value = yearOfManufacture;
        document.getElementById('edit_color').value = color;
        document.getElementById('edit_engine_type').value = engineType;
        document.getElementById('edit_mileage').value = mileage;
        document.getElementById('edit_registration_number').value = registrationNumber;
        document.getElementById('edit_owner_id').value = ownerId;
        if (userRoleId != 5) {

            document.getElementById('hid_showroom_id').value = showroomId;
        } else {
            document.getElementById('edit_showroom_id').value = showroomId;

        }

        // Initialize model dropdown
        const modelDropdown = document.getElementById('edit_model_id');
        modelDropdown.innerHTML =
            '<option value="" disabled selected>Loading models...</option>'; // Show loading option
        // Function to fetch and update models
        function fetchAndUpdateModels(makeId) {
            fetch(`/vehicle/models/${makeId}`)
                .then(response => response.json())
                .then(data => {
                    modelDropdown.innerHTML = '<option value="" disabled selected>Select Model...</option>';

                    if (data.models && Array.isArray(data.models)) {
                        let modelFound = false;
                        data.models.forEach(model => {
                            const option = document.createElement('option');
                            option.value = model.id;
                            option.textContent = model.name;
                            modelDropdown.appendChild(option);
                            if (model.id == modelId) {
                                modelFound = true;
                            }
                        });
                        if (!modelFound) {
                            modelDropdown.value = '';
                        } else {
                            modelDropdown.value = modelId;
                        }
                    } else {
                        console.error('No models property in response data or models is not an array');
                    }
                })
                .catch(error => {
                    console.error('Error fetching models:', error);
                });
        }
        fetchAndUpdateModels(makeId);
        document.getElementById('edit_make_id').addEventListener('change', function() {
            const newMakeId = this.value;
            fetchAndUpdateModels(newMakeId);
        });
        var editUserModal = new bootstrap.Modal(document.getElementById('editUserModal'));
        editUserModal.show();
    }

    function deleteVehicle(id) {
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
                    url: `/vehicle/${id}`,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        Swal.fire(
                            'Deleted!',
                            'The Vehicle has been deleted.',
                            'success'
                        ).then(() => {
                            location.reload();
                        });
                    },
                    error: function(xhr) {
                        Swal.fire(
                            'Error!',
                            'There was an issue deleting the manager.',
                            'error'
                        );
                    }
                });
            }
        });
    }
</script>
@endpush
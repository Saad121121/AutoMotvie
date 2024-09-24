@extends('layouts.dashboardlayout')

@section('title', 'Dealer Vehicle Inventory')
@section('breadcrumb1', 'Inventory Management')
@section('breadcrumb', 'Dealer Vehicle Inventory')
@section('pageTitle', 'Dealer Vehicle Inventory')

@section('content')
<div class="body-content">
    <!-- Add Inventory Button -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createInventoryModal">
        Add Inventory
    </button>

    <!-- Show Inventory Table Button -->
    <button type="button" class="btn btn-secondary mb-3" id="showInventoryTableBtn">
        Show Inventory Table
    </button>
    <a href="{{ route('download-inventory-pdf') }}" class="btn btn-secondary mb-3">Download PDF Report</a>
    <a href="{{ route('send-inventory-report') }}" class="btn btn-primary mb-3">Email Report</a>

    @if (session('success'))
    <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
            aria-label="Close"></button>
        <strong>Success - </strong> {{ session('success') }}
    </div>
    @endif
    <!-- Static Inventory Table (hidden initially) -->
    <div id="inventoryTableContainer" style="display: none;">
        <table class="table table-striped table-centered mb-0">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>VIN</th>
                    <th>Make</th>
                    <th>Model</th>
                    <th>Year</th>
                    <th>Color</th>
                    <th>Engine Type</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>1HGCM82633A123456</td>
                    <td>Honda</td>
                    <td>Accord</td>
                    <td>2023</td>
                    <td>Black</td>
                    <td>V6</td>
                </tr>
            </tbody>
        </table>
    </div>


    <div class="row mt-4">
        <!-- Bar Chart -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body" style="height: 100%; position: relative;">
                    <h5 class="card-title">Vehicle Inventory (Bar Chart)</h5>
                    <canvas id="inventoryBarChart" style="max-height: 100%; margin-top:2rem;"></canvas>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body" style="height: 100%; position: relative;">
                    <h5 class="card-title">Vehicle Inventory (Pie Chart)</h5>
                    <canvas id="inventoryPieChart" style="width:200px !important; height:20px !important; margin-top:2rem;"></canvas>
                </div>
            </div>
        </div>

        <!-- Line Chart -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body" style="height: 100%; position: relative;">
                    <h5 class="card-title">Vehicle Inventory (Line Chart)</h5>
                    <canvas id="inventoryLineChart" style="max-height: 100%; margin-top:2rem;"></canvas>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Create Inventory Modal -->
<div class="modal fade" id="createInventoryModal" tabindex="-1" aria-labelledby="createInventoryModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createInventoryModalLabel">Add Inventory</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Inventory Form -->
                <form action="#">
                    @csrf
                    <div class="mb-3">
                        <label for="vin" class="form-label">VIN</label>
                        <input type="text" id="vin" name="vin" class="form-control"
                            placeholder="Vehicle Identification Number" required>
                    </div>
                    <div class="mb-3">
                        <label for="make" class="form-label">Make</label>
                        <input type="text" id="make" name="make" class="form-control" placeholder="Make"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="model" class="form-label">Model</label>
                        <input type="text" id="model" name="model" class="form-control" placeholder="Model"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="year" class="form-label">Year</label>
                        <input type="number" id="year" name="year" class="form-control" placeholder="Year"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="color" class="form-label">Color</label>
                        <input type="text" id="color" name="color" class="form-control" placeholder="Color"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="engine_type" class="form-label">Engine Type</label>
                        <input type="text" id="engine_type" name="engine_type" class="form-control"
                            placeholder="Engine Type" required>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Show the inventory table when the button is clicked
    document.getElementById('showInventoryTableBtn').addEventListener('click', function() {
        var inventoryTableContainer = document.getElementById('inventoryTableContainer');
        inventoryTableContainer.style.display = inventoryTableContainer.style.display === 'none' ? 'block' :
            'none';
    });
    document.addEventListener('DOMContentLoaded', function() {
        // Bar Chart for Inventory
        var ctxBar = document.getElementById('inventoryBarChart').getContext('2d');
        var inventoryBarChart = new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: ['Honda Accord', 'Toyota Corolla', 'Ford Fusion', 'Chevrolet Malibu'],
                datasets: [{
                    label: 'Number of Vehicles',
                    data: [10, 15, 8, 12],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Pie Chart for Inventory
        var ctxPie = document.getElementById('inventoryPieChart').getContext('2d');
        var inventoryPieChart = new Chart(ctxPie, {
            type: 'pie',
            data: {
                labels: ['Honda Accord', 'Toyota Corolla', 'Ford Fusion', 'Chevrolet Malibu'],
                datasets: [{
                    label: 'Number of Vehicles',
                    data: [10, 15, 8, 12],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)'
                    ],

                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true
            }
        });

        // Line Chart for Inventory
        var ctxLine = document.getElementById('inventoryLineChart').getContext('2d');
        var inventoryLineChart = new Chart(ctxLine, {
            type: 'line',
            data: {
                labels: ['Honda Accord', 'Toyota Corolla', 'Ford Fusion', 'Chevrolet Malibu'],
                datasets: [{
                    label: 'Number of Vehicles',
                    data: [10, 15, 8, 12],
                    fill: false,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
@endpush
@extends('layouts.dashboardlayout')

@section('title', 'Master Inventory')
@section('breadcrumb1', 'Inventory Management')
@section('breadcrumb', 'Master Inventory')
@section('pageTitle', 'Master Inventory')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->

        {{-- <div class="row gy-2 gx-2 align-items-center">

            <div class="col-auto">
                <div class="mb-2">
                    <label for="category_id" class="form-label">Category</label>
                    <select id="category_id" name="category_id" class="form-select">
                        <option value="" selected>Select Category...</option>
                        <option value="1">ENgine Component</option>
                        <option value="2">Fuel System</option>
                        <option value="3">Exhaust System</option>
                        <option value="3">Beaking System</option>
                        <!-- Add more categories as needed -->
                    </select>
                </div>
            </div>

            <div class="col-auto">
                <div class="mb-2">
                    <label for="location_id" class="form-label">Stock Level By Parts</label>
                    <select id="location_id" name="location_id" class="form-select">
                        <option value="" selected>Select Parts...</option>
                        <option value="1">Fuel Pump</option>
                        <option value="2">Break Pads</option>
                        <option value="3">Pistons</option>
                        <option value="4">Muffler</option>
                        <option value="4">Crankshaft</option>
                        <option value="4">Germany</option>
                        <option value="4">Japan</option>
                        <option value="4">France</option>
                        <!-- Add more locations as needed -->
                    </select>
                </div>
            </div>

            <div class="col-auto">
                <div class="mb-2">
                    <label for="stock_level_id" class="form-label">Stock Level</label>
                    <select id="stock_level_id" name="stock_level_id" class="form-select">
                        <option value="" selected>Select Stock Level...</option>
                        <option value="1">In Stock</option>
                        <option value="2">Low Stock</option>
                        <option value="3">Out of Stock</option>
                    </select>
                </div>
            </div>




            <div class="col-auto">
                <div class="mb-0">
                    <label for="showroom_id" class="form-label"></label>
                    <button type="submit" class="btn btn-primary mb-2 form-select">Apply Filter</button>
                </div>
            </div>
        </div> --}}
        <div class="row">
            <div class="col-lg-12">
                <h2 class="mt-4 mb-3">Master Inventory Summary</h2>
                <p>Overview of inventory performance and key metrics for dealer management.</p>
            </div>
        </div>

        <!-- Key Metrics Section -->
        <div class="row mb-4">
            <!-- Total Parts -->
            <div class="col-lg-3 mb-3">
                <div class="card mb-0" style="height:100%;">
                    <div class="card-body text-center">
                        <h5>Total Parts</h5>
                        <h3>150</h3> <!-- Static value -->
                        <p class="mb-0">All parts currently in inventory</p>
                    </div>
                </div>
            </div>

            <!-- Low Stock Items -->
            <div class="col-lg-3 mb-3">
                <div class="card mb-0" style="height:100%;">
                    <div class="card-body text-center">
                        <h5>Low Stock Items</h5>
                        <h3>12</h3> <!-- Static value -->
                        <p class="mb-0">Parts with critically low stock levels</p>
                    </div>
                </div>
            </div>

            <!-- Recent Transactions -->
            <div class="col-lg-3 mb-3">
                <div class="card mb-0" style="height:100%;">
                    <div class="card-body text-center">
                        <h5>Recent Purchase Orders</h5>
                        <h3>30</h3> <!-- Static value -->
                        <p class="mb-0">Purchase Orders processed in the last 30 days</p>
                    </div>
                </div>
            </div>

            <!-- Parts Ordered -->
            <div class="col-lg-3 mb-3">
                <div class="card mb-0" style="height:100%;">
                    <div class="card-body text-center">
                        <h5>Total Parts Ordered</h5>
                        <h3>80</h3> <!-- Static value -->
                        <p class="mb-0">Parts ordered by dealers in the last month</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Graphical Representation Section -->
        <div class="row mb-5">
            <!-- Pie Chart for Stock Distribution by Category -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4>Stock Distribution by Category</h4>
                        <div style="width: 500px; height: 528px; margin: 0 auto;">
                            <canvas id="stockDistributionPieChart"></canvas> <!-- Pie chart with fixed size -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bar Chart for Stock Levels by Part -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4>Stock Levels by Part</h4>
                        <canvas id="stockLevelBarChart"></canvas> <!-- Bar chart placeholder -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Detailed Inventory Breakdown Section -->
        <div class="row mb-5">
            <!-- Top 5 Parts with Highest Stock -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4>Top 5 Parts with Highest Stock</h4>
                        <ul class="list-group">
                            <li class="list-group-item">Fuel Pump - 500 units</li> <!-- Static values -->
                            <li class="list-group-item">Break Pads - 300 units</li>
                            <li class="list-group-item">Pistons - 200 units</li>
                            <li class="list-group-item">Muffler - 100 units</li>
                            <li class="list-group-item">Crankshaft - 95 units</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Top 5 Parts with Lowest Stock -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4>Top 5 Parts with Lowest Stock</h4>
                        <ul class="list-group">
                            <li class="list-group-item">Timing belts - 5 units</li> <!-- Static values -->
                            <li class="list-group-item">Ignition coil - 8 units</li>
                            <li class="list-group-item">Radiators - 10 units</li>
                            <li class="list-group-item">Batteries - 15 units</li>
                            <li class="list-group-item">Brake calipers - 20 units</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Transactions Table -->
        {{-- <div class="row mb-5">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4>Recent Transactions</h4>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Transaction ID</th>
                                    <th>Date</th>
                                    <th>Dealer</th>
                                    <th>Part</th>
                                    <th>Quantity</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>TXN001</td>
                                    <td>2024-09-01</td>
                                    <td>Dealer A</td>
                                    <td>Part A</td>
                                    <td>10</td>
                                    <td>Completed</td>
                                </tr>
                                <tr>
                                    <td>TXN002</td>
                                    <td>2024-09-02</td>
                                    <td>Dealer B</td>
                                    <td>Part B</td>
                                    <td>5</td>
                                    <td>Completed</td>
                                </tr>
                                <!-- Add more rows as needed -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
@endsection

@push('scripts')
    <!-- Include Chart.js Library -->

    <script>
        // Pie Chart for Stock Distribution by Category
        var ctxPie = document.getElementById('stockDistributionPieChart').getContext('2d');
        var stockDistributionPieChart = new Chart(ctxPie, {
            type: 'pie',
            data: {
                labels: ['Engine Components', 'Fuel System', 'Exhaust System',
                    'Breaking System'
                ], // Static categories
                datasets: [{
                    label: 'Stock Distribution',
                    data: [300, 500, 700, 400], // Static values
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0'],
                }]
            }
        });

        // Bar Chart for Stock Levels by Part
        var ctxBar = document.getElementById('stockLevelBarChart').getContext('2d');
        var stockLevelBarChart = new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: ['Fuel Pump', 'Break Pads', 'Pistons', 'Muffler'], // Static parts
                datasets: [{
                    label: 'Stock Levels',
                    data: [500, 300, 200, 100], // Static values
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0'],
                    borderColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0'],
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
    </script>
@endpush

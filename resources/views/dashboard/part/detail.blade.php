@extends('layouts.dashboardlayout')
@section('title', 'Part Detail')
@section('breadcrumb1', 'Inventory Management')
@section('breadcrumb', 'Part Detail')
@section('pageTitle', 'Part Detail')

@section('content')
    <div class="container">
        <!-- Part Information Section -->
        <div class="card mb-4">
            <div class="card-header">
                <h4>Part Details</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Part Information</h5>
                        <p><strong>Part Name:</strong> Front Brake Pad</p>
                        <p><strong>Part Number:</strong> FBP-1234</p>
                        <p><strong>Category:</strong> Brake System</p>
                        <p><strong>Stock Level:</strong> 100 units</p>
                        <p><strong>Reorder Point:</strong> 20 units</p>
                    </div>
                    <div class="col-md-6">
                        <h5>Edit Stock Details</h5>
                        <form>
                            <div class="mb-3">
                                <label for="stock_level" class="form-label">Stock Level</label>
                                <input type="number" id="stock_level" name="stock_level" class="form-control"
                                    value="100">
                            </div>
                            <div class="mb-3">
                                <label for="reorder_point" class="form-label">Reorder Point</label>
                                <input type="number" id="reorder_point" name="reorder_point" class="form-control"
                                    value="20">
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stock Level Graph Section -->
        <div class="card mb-4">
            <div class="card-header">
                <h4>Stock Levels Over Time</h4>
            </div>
            <div class="card-body">
                <canvas id="stockLevelLineChart"></canvas> <!-- Line chart for stock levels -->
            </div>
        </div>

        <!-- Transaction History Section with Bar Chart -->
        <div class="card mb-4">
            <div class="card-header">
                <h4>Transaction History</h4>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Transaction Type</th>
                            <th>Quantity</th>
                            <th>Stock After Transaction</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>2024-09-01</td>
                            <td>Restock</td>
                            <td>+50</td>
                            <td>100</td>
                        </tr>
                        <tr>
                            <td>2024-08-15</td>
                            <td>Sale</td>
                            <td>-10</td>
                            <td>50</td>
                        </tr>
                        <tr>
                            <td>2024-07-30</td>
                            <td>Restock</td>
                            <td>+60</td>
                            <td>60</td>
                        </tr>
                    </tbody>
                </table>
                <div class="mt-4">
                    <canvas id="transactionBarChart"></canvas> <!-- Bar chart for transaction history -->
                </div>
            </div>
        </div>

        <!-- Reorder Alerts Section -->
        <div class="card">
            <div class="card-header">
                <h4>Reorder Alerts</h4>
            </div>
            <div class="card-body">
                <p><strong>Next Reorder Needed:</strong> When stock drops below 20 units</p>
                <p><strong>Reorder Suggestion:</strong> 100 units</p>
                <button class="btn btn-warning">Trigger Reorder</button>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <!-- Stock Level Line Chart Script -->
    <script>
        var ctx = document.getElementById('stockLevelLineChart').getContext('2d');
        var stockLevelLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['2024-07-01', '2024-07-15', '2024-08-01', '2024-08-15', '2024-09-01'],
                datasets: [{
                    label: 'Stock Level',
                    data: [40, 60, 50, 90, 100], // Example data
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    fill: true,
                    tension: 0.1
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
    </script>

    <!-- Transaction Bar Chart Script -->
    <script>
        var ctx = document.getElementById('transactionBarChart').getContext('2d');
        var transactionBarChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['2024-09-01', '2024-08-15', '2024-07-30'], // Example data
                datasets: [{
                    label: 'Transaction Quantity',
                    data: [50, -10, 60], // Example data
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)'
                    ],
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
    </script>
@endpush

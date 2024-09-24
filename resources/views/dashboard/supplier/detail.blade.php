@extends('layouts.dashboardlayout')
@section('title', 'Supplier Detail')
@section('breadcrumb1', 'Supplier Management')
@section('breadcrumb', 'Supplier Detail')
@section('pageTitle', 'Supplier Detail')

@section('content')
    <div class="container">
        <!-- Supplier Information Section -->
        <div class="card mb-4">
            <div class="card-header">
                <h4>Supplier Details</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Supplier Information</h5>
                        <p><strong>Supplier Name:</strong> ABC Parts Co.</p>
                        <p><strong>Supplier ID:</strong> SUP-4567</p>
                        <p><strong>Contact:</strong> John Doe</p>
                        <p><strong>Email:</strong> johndoe@abcparts.com</p>
                        <p><strong>Phone:</strong> +123 456 789</p>
                    </div>
                    <div class="col-md-6">
                        <h5>Additional Information</h5>
                        <p><strong>Location:</strong> 123 Industrial Park, CA</p>
                        {{-- <p><strong>Supplier Rating:</strong> ★★★★☆</p> --}}
                        <p><strong>Supplier Type:</strong> Local</p>
                        <p><strong>Preferred Payment Method:</strong> Bank Transfer</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Parts Supplied Section -->
        <div class="card mb-4">
            <div class="card-header">
                <h4>Parts Supplied</h4>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Part Name</th>
                            <th>Part Number</th>
                            <th>Category</th>
                            <th>Stock Level</th>
                            <th>Price Per Unit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Front Brake Pad</td>
                            <td>FBP-1234</td>
                            <td>Brake System</td>
                            <td>100 units</td>
                            <td>$15.00</td>
                        </tr>
                        <tr>
                            <td>Oil Filter</td>
                            <td>OF-4567</td>
                            <td>Engine</td>
                            <td>200 units</td>
                            <td>$5.00</td>
                        </tr>
                        <tr>
                            <td>Headlight Assembly</td>
                            <td>HA-7890</td>
                            <td>Electrical</td>
                            <td>50 units</td>
                            <td>$45.00</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Parts Distribution Pie Chart -->
        <div class="card mb-4">
            <div class="card-header">
                <h4>Parts Distribution by Category</h4>
            </div>
            <div class="card-body" style="width: 500px; height: 528px; margin: 0 auto;">
                <canvas id="partsDistributionPieChart"></canvas> <!-- Pie chart for parts distribution -->
            </div>
        </div>

        <!-- Communication History Section -->
        <div class="card mb-4">
            <div class="card-header">
                <h4>Communication History</h4>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Method</th>
                            <th>Notes</th>
                            <th>Follow-up Needed</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>2024-08-30</td>
                            <td>Email</td>
                            <td>Discussed bulk order discount.</td>
                            <td>Yes</td>
                        </tr>
                        <tr>
                            <td>2024-08-15</td>
                            <td>Phone</td>
                            <td>Confirmed delivery timeline.</td>
                            <td>No</td>
                        </tr>
                        <tr>
                            <td>2024-07-25</td>
                            <td>Meeting</td>
                            <td>Reviewed contract renewal.</td>
                            <td>Yes</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Payment Terms Section -->
        <div class="card mb-4">
            <div class="card-header">
                <h4>Payment Terms</h4>
            </div>
            <div class="card-body">
                <p><strong>Payment Terms:</strong> Net 30</p>
                <p><strong>Outstanding Balance:</strong> $3,500</p>
                <div class="mt-4" style="width: 800px; height: 800px; margin: 0 auto;">
                    <canvas id="paymentTermsBarChart"></canvas> <!-- Bar chart for payment history -->
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <!-- Parts Distribution Pie Chart Script -->
    <script>
        var ctx = document.getElementById('partsDistributionPieChart').getContext('2d');
        var partsDistributionPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Brake System', 'Engine', 'Electrical'], // Example categories
                datasets: [{
                    label: 'Parts Distribution',
                    data: [40, 35, 25], // Example data
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(153, 102, 255, 0.2)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>

    <!-- Payment Terms Bar Chart Script -->
    <script>
        var ctx = document.getElementById('paymentTermsBarChart').getContext('2d');
        var paymentTermsBarChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['July', 'August', 'September'], // Example months
                datasets: [{
                    label: 'Payments Due',
                    data: [1200, 1500, 800], // Example data
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 206, 86, 0.2)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 206, 86, 1)'
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

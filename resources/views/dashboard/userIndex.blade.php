@extends('layouts.dashboardlayout')
@section('title', 'Customer Dashboard')
@section('breadcrumb1', 'Customer Dashboard')
@section('breadcrumb', 'Home')
@section('pageTitle', 'Customer Dashboard')
@section('content')
<style>
    .cstm-swiper-btn {
        color: #fff;
        background-color: #000;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .swiper-button-next.cstm-swiper-btn:after,
    .swiper-button-prev.cstm-swiper-btn:after {
        font-size: 16px;
        font-weight: 800;
    }
    .swiper-button-next.cstm-swiper-btn:after{
        margin-left: 2px;
    }
    .swiper-button-prev.cstm-swiper-btn:after{
        margin-right: 2px;
    }
</style>



{{-- <div class="container">

        <h1>Hello Customer!!! {{ Auth::user()->name }}</h1>

</div> --}}
<div class="body-content">

    <!-- Greeting Message -->
    <div class="alert alert-info text-center" role="alert">
        <h1>Welcome, {{ Auth::user()->name }}</h1>
    </div>

    <!-- Row for Vehicle Statistics -->
    <div class="row mb-4 mt-4">
        <!-- Total Vehicles Card -->
        <div class="col-md-3">
            <div class="card mb-3">
                <div class="card-header black-card-header">
                    <h5 class="mb-0 mt1"> Total Vehicles </h5>
                </div>
                <div class="card-body">
                    <h5 class="card-title">5</h5>
                    <p class="card-text">Owned by you</p>
                </div>
            </div>
        </div>
        <!-- Upcoming Maintenance Card -->
        <div class="col-md-3">
            <div class="card mb-3">
                <div class="card-header black-card-header">
                    <h5 class="mb-0 mt1"> Upcoming Maintenance </h5>
                </div>
                <div class="card-body">
                    <h4 class="card-title">2</h4>
                    <p class="card-text">Scheduled services</p>
                </div>
            </div>
        </div>
        <!-- Recent Services Card -->
        <div class="col-md-3">
            <div class="card mb-3">
                <div class="card-header black-card-header">
                    <h5 class="mb-0 mt1"> Recent Services </h5>
                </div>
                <div class="card-body">
                    <h5 class="card-title">4</h5>
                    <p class="card-text">Completed this month</p>
                </div>
            </div>
        </div>
        <!-- Alerts Card -->
        <div class="col-md-3">
            <div class="card mb-3">
                <div class="card-header black-card-header">
                    <h5 class="mb-0 mt1"> Alerts </h5>
                </div>
                <div class="card-body">
                    <h5 class="card-title">1</h5>
                    <p class="card-text">Service overdue</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Row for Charts -->
    <div class="row mb-4">
        <!-- Service History Chart -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Service History
                </div>
                <div class="card-body">
                    <canvas id="serviceHistoryChart"></canvas>
                </div>
            </div>
        </div>
        <!-- Maintenance Pie Chart -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Maintenance Breakdown
                </div>
                <div class="card-body">
                    <canvas id="maintenancePieChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Row for Recent Activities Table -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header ps-2">
                    <h5 class="mb-0 mt-1"> Recent Activities</h5>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Vehicle</th>
                                <th>Service Type</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Toyota Corolla</td>
                                <td>Oil Change</td>
                                <td>2024-08-01</td>
                                <td><span style="color: var(--ct-table-striped-color) !important;" class="badge badge-success">Completed</span></td>
                            </tr>
                            <tr>
                                <td>Honda Civic</td>
                                <td>Tire Rotation</td>
                                <td>2024-08-15</td>
                                <td><span style="color: var(--ct-table-striped-color) !important;" class="badge badge-warning">Upcoming</span></td>
                            </tr>
                            <tr>
                                <td>Ford Mustang</td>
                                <td>Brake Inspection</td>
                                <td>2024-07-28</td>
                                <td><span style="color: var(--ct-table-striped-color) !important;" class="badge badge-success">Completed</span></td>
                            </tr>
                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content cstm-promotion-modal">
            <div class="swiper mySwiper w-100">
                <div class="swiper-wrapper">
                    @foreach ($promotions as $promotion)
                    @if ($promotion->image)
                    <div class="swiper-slide">
                        <div class="promotion-img">
                            <img src="{{ asset('storage/promotionsImages/' . $promotion->image) }}"
                                alt="{{ $promotion->name }}">
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
                <div class="swiper-button-next cstm-swiper-btn"></div>
                <div class="swiper-button-prev cstm-swiper-btn"></div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script>
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 1,
        spaceBetween: 10,
        loop: true,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        }
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Initialize modal
        var myModal = new bootstrap.Modal(document.getElementById('myModal'));
        // Show modal when page loads
        myModal.show();
        // Add event listener to the link to open modal when clicked
        document.getElementById('openModalLink').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default link behavior
            myModal.show(); // Show modal again when link is clicked
        });
    });
</script>
<script>
    // Service History Chart
    var ctx = document.getElementById('serviceHistoryChart').getContext('2d');
    var serviceHistoryChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June'],
            datasets: [{
                label: 'Services Completed',
                data: [5, 3, 4, 7, 2, 6],
                borderColor: '#007bff',
                fill: false
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

    // Maintenance Pie Chart
    var ctx2 = document.getElementById('maintenancePieChart').getContext('2d');
    var maintenancePieChart = new Chart(ctx2, {
        type: 'pie',
        data: {
            labels: ['Oil Change', 'Tire Rotation', 'Brake Inspection', 'Battery Replacement'],
            datasets: [{
                data: [12, 15, 7, 5],
                backgroundColor: ['#007bff', '#28a745', '#ffc107', '#dc3545'],
            }]
        },
        options: {
            responsive: true
        }
    });
</script>
@endpush
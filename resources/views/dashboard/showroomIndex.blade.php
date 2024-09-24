@extends('layouts.dashboardlayout')
@section('title', 'Dashboard')
@section('breadcrumb1', $showroomName . ' Dashboard')
@section('breadcrumb', 'Home')
@section('pageTitle', $showroomName . ' Dashboard')
@section('content')


<div class="body-content">
    <div class="row">
        <div class="col-12">
            <div class="card widget-inline">
                <div class="card-body p-0">
                    <div class="row g-0">
                        <div class="col-sm-6 col-lg-3">
                            <div class="card shadow-none m-0">
                                <div class="card-body text-center">
                                    <i class="mdi mdi-car text-muted" style="font-size: 24px;"></i>
                                    <h3><span>{{ $vehicleCount ?? 0 }}</span></h3>
                                    <p class="text-muted font-15 mb-0">Total Vehicles</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-3">
                            <div class="card shadow-none m-0 border-start">
                                <div class="card-body text-center">
                                    <i class="dripicons-user text-muted" style="font-size: 24px;"></i>
                                    <h3><span>{{ $userCount ?? 0 }}</span></h3>
                                    <p class="text-muted font-15 mb-0">Total Owners</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-3">
                            <div class="card shadow-none m-0 border-start">
                                <div class="card-body text-center">
                                    <i class="dripicons-user-group text-muted" style="font-size: 24px;"></i>
                                    <h3><span>{{ $staffCount ?? 0 }}</span></h3>
                                    <p class="text-muted font-15 mb-0">Staff</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-3">
                            <div class="card shadow-none m-0 border-start">
                                <div class="card-body text-center">
                                    <i class="dripicons-graph-line text-muted" style="font-size: 24px;"></i>
                                    <h3><span>{{ $salesProductivityPercentage ?? 0 }}%</span> <i
                                            class="mdi mdi-arrow-up text-success"></i></h3>
                                    <p class="text-muted font-15 mb-0">Productivity</p>
                                </div>
                            </div>
                        </div>

                    </div> <!-- end row -->
                </div>
            </div> <!-- end card-box-->
        </div> <!-- end col-->
    </div>
    {{-- endrow --}}
    {{-- startrow --}}
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">Weekly Services Status</h4>
                    </div>

                    <div class="mt-3 mb-4 chartjs-chart" style="height: 207px;">
                        <canvas id="project-status-chartt"></canvas>
                    </div>

                    <div class="row text-center mt-2 py-2">
                        <div class="col-sm-4">
                            <div class="my-2 my-sm-0">
                                <i class="mdi mdi-trending-up text-success mt-3 h3"></i>
                                <h3 class="fw-normal">
                                    <span>{{ $completedPercentage }}%</span>
                                </h3>
                                <p class="text-muted mb-0">Completed</p>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="my-2 my-sm-0">
                                <i class="mdi mdi-trending-down text-primary mt-3 h3"></i>
                                <h3 class="fw-normal">
                                    <span>{{ $inProgressPercentage }}%</span>
                                </h3>
                                <p class="text-muted mb-0">Upcoming</p>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="my-2 my-sm-0">
                                <i class="mdi mdi-trending-down text-danger mt-3 h3"></i>
                                <h3 class="fw-normal">
                                    <span>{{ $upcomingPercentage }}%</span>
                                </h3>
                                <p class="text-muted mb-0">Pending</p>
                            </div>
                        </div>
                    </div>
                    <!-- end row-->

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
        {{-- service table --}}
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h4 class="header-title">Services</h4>
                    </div>

                    <p><b>{{ $completedServicesCount }}</b> Services completed</p>

                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap table-hover mb-0">
                            <tbody>
                                @foreach ($servicesForTable as $service)
                                <tr>
                                    <td>
                                        <h5 class="font-14 my-1"><a href="javascript:void(0);"
                                                class="text-body">VIN:
                                                {{ $service->vehicle ? $service->vehicle->vin : '-' }}</a></h5>
                                        <span
                                            class="text-muted font-13">{{ $service->vehicle ? $service->vehicle->owner->name : '-' }}</span>
                                    </td>
                                    <td>
                                        <span class="text-muted font-13">Status</span> <br />
                                        @if ($service->status == 'Pending')
                                        {{-- // check if data is pending then add in comming --}}
                                        <span class="badge badge-warning-lighten">In-progress</span>
                                        @else
                                        <span class="badge badge-info-lighten">Upcomming</span>
                                        @endif

                                    </td>
                                    <td>
                                        <span class="text-muted font-13">Assigned to</span>
                                        <h5 class="font-14 mt-1 fw-normal">Subhan</h5>
                                    </td>
                                    @if ($service->status == 'Upcoming')
                                    <td>
                                        <span class="text-muted font-13">Time</span>
                                        <h5 class="font-14 mt-1 fw-normal">
                                            {{ \Carbon\Carbon::parse($service->created_at)->format('H:i') }}
                                        </h5>
                                    </td>
                                    @else
                                    <td>
                                        <span class="text-muted font-13">Total Estimated Time</span>
                                        <h5 class="font-14 mt-1 fw-normal">
                                            {{ $service->estimated_completion_time ?? '-' }}
                                        </h5>
                                    </td>
                                    @endif
                                </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div> <!-- end table-responsive-->

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    <!-- end row-->
    <!-- start row-->
    <div class="row">
        {{-- Top 5 Customer --}}
        <div class="col-xl-6 col-lg-12 order-lg-2 order-xl-1">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h4 class="header-title">Top 5 Vehicles Per Month</h4>

                    </div>

                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap table-hover mb-0">

                            <tbody>
                                @foreach ($topVehicles as $vehicle)
                                <tr>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">{{ $vehicle->vin }}</h5>
                                        <span class="text-muted font-13">VIN</span>
                                    </td>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">{{ $vehicle->service_count }}</h5>
                                        <span class="text-muted font-13">Services</span>
                                    </td>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">{{ $vehicle->owner->name ?? 'N/A' }}
                                        </h5>
                                        <span class="text-muted font-13">Owner</span>
                                    </td>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">Rs{{ $vehicle->total_estimated_cost }}
                                        </h5>
                                        <span class="text-muted font-13">Cost</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> <!-- end table-responsive-->
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->
        {{-- End Top 5 Customer --}}
        {{-- top showroom chart --}}

        <div class="col-xl-3 col-lg-6 order-lg-1">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">Top Showrooms Services Per Month</h4>
                    </div>

                    <div id="top-showrooms-chart" class="chartjs-chart mb-4 mt-3" style="height: 207px;">
                        <canvas id="top-showrooms-bar-chart"></canvas>
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->
        {{-- End top showroom chart --}}
        {{-- recentActivity --}}
        <div class="col-xl-3 col-lg-6 order-lg-1">
            <div class="card">
                <div class="card-body pb-0">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h4 class="header-title">Recent Activities</h4>

                    </div>
                </div>

                <div class="card-body py-0" data-simplebar style="max-height: 405px;">
                    <div class="timeline-alt py-0">

                        {{-- Robert --}}
                        @foreach ($ShowroomActivitylogs as $log)
                        <div class="timeline-item">
                            <i class="mdi mdi-microphone bg-info-lighten text-info timeline-icon"></i>
                            <div class="timeline-item-info">
                                <a href="javascript:void(0);"
                                    class="text-info fw-bold mb-1 d-block">{{ $log->user ? $log->user->name : '-' }}</a>
                                <small>{{ $log->action ?? '-' }}
                                    {{-- <span class="fw-bold">"Are you there?"</span> --}}
                                </small>
                                <p class="mb-0 pb-2">
                                    <small class="text-muted">{{ $log->created_at->diffForHumans() }}</small>
                                </p>
                            </div>
                        </div>
                        @endforeach

                    </div>
                    <!-- end timeline -->
                </div> <!-- end slimscroll -->
            </div>
            <!-- end card-->
        </div>
        <!-- end col -->

    </div>
    <!-- end row -->

</div>

@endsection
@push('scripts')
<script>
    //2nd chart
    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('top-showrooms-bar-chart').getContext('2d');
        var topShowroomsData = @json($topShowrooms);

        var labels = topShowroomsData.map(showroom => showroom.shr_name);
        var data = topShowroomsData.map(showroom => showroom.service_count);

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Number of Services',
                    data: data,
                    backgroundColor: '#727cf5',
                    borderColor: '#727cf5',
                    borderWidth: 1
                }]
            },
            options: {
                maintainAspectRatio: false,
                scales: {
                    x: {
                        beginAtZero: true
                    },
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: true
                    }
                }
            }
        });
    });
    //1st chart
    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('project-status-chartt').getContext('2d');
        var data = {
            labels: ['Completed', 'Upcoming', 'Pending'],
            datasets: [{
                data: [{
                        {
                            $completedPercentage
                        }
                    }, {
                        {
                            $upcomingPercentage
                        }
                    },
                    {
                        {
                            $inProgressPercentage
                        }
                    }
                ],
                backgroundColor: ['#0acf97', '#727cf5', '#fa5c7c'],
                borderColor: 'transparent',
                borderWidth: 3
            }]
        };

        var options = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                    display: true
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            var label = context.label || '';
                            if (context.parsed > 0) {
                                label += ': ' + context.raw.toFixed(2) + '%';
                            }
                            return label;
                        }
                    }
                }
            }
        };

        new Chart(ctx, {
            type: 'doughnut', // Use 'pie' for a pie chart
            data: data,
            options: options
        });
    });
</script>
@endpush
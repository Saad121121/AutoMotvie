@extends('layouts.dashboardlayout')
@section('title', 'Dashboard')
@section('breadcrumb1', 'Dashboard')
@section('breadcrumb', 'Home')
@section('pageTitle', 'AutoMaker Dashboard')
@section('content')

<div class="body-content">
    <!-- <div class="row">
        <div class="col-lg-3 mt-2">
            <div class="card back-imge-color m-0">
                <div class="card-body p-0 text-center">
                    <a href="{{ route('dashboard') }}">
                        <div class="dash-logo">
                            <img src="{{ asset('storage/images/carlyti.png') }}" alt="">
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mt-2">
            <div class="card m-0 border-start">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="line"></div>
                        <a href="#" id="toggleLink">
                            <div class="center-point-img"><img src="{{ asset('storage/images/caricon.png') }}" alt=""></div>
                        </a>
                        <div class="line"></div>
                    </div>
                    <div id="myDiv" class="toggle-class">
                        <div class="cstm-div-nav">
                            <ul id="list">
                                <li class="list-anchar">
                                    <a href="#" onclick="showDiv('div1')">
                                        <div class="d-flex align-items-center">
                                            <div class="point-img"><img src="{{ asset('storage/images/bulletpoint.png') }}" alt=""></div>
                                            Dealer Management
                                            <i class="fas fa-angle-right ms-1"></i>
                                        </div>
                                    </a>
                                </li>
                                <li class="list-anchar">
                                    <a href="#" onclick="showDiv('div2')">
                                        <div class="d-flex align-items-center">
                                            <div class="point-img"><img src="{{ asset('storage/images/bulletpoint.png') }}" alt=""></div>
                                            Vehicle Management
                                            <i class="fas fa-angle-right ms-1"></i>
                                        </div>
                                    </a>
                                </li>
                                <li class="list-anchar">
                                    <a href="#" onclick="showDiv('div3')">
                                        <div class="d-flex align-items-center">
                                            <div class="point-img"><img src="{{ asset('storage/images/bulletpoint.png') }}" alt=""></div>
                                            Inventory Management
                                            <i class="fas fa-angle-right ms-1"></i>
                                        </div>
                                    </a>
                                </li>
                                <li class="list-anchar">
                                    <a href="#">
                                        <div class="d-flex align-items-center">
                                            <div class="point-img"><img src="{{ asset('storage/images/bulletpoint.png') }}" alt=""></div>
                                            Data Cam
                                            <i class="fas fa-angle-right ms-1"></i>
                                        </div>
                                    </a>
                                </li>
                                <li class="list-anchar">
                                    <a href="#">
                                        <div class="d-flex align-items-center">
                                            <div class="point-img"><img src="{{ asset('storage/images/bulletpoint.png') }}" alt=""></div>
                                            Data Analtics
                                            <i class="fas fa-angle-right ms-1"></i>
                                        </div>
                                    </a>
                                </li>
                                <li class="list-anchar">
                                    <a href="">
                                        <div class="d-flex align-items-center">
                                            <div class="point-img"><img src="{{ asset('storage/images/bulletpoint.png') }}" alt=""></div>
                                            Supplier Management
                                            <i class="fas fa-angle-right ms-1"></i>
                                        </div>
                                    </a>
                                </li>
                                <li class="list-anchar">
                                    <a href="{{ route('schedule-service') }}">
                                        <div class="d-flex align-items-center">
                                            <div class="point-img"><img src="{{ asset('storage/images/bulletpoint.png') }}" alt=""></div>
                                            Schedule Service
                                            <i class="fas fa-angle-right ms-1"></i>
                                        </div>
                                    </a>
                                </li>
                                <li class="list-anchar">
                                    <a href="#" onclick="showDiv('div4')">
                                        <div class="d-flex align-items-center">
                                            <div class="point-img"><img src="{{ asset('storage/images/bulletpoint.png') }}" alt=""></div>
                                            Reports
                                            <i class="fas fa-angle-right ms-1"></i>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                            <div class="cstm-nav-show">
                                <div id="div1" class="link-list">
                                    <ul class="inner-list">
                                        <li class="list-anchar">
                                            <a href="{{ route('showroom.index') }}">
                                                <div class="d-flex align-items-center">
                                                    <div class="point-img"><img src="{{ asset('storage/images/bulletpoint.png') }}" alt=""></div>
                                                    Add Dealer
                                                </div>
                                            </a>
                                        </li>
                                        <li class="list-anchar">
                                            <a href="{{ route('sales-performance') }}">
                                                <div class="d-flex align-items-center">
                                                    <div class="point-img"><img src="{{ asset('storage/images/bulletpoint.png') }}" alt=""></div>
                                                    Dealer Performance
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div id="div2" class="link-list">
                                    <ul>
                                        <li class="list-anchar">
                                            <a href="{{ route('vehicle.index') }}">
                                                <div class="d-flex align-items-center">
                                                    <div class="point-img"><img src="{{ asset('storage/images/bulletpoint.png') }}" alt=""></div>
                                                    Add Vehicle
                                                </div>
                                            </a>
                                        </li>
                                        <li class="list-anchar">
                                            <a href="vehicle-model.index">
                                                <div class="d-flex align-items-center">
                                                    <div class="point-img"><img src="{{ asset('storage/images/bulletpoint.png') }}" alt=""></div>
                                                    Vehicle Model
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div id="div3" class="link-list">
                                    <ul class="inner-list">
                                        <li class="list-anchar">
                                            <a href="{{ route('user.index') }}">
                                                <div class="d-flex align-items-center">
                                                    <div class="point-img"><img src="{{ asset('storage/images/bulletpoint.png') }}" alt=""></div>
                                                    Warehouse Inventory
                                                </div>
                                            </a>
                                        </li>
                                        <li class="list-anchar">
                                            <a href="{{ route('showInventory') }}">
                                                <div class="d-flex align-items-center">
                                                    <div class="point-img"><img src="{{ asset('storage/images/bulletpoint.png') }}" alt=""></div>
                                                    Inventory Stock
                                                </div>
                                            </a>
                                        </li>
                                        <li class="list-anchar">
                                            <a href="{{ route('accidents.index') }}">
                                                <div class="d-flex align-items-center">
                                                    <div class="point-img"><img src="{{ asset('storage/images/bulletpoint.png') }}" alt=""></div>
                                                    Stock Movement
                                                </div>
                                            </a>
                                        </li>
                                        <li class="list-anchar">
                                            <a href="">
                                                <div class="d-flex align-items-center">
                                                    <div class="point-img"><img src="{{ asset('storage/images/bulletpoint.png') }}" alt=""></div>
                                                    Inventory Valuation
                                                </div>
                                            </a>
                                        </li>
                                        <li class="list-anchar">
                                            <a href="{{ route('showInventorySupport') }}">
                                                <div class="d-flex align-items-center">
                                                    <div class="point-img"><img src="{{ asset('storage/images/bulletpoint.png') }}" alt=""></div>
                                                    Inventory Support
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div id="div4" class="link-list">
                                    <ul class="inner-list">
                                        <li class="list-anchar">
                                            <a href="{{ route('showroomReport') }}">
                                                <div class="d-flex align-items-center">
                                                    <div class="point-img"><img src="{{ asset('storage/images/bulletpoint.png') }}" alt=""></div>
                                                    Showroom Reports
                                                </div>
                                            </a>
                                        </li>
                                        <li class="list-anchar">
                                            <a href="{{ route('accidents.index') }}">
                                                <div class="d-flex align-items-center">
                                                    <div class="point-img"><img src="{{ asset('storage/images/bulletpoint.png') }}" alt=""></div>
                                                    Accidents Reports
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 mt-2">
            <div class="card m-0 border-start anchar-color">
                <a href="{{ route('showVirtualSupport') }}">
                    <div class="card-body text-center">
                        <div class="center-div-img">
                            <img src="{{ asset('storage/images/22hours.png') }}" alt="">
                        </div>
                        <h3 class="mt-3">Support Ticket</h3>
                    </div>
                </a>
            </div>
        </div>
    </div> -->

    <div class="row for-column-height mt-4">
        <div class="col-lg-4 col-md-6 mt-2 mb-2">
            <a href="{{ route('user.index') }}">
                <div class="card m-0 border-start card-zoom-image">
                    <div class="card-body text-center icon-img-card mt-2 mb-2">
                        <i class="fas fa-user-plus"></i>
                        <h4 class="mt-2 mb-0">+ Add Staff</h4>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-4 col-md-6 mt-2 mb-2">
            <a href="{{ route('suppliers.index') }}">
                <div class="card m-0 border-start card-zoom-image">
                    <div class="card-body text-center icon-img-card mt-2 mb-2">
                        <i class="fas fa-car"></i>
                        <h4 class="mt-2 mb-0">+ Add Supplier</h4>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-4 col-md-6 mt-2 mb-2">
            <a href="{{ route('purchase-orders.index') }}">
                <div class="card m-0 border-start card-zoom-image">
                    <div class="card-body text-center icon-img-card mt-2 mb-2">
                        <i class="fas fa-warehouse"></i>
                        <h4 class="mt-2 mb-0">Purchase Order </h4>
                    </div>
                </div>
            </a>
        </div>
        <!-- <div class="col-lg-3 col-md-6 mt-2 mb-2">
            <a href="#">
                <div class="card m-0 border-start card-zoom-image">
                    <div class="card-body text-center icon-img-card mt-2 mb-2">
                        <i class="fas fa-chart-line"></i>
                        <h4 class="mt-2 mb-0">Return And Defect</h4>
                    </div>
                </div>
            </a>
        </div> -->
    </div>

    <div class="row for-column-height mt-4">
        <div class="col-lg-3 col-md-6 mt-2 mb-2">
            <div class="card m-0 border-start card-zoom-image">
                <div class="card-body text-center cstm-car-card">
                    <h3>Add Dealer</h3>
                    <div class="car-center-img margin-scale-cstm">
                        <img src="{{ asset('storage/images/car1.png') }}" alt="">
                    </div>
                    <a href="{{ route('showroom.index') }}">
                        <button type="button" class="btn btn-primary"><i class="fas fa-plus"></i> Add dealer</button>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mt-2 mb-2">
            <div class="card m-0 border-start card-zoom-image">
                <div class="card-body text-center cstm-car-card">
                    <h3>Add Vehicle</h3>
                    <div class="car-center-img margin-scale-cstm">
                        <img src="{{ asset('storage/images/car2.png') }}" alt="">
                    </div>
                    <a href="{{ route('vehicle.index') }}">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createUserModal">+ Add Vehicle</button>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mt-2 mb-2">
            <div class="card m-0 border-start card-zoom-image anchar-color">
                <div class="card-body text-center cstm-car-card">
                    <!-- <h3 class="icon-border">------ <i class="fas fa-clipboard-list"></i> ------</h3> -->
                    <h3>Inventory Management</h3>
                    <div class="car-center-img margin-scale-cstm">
                        <img src="{{ asset('storage/images/car3.png') }}" alt="">
                    </div>
                    <a href="{{ route('showInventory') }}">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createUserModal">Inventory Management</button>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mt-2 mb-2">
            <div class="card m-0 border-start card-zoom-image">
                <div class="card-body text-center cstm-car-card">
                    <h3>Supplier</h3>
                    <div class="car-center-img margin-scale-cstm">
                        <img src="{{ asset('storage/images/car4.png') }}" alt="">
                    </div>
                    <a href="#">
                        <button type="button" class="btn btn-primary">View Suppliers</button>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mt-2 mb-2">
            <div class="card m-0 border-start card-zoom-image">
                <div class="card-body text-center cstm-car-card">
                    <h3>Data Cam</h3>
                    <div class="car-center-img margin-scale-cstm">
                        <img src="{{ asset('storage/images/camera.png') }}" alt="">
                    </div>
                    <!-- <a href="https://rtsp.me/embed/5GENiafB/" target="_blank">
                        <button type="button" class="btn btn-primary">Data cam</button>
                    </a> -->
                    <a href="{{ route('dataCamLogin.index') }}" target="_blank">
                            <button type="button" class="btn btn-primary">Data Cam</button>
                        </a>
                </div>
            </div>
        </div>
        <!-- <div class="col-lg-3 col-md-6 mt-2 mb-2">
            <div class="card m-0 border-start card-zoom-image">
                <div class="card-body text-center cstm-car-card">
                    <h3>Data Analytics</h3>
                    <div class="car-center-img margin-scale-cstm">
                        <img src="{{ asset('storage/images/DataAnalytics.png') }}" alt="">
                    </div>
                    <a href="#">
                        <button type="button" class="btn btn-primary">Data Analytics</button>
                    </a>
                </div>
            </div>
        </div> -->
        <!-- <div class="col-lg-3 col-md-6 mt-2 mb-2">
            <div class="card m-0 border-start card-zoom-image">
                <div class="card-body text-center cstm-car-card">
                    <h3>Report</h3>
                    <div class="car-center-img margin-scale-cstm">
                        <img src="{{ asset('storage/images/report.png') }}" alt="">
                    </div>
                    <a href="{{ route('showroomReport') }}">
                        <button type="button" class="btn btn-primary">View Reports</button>
                    </a>
                </div>
            </div>
        </div> -->
        <div class="col-lg-3 col-md-6 mt-2 mb-2">
            <div class="card m-0 border-start card-zoom-image">
                <div class="card-body text-center cstm-car-card">
                    <h3>Services</h3>
                    <div class="car-center-img margin-scale-cstm">
                        <img src="{{ asset('storage/images/servicesIcon.png') }}" alt="">
                    </div>
                    <a href="{{ route('services.index') }}">
                        <button type="button" class="btn btn-primary">View Services</button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-sm-6 col-lg-3 mt-2 mb-2">
            <div class="card shadow-none m-0">
                <div class="card-body text-center">
                    <i class="mdi mdi-car text-muted" style="font-size: 24px;"></i>
                    <h3><span>{{ $vehicleCount ?? 0 }}</span></h3>
                    <p class="text-muted font-15 mb-0">Total Vehicles</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3 mt-2 mb-2">
            <div class="card shadow-none m-0 border-start">
                <div class="card-body text-center">
                    <i class="dripicons-user text-muted" style="font-size: 24px;"></i>
                    <h3><span>{{ $userCount ?? 0 }}</span></h3>
                    <p class="text-muted font-15 mb-0">Total Owners</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3 mt-2 mb-2">
            <div class="card shadow-none m-0 border-start">
                <div class="card-body text-center">
                    <i class="dripicons-user-group text-muted" style="font-size: 24px;"></i>
                    <h3><span>{{ $staffCount ?? 0 }}</span></h3>
                    <p class="text-muted font-15 mb-0">Staff</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3 mt-2 mb-2">
            <div class="card shadow-none m-0 border-start">
                <div class="card-body text-center">
                    <i class="dripicons-graph-line text-muted" style="font-size: 24px;"></i>
                    <h3><span>{{ $salesProductivityPercentage ?? 0 }}%</span> <i
                            class="mdi mdi-arrow-up text-success"></i></h3>
                    <p class="text-muted font-15 mb-0">Productivity</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-lg-4 mt-2">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">Weekly Services Status</h4>
                        {{-- <div class="dropdown">
                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="mdi mdi-dots-vertical"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Weekly Report</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Monthly Report</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Settings</a>
                                </div>
                            </div> --}}
                    </div>

                    <div class="mt-3 mb-4 chartjs-chart" style="height: 207px;">
                        <canvas id="project-status-chart" data-colors="#0acf97,#727cf5,#fa5c7c"></canvas>
                    </div>

                    <div class="row text-center mt-2 py-2">
                        <div class="col-sm-4">
                            <div class="my-2 my-sm-0">
                                <i class="mdi mdi-trending-up text-success mt-3 h3"></i>
                                <h3 class="fw-normal">
                                    <span>64%</span>
                                </h3>
                                <p class="text-muted mb-0">Completed</p>
                            </div>

                        </div>
                        <div class="col-sm-4">
                            <div class="my-2 my-sm-0">
                                <i class="mdi mdi-trending-down text-primary mt-3 h3"></i>
                                <h3 class="fw-normal">
                                    <span>26%</span>
                                </h3>
                                <p class="text-muted mb-0"> Upcoming</p>
                            </div>

                        </div>
                        <div class="col-sm-4">
                            <div class="my-2 my-sm-0">
                                <i class="mdi mdi-trending-down text-danger mt-3 h3"></i>
                                <h3 class="fw-normal">
                                    <span>10%</span>
                                </h3>
                                <p class="text-muted mb-0"> Pending</p>
                            </div>

                        </div>
                    </div>
                    <!-- end row-->

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->

        <div class="col-lg-8 mt-2">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h4 class="header-title">Services</h4>
                        {{-- <div class="dropdown">
                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="mdi mdi-dots-vertical"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Weekly Report</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Monthly Report</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Settings</a>
                                </div>
                            </div> --}}
                    </div>

                    <p><b>107</b> Tasks completed out of 195</p>

                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap table-hover mb-0">
                            <tbody>
                                <tr>
                                    <td>
                                        <h5 class="font-14 my-1"><a href="javascript:void(0);" class="text-body">VIN:
                                                UYS990</a></h5>
                                        <span class="text-muted font-13">Peter</span>
                                    </td>
                                    <td>
                                        <span class="text-muted font-13">Status</span> <br />
                                        {{-- // check if data is pending then add in comming --}}
                                        <span class="badge badge-warning-lighten">In-progress</span>
                                    </td>
                                    <td>
                                        <span class="text-muted font-13">Assigned to</span>
                                        <h5 class="font-14 mt-1 fw-normal">Peter</h5>
                                    </td>
                                    <td>
                                        <span class="text-muted font-13">Total Estimated Time</span>
                                        <h5 class="font-14 mt-1 fw-normal">3h 20min</h5>
                                    </td>

                                </tr>
                                <tr>
                                    <td>
                                        <h5 class="font-14 my-1"><a href="javascript:void(0);" class="text-body">VIN:
                                                XYZ12367</a></h5>
                                        <span class="text-muted font-13">Robert</span>
                                    </td>
                                    <td>
                                        <span class="text-muted font-13">Status</span> <br />
                                        {{-- // check if data is pending then add in comming --}}
                                        <span class="badge badge-info-lighten">Upcomming</span>
                                    </td>
                                    <td>
                                        <span class="text-muted font-13">Assigned to</span>
                                        <h5 class="font-14 mt-1 fw-normal">Robert</h5>
                                    </td>
                                    {{-- jo upcoming hai un ke liye sirf time warna upr wala --}}
                                    <td>
                                        <span class="text-muted font-13">Time</span>
                                        <h5 class="font-14 mt-1 fw-normal">16:00</h5>
                                    </td>

                                </tr>



                            </tbody>
                        </table>
                    </div> <!-- end table-responsive-->

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>

    <div class="row">
        <div class="col-xl-6 col-lg-12 order-lg-2 order-xl-1 mt-2">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h4 class="header-title">Top 5 Customers Per Year</h4>
                        <!-- <a href="javascript:void(0);" class="btn btn-sm btn-link">Export <i
                                class="mdi mdi-download ms-1"></i></a> -->
                    </div>

                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap table-hover mb-0">
                            <tbody>
                                <tr>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">ABC12367</h5>
                                        <span class="text-muted font-13">VIN</span>
                                    </td>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">10</h5>
                                        <span class="text-muted font-13">Services</span>
                                    </td>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">David</h5>
                                        <span class="text-muted font-13">Owner</span>
                                    </td>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">$50,000</h5>
                                        <span class="text-muted font-13">Cost</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">XYZ12367</h5>
                                        <span class="text-muted font-13">VIN</span>
                                    </td>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">8</h5>
                                        <span class="text-muted font-13">Services</span>
                                    </td>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">John</h5>
                                        <span class="text-muted font-13">Owner</span>
                                    </td>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">$40,000</h5>
                                        <span class="text-muted font-13">Cost</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">UYS990</h5>
                                        <span class="text-muted font-13">VIN</span>
                                    </td>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">6</h5>
                                        <span class="text-muted font-13">Services</span>
                                    </td>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">Michel</h5>
                                        <span class="text-muted font-13">Owner</span>
                                    </td>
                                    <td>
                                        <h5 class="font-14 my-1 fw-normal">$30,000</h5>
                                        <span class="text-muted font-13">Cost</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div> <!-- end table-responsive-->
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->

        <div class="col-xl-3 col-lg-6 order-lg-1 mt-2">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">Top Showrooms Services Per day</h4>
                    </div>

                    <div id="average-sales" class="apex-charts mb-4 mt-3"
                        data-colors="#727cf5,#0acf97,#fa5c7c,#ffbc00"></div>


                    <div class="chart-widget-list">
                        <p>
                            <i class="mdi mdi-square text-primary"></i>Freedom Auto Center
                            <span class="float-end">15</span>
                        </p>
                        <p>
                            <i class="mdi mdi-square text-danger"></i> Pioneer Motors
                            <span class="float-end">8</span>
                        </p>
                        <p>
                            <i class="mdi mdi-square text-success"></i> Eagle Motors
                            <span class="float-end">4</span>
                        </p>
                        <p class="mb-0">
                            <i class="mdi mdi-square text-warning"></i> Valley Motors
                            <span class="float-end">12</span>
                        </p>
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->

        <div class="col-xl-3 col-lg-6 order-lg-1 mt-2">
            <div class="card">
                <div class="card-body pb-0">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h4 class="header-title">Recent Activity</h4>
                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Sales Report</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Profit</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Action</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body py-0" data-simplebar style="max-height: 405px;">
                    <div class="timeline-alt py-0">
                        <div class="timeline-item">
                            <i class="mdi mdi-upload bg-info-lighten text-info timeline-icon"></i>
                            <div class="timeline-item-info">
                                <a href="javascript:void(0);" class="text-info fw-bold mb-1 d-block">You sold an
                                    item</a>
                                <small>Paul Burgess just purchased “Hyper - Admin Dashboard”!</small>
                                <p class="mb-0 pb-2">
                                    <small class="text-muted">5 minutes ago</small>
                                </p>
                            </div>
                        </div>

                        <div class="timeline-item">
                            <i class="mdi mdi-airplane bg-primary-lighten text-primary timeline-icon"></i>
                            <div class="timeline-item-info">
                                <a href="javascript:void(0);" class="text-primary fw-bold mb-1 d-block">Product on the
                                    Bootstrap Market</a>
                                <small>Dave Gamache added
                                    <span class="fw-bold">Admin Dashboard</span>
                                </small>
                                <p class="mb-0 pb-2">
                                    <small class="text-muted">30 minutes ago</small>
                                </p>
                            </div>
                        </div>

                        <div class="timeline-item">
                            <i class="mdi mdi-microphone bg-info-lighten text-info timeline-icon"></i>
                            <div class="timeline-item-info">
                                <a href="javascript:void(0);" class="text-info fw-bold mb-1 d-block">Robert
                                    Delaney</a>
                                <small>Send you message
                                    <span class="fw-bold">"Are you there?"</span>
                                </small>
                                <p class="mb-0 pb-2">
                                    <small class="text-muted">2 hours ago</small>
                                </p>
                            </div>
                        </div>

                        <div class="timeline-item">
                            <i class="mdi mdi-upload bg-primary-lighten text-primary timeline-icon"></i>
                            <div class="timeline-item-info">
                                <a href="javascript:void(0);" class="text-primary fw-bold mb-1 d-block">Audrey
                                    Tobey</a>
                                <small>Uploaded a photo
                                    <span class="fw-bold">"Error.jpg"</span>
                                </small>
                                <p class="mb-0 pb-2">
                                    <small class="text-muted">14 hours ago</small>
                                </p>
                            </div>
                        </div>

                        <div class="timeline-item">
                            <i class="mdi mdi-upload bg-info-lighten text-info timeline-icon"></i>
                            <div class="timeline-item-info">
                                <a href="javascript:void(0);" class="text-info fw-bold mb-1 d-block">You sold an
                                    item</a>
                                <small>Paul Burgess just purchased “Hyper - Admin Dashboard”!</small>
                                <p class="mb-0 pb-2">
                                    <small class="text-muted">16 hours ago</small>
                                </p>
                            </div>
                        </div>

                        <div class="timeline-item">
                            <i class="mdi mdi-airplane bg-primary-lighten text-primary timeline-icon"></i>
                            <div class="timeline-item-info">
                                <a href="javascript:void(0);" class="text-primary fw-bold mb-1 d-block">Product on the
                                    Bootstrap Market</a>
                                <small>Dave Gamache added
                                    <span class="fw-bold">Admin Dashboard</span>
                                </small>
                                <p class="mb-0 pb-2">
                                    <small class="text-muted">22 hours ago</small>
                                </p>
                            </div>
                        </div>

                        <div class="timeline-item">
                            <i class="mdi mdi-microphone bg-info-lighten text-info timeline-icon"></i>
                            <div class="timeline-item-info">
                                <a href="javascript:void(0);" class="text-info fw-bold mb-1 d-block">Robert
                                    Delaney</a>
                                <small>Send you message
                                    <span class="fw-bold">"Are you there?"</span>
                                </small>
                                <p class="mb-0 pb-2">
                                    <small class="text-muted">2 days ago</small>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- end timeline -->
                </div> <!-- end slimscroll -->
            </div>
            <!-- end card-->
        </div>
        <!-- end col -->

    </div>

    <!-- swiper image slider start-->
    <div class="mt-4 mb-3">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="card black-slider border-start anchar-color">
                        <a type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <div class="card-body text-center">
                                <div class="car-center-img">
                                    <img src="{{ asset('storage/images/car1.png') }}" alt="">
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="card black-slider border-start anchar-color">
                        <a type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <div class="card-body text-center">
                                <div class="car-center-img">
                                    <img src="{{ asset('storage/images/car2.png') }}" alt="">
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="card black-slider border-start anchar-color">
                        <a type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <div class="card-body text-center">
                                <div class="car-center-img">
                                    <img src="{{ asset('storage/images/car3.png') }}" alt="">
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="card black-slider border-start anchar-color">
                        <a type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <div class="card-body text-center">
                                <div class="car-center-img">
                                    <img src="{{ asset('storage/images/car4.png') }}" alt="">
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="card black-slider border-start anchar-color">
                        <a type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <div class="card-body text-center">
                                <div class="car-center-img">
                                    <img src="{{ asset('storage/images/car5.png') }}" alt="">
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="card black-slider border-start anchar-color">
                        <a type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <div class="card-body text-center">
                                <div class="car-center-img">
                                    <img src="{{ asset('storage/images/car9.png') }}" alt="">
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="card black-slider border-start anchar-color">
                        <a type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <div class="card-body text-center">
                                <div class="car-center-img">
                                    <img src="{{ asset('storage/images/car7.png') }}" alt="">
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="card black-slider border-start anchar-color">
                        <a type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <div class="card-body text-center">
                                <div class="car-center-img">
                                    <img src="{{ asset('storage/images/car8.png') }}" alt="">
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- swiper image slider end-->


</div>

@endsection
@push('scripts')
<script>
    var swiper = new Swiper(".mySwiper", {
        //   slidesPerView: 5,
        spaceBetween: 10,
        loop: true,
        breakpoints: {
            640: {
                slidesPerView: 2,
            },
            768: {
                slidesPerView: 3,
            },
            1024: {
                slidesPerView: 4,
            },
            1300: {
                slidesPerView: 5,
            },
        },
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        }
    });
    document.addEventListener("DOMContentLoaded", function() {
        // Data for the pie chart
        const salesData = [500.56, 135.18, 48.96, 154.02];

        // Chart options
        const options = {
            series: salesData,
            chart: {
                type: 'pie',
                height: 350
            },
            labels: ['Freedom Auto Center', ' Pioneer Motors', 'Eagle Motors', 'Valley Motors'],
            colors: ['#727cf5', '#fa5c7c', '#0acf97', '#ffbc00'],
            legend: {
                position: 'bottom'
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };

        // Render the chart
        const chart = new ApexCharts(document.querySelector("#average-sales"), options);
        chart.render();
    });
</script>

<script>
    // document.getElementById('toggleLink').addEventListener('click', function(event) {
    //     event.preventDefault(); // Prevents the default anchor tag behavior (page reload)
    //     var div = document.getElementById('myDiv');
    //     div.classList.toggle('toggle-active-div'); // Toggle the 'active' class
    // });

    // function showDiv(divId) {
    //     // Hide all content divs
    //     const divs = document.querySelectorAll('.link-list');
    //     divs.forEach(div => div.classList.remove('active'));

    //     // Show the selected div
    //     const selectedDiv = document.getElementById(divId);
    //     selectedDiv.classList.add('active');
    // }
    // document.getElementById('showAdditional').addEventListener('click', function(event) {
    //     event.preventDefault(); // Prevents the default anchor tag behavior (page reload)
    //     var additionalDiv = document.getElementById('additionalDiv');
    //     additionalDiv.classList.toggle('active-second'); // Toggle the 'active' class
    // });
</script>
@endpush
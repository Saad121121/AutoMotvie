@extends('layouts.dashboardlayout')
@section('title', 'User Dashboard')
@section('breadcrumb1', 'User Dashboard')
@section('breadcrumb', 'Home')
@section('pageTitle', 'Dashboard')
@push('styles')
    <style>

    </style>
@endpush
@section('content')



    <div class="mt-4">

        <!-- Greeting Message -->
        <div class="alert alert-info text-center" role="alert">
            <h1>Welcome, {{ Auth::user()->name }}</h1>
        </div>
        <div class="row for-column-height mt-4">
            <div class="col-lg-4 col-md-6 mt-2 mb-2">
                <a href="{{ route('user.index') }}">
                    <div class="card m-0 border-start card-zoom-image">
                        <div class="card-body text-center icon-img-card mt-2 mb-2">
                            <i class="fas fa-user"></i>
                            <h4 class="mt-2 mb-0">Manage Dealer Staff</h4>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-6 mt-2 mb-2">
                <a href="{{ route('showInventory') }}">
                    <div class="card m-0 border-start card-zoom-image">
                        <div class="card-body text-center icon-img-card mt-2 mb-2">
                            <i class="fas fa-car"></i>
                            <h4 class="mt-2 mb-0">Vehicle Inventory</h4>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-6 mt-2 mb-2">
                <a href="{{ route('showroomReport') }}">
                    <div class="card m-0 border-start card-zoom-image">
                        <div class="card-body text-center icon-img-card mt-2 mb-2">
                            <i class="fas fa-clipboard-list"></i>
                            <h4 class="mt-2 mb-0">Dealer Report</h4>
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


    </div>



@endsection
@push('scripts')
    <script></script>
@endpush

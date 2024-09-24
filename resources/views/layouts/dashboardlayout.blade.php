
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>CARLYTI | @yield('title', 'Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('storage/images/carlyti-logo.png') }} ">

    <!-- App css -->
    <link href=" {{ asset('build/assets/css/style.css') }} " rel="stylesheet" type="text/css" />
    <link href=" {{ asset('build/assets/css/icons.min.css') }} " rel="stylesheet" type="text/css" />
    <link href="{{ asset('build/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />
    <!-- Include SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" rel="stylesheet" />
    {{-- new added --}}
    <link href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/vfs_fonts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>



    @stack('styles')
</head>

<body class="loading" data-layout-color="light" data-leftbar-theme="dark" data-layout-mode="fluid"
    data-rightbar-onstart="true">
    <!-- Begin page -->
    <div class="wrapper">
        <!-- ========== Left Sidebar Start ========== -->
        <div class="leftside-menu">

            <!-- LOGO -->
            <a href="{{ route('dashboard') }}" class="logo text-center logo-light">
                <span class="logo-lg">
                    <img src="{{ asset('storage/images/logo.png') }}" alt="" height="66">
                </span>
                <span class="logo-sm">
                    <img src="{{ asset('storage/images/logo.png') }}" alt="" height="46">
                </span>
            </a>

            <!-- LOGO -->
            <a href="{{ route('dashboard') }}" class="logo text-center logo-dark">
                <span class="logo-lg">
                    <img src="{{ asset('storage/images/logo.png') }}" alt="" height="16">
                </span>
                <span class="logo-sm">
                    <img src="{{ asset('storage/images/logo.png') }}" alt="" height="16">
                </span>
            </a>

            <div class="h-100" id="leftside-menu-container" data-simplebar>
                <!--- Sidemenu -->
                <ul class="side-nav">

                    {{-- <li class="side-nav-title side-nav-item">Navigation</li> --}}

                    {{-- <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#sidebarDashboards" aria-expanded="false"
                            aria-controls="sidebarDashboards" class="side-nav-link">
                            <i class="uil-home-alt"></i>
                           <span class="badge bg-success float-end">2</span>
                        <span> Dashboards </span>
                        </a>
                        <div class="collapse" id="sidebarDashboards">
                            <ul class="side-nav-second-level">

                                <li>
                                        <a href="{{ route('role.index') }}">Roles</a>
                    </li>


                </ul>
            </div>
            </li> --}}
            <!-- id 5 = company -->
            <li class="side-nav-item">
                <a href="{{ route('dashboard') }}" class="side-nav-link">
                    <i class="fas fa-home"></i>
                    <span>Home</span>
                </a>
            </li>
            @if (Auth::user()->role_id == 5)
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarautomaker" aria-expanded="false"
                    aria-controls="sidebarautomaker" class="side-nav-link">
                    <i class="fas fa-building"></i>
                    <span>Automaker</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarautomaker">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('customer') }}">Customers</a>
                        </li>
                        <li>
                            <a href="{{ route('suppliers.index') }}">Suppliers</a>
                        </li>
                        <li>
                            <a href="{{ route('sales.index') }}">Sales</a>
                        </li>
                        <li>
                            <a href="{{ route('promotions.index') }}">Promotions</a>
                        </li>
                    </ul>
                </div>
            </li>
            @endif
            @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2 || Auth::user()->role_id == 3 || Auth::user()->role_id == 5)
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarDealer" aria-expanded="false"
                    aria-controls="sidebarDealer" class="side-nav-link">
                    <i class="uil uil-shop"></i>
                    <span>Dealer Management</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarDealer">
                    <ul class="side-nav-second-level">
                        @if (Auth::user()->role_id == 5)
                        <li>
                            <a href="{{ route('showroom.index') }}">Manage Dealer</a>
                        </li>
                        @endif

                        <li>
                            <a href="{{ route('sales-performance') }}">Dealer Performance</a>
                        </li>
                        <li>
                            <a href="{{ route('userActivity.index') }}">Dealer Activity</a>
                        </li>
                        <li>
                            <a href="{{ route('user.index') }}">Manage Dealer Staff</a>
                        </li>

                        <li><a href="{{ route('showroomReport') }}">Dealer Reports</a></li>
                        <li>
                            <a href="{{ route('services.index') }}">Services</a>
                        </li>
                        <!-- <li>
                            <a href="{{ route('accidents.index') }}">Accidents</a>
                        </li> -->
                        <!-- <li><a href="{{ route('vehicle-make.index') }}">Vehicle Make</a></li>
                        <li><a href="{{ route('vehicle-model.index') }}">Vehicle Model</a></li>
                        <li><a href="{{ route('showroomReport') }}">Showroom Reports</a></li>
                        <li><a href="{{ route('showInventory') }}">Inventory</a></li>
                        <li><a href="{{ route('customer') }}">Customers</a></li> -->
                    </ul>
                </div>
            </li>
            {{-- vehicle manangement --}}
            <!-- for sub list -->
            @if (Auth::user()->role_id == 5)
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarvehicle" aria-expanded="false"
                    aria-controls="sidebarvehicle" class="side-nav-link">
                    <i class="mdi mdi-car"></i>
                    <span>Vehicle Management</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarvehicle">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('vehicle.index') }}">Add Vehicle</a>
                        </li>
                        <!-- <li>
                            <a href="{{ route('vehicle-model.index') }}">Vehicle Model</a>
                        </li>
                        <li>
                            <a href="{{ route('vehicle-make.index') }}">Vehicle Make</a>
                        </li> -->
                        <!-- <li><a href="{{ route('vehicle.index') }}">Vehicle</a></li> -->
                    </ul>
                </div>
            </li>
            @endif


            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarinventory" aria-expanded="false"
                    aria-controls="sidebarinventory" class="side-nav-link">
                    <i class="mdi mdi-crowd"></i>
                    <span>Inventory Management</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarinventory">
                    <ul class="side-nav-second-level">
                        <li><a href="{{ route('showInventory') }}">Vehicle Inventory</a></li>
                        <li><a href="{{ route('parts.index') }}">Parts</a></li>
                        @if (Auth::user()->role_id == 5)

                        <li><a href="{{ route('stocks.index') }}">Stock Movement</a></li>
                        <li><a href="{{ route('showInventorySupport') }}">Inventory Support</a></li>
                        <li><a href="{{ route('masterInventory') }}">Master Inventory</a></li>
                        <li><a href="{{ route('purchase-orders.index') }}">Purchase Order</a></li>

                        @endif

                    </ul>
                </div>
            </li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarSchedule" aria-expanded="false"
                    aria-controls="sidebarSchedule" class="side-nav-link">
                    <i class="fas fa-clipboard-list"></i>
                    <span>Schedule Service</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarSchedule">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('schedule-service') }}">Schedule</a>
                        </li>
                    </ul>
                </div>
            </li>
            {{-- support --}}
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarTicket" aria-expanded="false"
                    aria-controls="sidebarTicket" class="side-nav-link">
                    <i class="mdi mdi-account-cowboy-hat"></i>
                    <span>Support</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarTicket">
                    <ul class="side-nav-second-level">
                        <li><a href="{{ route('showVirtualSupport') }}">Virtual Support</a></li>
                    </ul>
                </div>
            </li>
            {{-- reports --}}
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarreports" aria-expanded="false"
                    aria-controls="sidebarreports" class="side-nav-link">
                    <i class="fas fa-chart-line"></i>
                    <span>Reports</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarreports">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('accidents.index') }}">Accident Report</a>
                        </li>
                        <li>
                            <a href="{{ route('showroomReport') }}">Dealer Reports</a>
                        </li>

                        <!-- <li><a href="{{ route('showVirtualSupport') }}">Virtual Support</a></li> -->
                    </ul>
                </div>
            </li>


            {{-- showroom manangement --}}
            <!-- <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarshowroom" aria-expanded="false"
                    aria-controls="sidebarshowroom" class="side-nav-link">
                    <i class="mdi mdi-crowd"></i>

                    <span> Dealer Management</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarshowroom">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('user.index') }}">Manage Dealer Staff</a>
                        </li>
                        <li>
                            <a href="{{ route('services.index') }}">Services</a>
                        </li>
                        <li>
                            <a href="{{ route('accidents.index') }}">Accidents</a>
                        </li>
                        <li><a href="#">Customers</a></li>

                    </ul>
                </div>
            </li> -->



            @if (Auth::user()->role_id == 5)
            {{-- company --}}
            <!-- <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarUser" aria-expanded="false"
                    aria-controls="sidebarUser" class="side-nav-link">
                    <i class="mdi mdi-crowd"></i>
                    <span>Company</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarUser">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('showroom.index') }}">Manage Dealer</a>
                        </li>
                        <li>
                            <a href="{{ route('userActivity.index') }}">Dealer Activity</a>
                        </li>
                        <li><a href="{{ route('vehicle-make.index') }}">Vehicle Make</a></li>
                        <li><a href="{{ route('vehicle-model.index') }}">Vehicle Model</a></li>
                        <li><a href="{{ route('showroomReport') }}">Showroom Reports</a></li>
                        <li><a href="{{ route('showInventory') }}">Inventory</a></li>
                        <li><a href="{{ route('customer') }}">Customers</a></li>
                    </ul>
                </div>
            </li> -->
            @endif

            <!-- id 4 = customer -->
            @if (Auth::user()->role_id==4)
            <li class="side-nav-item">
                <a href="{{ route('schedule-service') }}" class="side-nav-link">
                    <i class="fas fa-clipboard-list"></i>
                    <span>Schedule Service</span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{ route('schedule-service') }}" class="side-nav-link">
                    <i class="fas fa-chart-line"></i>
                    <span>Report Accident</span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="#" id="openModalLink" class="side-nav-link">
                    <i class="fas fa-award"></i>
                    <span>Promotion</span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{ route('tradein.index') }}" class="side-nav-link">
                    <i class="fas fa-chart-bar"></i>
                    <span>Trade In</span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{ route('schedule-service') }}" class="side-nav-link">
                    <i class="fas fa-warehouse"></i>
                    <span>Vehicle Inventory</span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{ route('accessories.index') }}" class="side-nav-link">
                    <i class="fas fa-toolbox"></i>
                    <span>Accessories</span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{ route('sellmycar') }}" class="side-nav-link">
                    <i class="fas fa-car"></i>
                    <span>Sell r</span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{ route('show') }}" class="side-nav-link">
                    <i class="fas fa-car"></i>
                    <span>Seller Details</span>
                </a>
            </li>


            @elseif (Auth::user()->role_id==3 || Auth::user()->role_id==4 )
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarcustomer" aria-expanded="false"
                    aria-controls="sidebarcustomer" class="side-nav-link">
                    <i class="mdi mdi-account-group"></i>
                    <span>Customer</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarcustomer">
                    <ul class="side-nav-second-level">
                        <!-- <li><a href="{{ route('customer') }}">Customers</a></li>
                        <li>
                            <a href="#">Dealer</a>
                        </li> -->
                        <li>
                            <a href="{{ route('schedule-service') }}">Schedule Service</a>
                        </li>
                        <li>
                            <a href="{{ route('accidents.index') }}">Accident Report</a>
                        </li>
                        <li>
                            <a href="#">Promotion </a>
                        </li>
                    </ul>
                </div>
            </li>
            @else
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarcustomer" aria-expanded="false"
                    aria-controls="sidebarcustomer" class="side-nav-link">
                    <i class="mdi mdi-account-group"></i>
                    <span>Customers</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarcustomer">
                    <ul class="side-nav-second-level">
                        <!-- <li><a href="{{ route('customer') }}">Customers</a></li>
                        <li>
                            <a href="#">Dealer</a>
                        </li> -->
                        <li>
                            <a href="{{ route('schedule-service') }}">Schedule Service</a>
                        </li>
                        <!-- <li>
                            <a href="{{ route('accidents.index') }}">Report Accident </a>
                        </li> -->
                        <li>
                            <a href="#">Promotion </a>
                        </li>
                        <li>
                            <a href="{{ route('tradein.index') }}">Trade In </a>
                        </li>
                        <li>
                            <a href="#">Vehicle Inventory </a> 
                            <!-- //yaha -->
                        </li>
                        <li>
                            <a href="{{ route('accessories.index') }}   ">Accessories</a>
                        </li>
                        <li>
                            <a href="{{route('sellmycar')}}">Sell Car</a>
                        </li>
                        <li>
                            <a href="{{route('show')}}">seller Details</a>
                        </li>
                        <li>
                            <a href="{{route('showToAll')}}">seller All</a>
                        </li>

                    </ul>
                </div>
            </li>
            @endif
            @endif
            {{-- Costomer manangement --}}
            @if (Auth::user()->role_id==4 )
            <li class="side-nav-item">
                <a href="{{ route('schedule-service') }}" class="side-nav-link">
                    <i class="fas fa-clipboard-list"></i>
                    <span>Schedule Service</span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{ route('schedule-service') }}" class="side-nav-link">
                    <i class="fas fa-chart-line"></i>
                    <span>Report Accident</span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="#" id="openModalLink" class="side-nav-link">
                    <i class="fas fa-award"></i>
                    <span>Promotion</span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{ route('tradein.index') }}" class="side-nav-link">
                    <i class="fas fa-chart-bar"></i>
                    <span>Trade In</span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{ route('schedule-service') }}" class="side-nav-link">
                    <i class="fas fa-warehouse"></i>
                    <span>Vehicle Inventory</span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{ route('accessories.index') }}" class="side-nav-link">
                    <i class="fas fa-toolbox"></i>
                    <span>Accessories</span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{ route('sellmycar') }}" class="side-nav-link">
                    <i class="fas fa-car"></i>
                    <span>Sell My Car</span>
                </a>
            </li>
            @endif


            </ul>

            <!-- End Sidebar -->
            <div class="clearfix"></div>

        </div>
        <!-- Sidebar -left -->

    </div>
    <!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <div class="content">
            <!-- Topbar Start -->
            <div class="navbar-custom  cstm-desktop-css">
                <div class="desktop-show">
                    <a href="{{ route('dashboard') }}">
                        <div class="navbar-logo">
                            <img src="{{ asset('storage/images/carlyti-logo.png') }}" alt="">
                        </div>
                    </a>
                </div>
                <div class="d-flex align-items-center">
                    <!-- <div class="cstm-navbar-link desktop-show pe-1">
                        <ul>
                            <li>
                                <a href="">
                                    <button type="submit" class="btn p-0 m-0 text-decoration-none cstm-logo-tag">
                                        AutoMaker Dashboard
                                    </button>
                                </a>
                            </li>
                            <li>
                                <a type="submit" href="javascript:void(0);">
                                    <form method="POST" action="{{ route('logout') }}"
                                        style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn p-0 m-0 text-decoration-none cstm-logo-tag">
                                            {{ __('Dealer Dashboard') }}
                                        </button>
                                    </form>
                                </a>
                            </li>
                            <li>
                                <a type="submit" href="javascript:void(0);">
                                    <form method="POST" action="{{ route('logout') }}"
                                        style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn p-0 m-0 text-decoration-none cstm-logo-tag">
                                            {{ __('Customer Dashboard') }}
                                        </button>
                                    </form>
                                </a>
                            </li>
                        </ul>
                    </div> -->
                    <ul class="list-unstyled topbar-menu float-end mb-0 pe-3">
                        <!-- <li class="dropdown notification-list">
                            <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#"
                                role="button" aria-haspopup="false" aria-expanded="false">
                                <i class="dripicons-bell noti-icon"></i>
                                <span class="noti-icon-badge"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg">
                                <div class="dropdown-item noti-title px-3">
                                    <h5 class="m-0">
                                        <span class="float-end">
                                            <a href="javascript: void(0);" class="text-dark">
                                                <small>Clear All</small>
                                            </a>
                                        </span>Notification
                                    </h5>
                                </div>
                                <div class="px-3" style="max-height: 300px;" data-simplebar>
                                    <h5 class="text-muted font-13 fw-normal mt-0">Today</h5>
                                    <a href="javascript:void(0);"
                                        class="dropdown-item p-0 notify-item card unread-noti shadow-none mb-2">
                                        <div class="card-body">
                                            <span class="float-end noti-close-btn text-muted"><i
                                                    class="mdi mdi-close"></i></span>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0">
                                                    <div class="notify-icon bg-primary">
                                                        <i class="mdi mdi-comment-account-outline"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 text-truncate ms-2">
                                                    <h5 class="noti-item-title fw-semibold font-14">Datacorp <small
                                                            class="fw-normal text-muted ms-1">1 min ago</small></h5>
                                                    <small class="noti-item-subtitle text-muted">Caleb Flakelar
                                                        commented on Admin</small>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="text-center">
                                        <i class="mdi mdi-dots-circle mdi-spin text-muted h3 mt-0"></i>
                                    </div>
                                </div>
                                <a href="javascript:void(0);"
                                    class="dropdown-item text-center text-primary notify-item border-top border-light py-2">
                                    View All
                                </a>

                            </div>
                        </li> -->

                        <li class="dropdown notification-list">
                            <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown"
                                href="javascript: void(0);" role="button" aria-expanded="false">
                                <span class="account-user-avatar">
                                    <img src="{{ Auth::user()->image ? asset('storage/users/' . Auth::user()->image) : asset('storage/build/assets/images/users/avatar-1.jpg') }}"
                                        alt="user-image" class="rounded-circle">
                                </span>
                                <span>
                                    <span class="account-user-name">{{ Auth::user()->name }}</span>
                                    <span class="account-position">{{ Auth::user()->email}}</span>
                                </span>
                            </a>
                            <div
                                class="dropdown-menu dropdown-menu-end  dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">Welcome!</h6>
                                </div>
                                <a href="{{ route('profile.edit') }}" class="dropdown-item notify-item">
                                    <i class="mdi mdi-account-circle me-1"></i>
                                    <span>My Account</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="mdi mdi-logout me-1"></i>
                                    <span>
                                        <form method="POST" action="{{ route('logout') }}"
                                            style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn p-0 m-0 text-decoration-none">
                                                {{ __('Log Out') }}
                                            </button>
                                        </form>
                                    </span>
                                </a>
                            </div>
                        </li>
                    </ul>
                    <button class="button-menu-mobile open-left">
                        <i class="mdi mdi-menu"></i>
                    </button>
                </div>


            </div>
            <!-- end Topbar -->

            <!-- Start Content-->
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Carlyti</a></li>
                                    <li class="breadcrumb-item active">@yield('breadcrumb1', 'Custom')</li>
                                    <li class="breadcrumb-item active">@yield('breadcrumb', 'Custom')</li>
                                </ol>
                            </div>
                            <h4 class="page-title">@yield('pageTitle', 'Custom')</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="main-content-dynamic">
                    @yield('content')
                </div>
                <!-- end row-->





            </div> <!-- container -->

        </div> <!-- content -->

        <!-- Footer Start -->
        <footer class="footer mt-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <script>
                            document.write(new Date().getFullYear())
                        </script> © ABitMuchCo.
                        &nbsp;
                        &nbsp;
                        &nbsp;
                        <b><a href="javascript:void(0);" data-bs-toggle="modal"
                                data-bs-target="#contactModal">Contact Us</a></b>
                    </div>
                    <!-- <div class="col-md-6">
                        <div class="text-md-end footer-links d-none d-md-block">
                            <a href="javascript: void(0);">About</a>
                            <a href="javascript: void(0);">Support</a>

                        </div>
                    </div> -->
                </div>
            </div>
        </footer>
        <!-- end Footer -->

    </div>
    {{-- ContactUsMOdal --}}
    <!-- Contact Modal -->
    <div class="modal fade" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="contactModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="contactModalLabel">Contact Us</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('send-contact') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" id="name" name="name" class="form-control"
                                placeholder="Your Name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control"
                                placeholder="Your Email" required>
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" id="subject" name="subject" class="form-control"
                                placeholder="Subject" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea id="message" name="message" class="form-control" rows="4" placeholder="Your Message" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- ContactUsMOdalEnd --}}
    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->


    </div>
    <!-- END wrapper -->

    <div class="rightbar-overlay"></div>
    <!-- /End-bar -->


    <!-- bundle -->
    <script src="{{ asset('build/assets/js/vendor.min.js') }}"></script>
    <script src="{{ asset('build/assets/js/app.min.js') }}"></script>
    <!-- demo app -->

    <!-- end demo js-->
    <!-- Include SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    {{-- new added --}}
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <!-- JSZip -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.8.0/jszip.min.js"></script>
    <!-- PDFMake -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/vfs_fonts.js"></script>
    <!-- DataTables Buttons HTML5 JS -->
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    {{-- Chartjs --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- plugin Chart js -->
    <script src="{{ asset('build/assets/js/vendor/demo.dashboard-projects.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>







    <!--Start of Tawk.to Script-->
    <!-- <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/66cd91daea492f34bc0a8765/1i69g3fr4';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script> -->
    <!--End of Tawk.to Script-->
    @stack('scripts')

</body>

</html>
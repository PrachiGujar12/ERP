<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title', 'ERP System')</title>
    <meta name="description" content="@yield('meta_description', '')">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <link rel="icon" href="{{asset('/asset/images/logo/fav.png')}}" sizes="32x32">

    <!-- bootstrap icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Custom fonts for this template-->
    <link href="{{asset('/asset/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">

    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('/asset/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('asset/css/custom-style.css')}}" />

    <!-- Table css -->
    <link href="{{asset('/asset/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar"
            style="height:100vh !important; overflow:scroll;">


            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('dashboard')}}">
                <div class="sidebar-brand-icon">
                    <img src="{{asset('asset/images/logo/logoh.png')}}" width="100px">
                </div>
                <!-- <div class="sidebar-brand-text mx-3" style="font-size:30px;">E R P</div> -->
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{route('dashboard')}}">
                    <i class="fas fa-fw fa-tachometer-alt fa-2x text-warning" style="
    font-size: 18px;
"></i>
                    <span style="
    font-size: 12px;
">Dashboard</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('online-dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{route('online-dashboard')}}">
                    <i class="fas fa-fw fa-tachometer-alt fa-2x text-warning" style="
    font-size: 18px;
"></i>
                    <span style="
    font-size: 12px;
">Online Dashboard</span>
                </a>
            </li>
            @if(strpos(Auth::user()->user_type, 'sale') !== false)
            <!-- Sidebar - Brand -->
            <li class="nav-item {{ request()->is('sales-list') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('sales-list') }}">
                    <i class="fas fa-file-invoice-dollar fa-2x text-warning" style="
    font-size: 18px;
"></i>

                    <span style="
    font-size: 12px;
">Sale</span>
                </a>
            </li>
            @endif

            @if(strpos(Auth::user()->user_type, 'quotation') !== false)
            <!-- Sidebar - Brand -->
            <li class="nav-item {{ request()->is('sales-quotation') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('sales-quotation') }}">
                    <i class="fas fa-file-alt fa-2x text-warning" style="font-size: 18px;"></i>
                    <span style="
    font-size: 12px;
">Estimate Quotation</span>
                </a>
            </li>
            @endif

            @if(strpos(Auth::user()->user_type, 'scrap-gold') !== false)
            <!-- Sidebar - Brand -->
            <li class="nav-item {{ request()->is('scrap-gold') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('scrap-gold') }}">
                    <i class="fas fa-cubes fa-2x text-warning" style="font-size: 18px;"></i>
                    <span style="font-size: 12px;">Scrap Gold</span>
                </a>
            </li>
            @endif

            @if(strpos(Auth::user()->user_type, 'repair-items') !== false)
            <!-- Repair Items -->
            <li class="nav-item {{ request()->is('order-list') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('order-list') }}">
                    <i class="fas fa-receipt fa-2x text-warning" style="font-size: 18px;"></i>
                    <span style="font-size: 12px;">Orders</span>
                </a>
            </li>
            @endif

            @if(strpos(Auth::user()->user_type, 'customer') !== false)
            <!-- Sidebar - Brand -->
            <li class="nav-item {{ request()->is('customers-list') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('customers-list') }}">

                    <i class="fas fa-users fa-2x text-warning" style="font-size: 18px;"></i>
                    <span style="font-size: 12px;">Customers</span>
                </a>
            </li>
            @endif

            @if(strpos(Auth::user()->user_type, 'stock') !== false)

            <!-- Location -->
            <li class="nav-item {{ request()->is('locations-list') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('locations-list') }}">
                    <i class="bi bi-geo-alt-fill text-warning"></i>
                    <span>Location</span>
                </a>
            </li>

            <!-- Sub Location -->
            <li class="nav-item {{ request()->is('sub-locations-list') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('sub-locations-list') }}">
                    <i class="bi bi-geo-alt-fill text-warning"></i>
                    <span>Sub Location</span>
                </a>
            </li>

            <!-- Catgeories -->
            <li class="nav-item {{ request()->is('categories-list') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('categories-list') }}">
                    <i class="fas fa-box text-warning"></i>
                    <span style="font-size: 12px;">Item Categories</span>
                </a>
            </li>

            <!-- Catgeories size-->
            <li class="nav-item {{ request()->is('categories-size-list') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('categories-size-list') }}">
                    <i class="bi bi-bounding-box-circles text-warning"></i>
                    <span style="font-size: 12px;">Categories Size</span>
                </a>
            </li>

            <!-- Catgeories shape-->
            <li class="nav-item {{ request()->is('categories-shape-list') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('categories-shape-list') }}">
                    <i class="fas fa-shapes text-warning"></i>
                    <span style="font-size: 12px;">Categories Shape</span>
                </a>
            </li>

            <!-- Catgeories shape-->
            <li class="nav-item {{ request()->is('diamond-type-list') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('diamond-type-list') }}">
                    <i class="fas fa-gem text-warning"></i>
                    <span style="font-size: 12px;">Diamond Type</span>
                </a>
            </li>

            <!-- Catgeories shape-->
            <li class="nav-item {{ request()->is('diamond-shape-list') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('diamond-shape-list') }}">
                    <i class="fas fa-gem text-warning"></i>
                    <span style="font-size: 12px;">Diamond Shape</span>
                </a>
            </li>

            <!-- Item Type  -->
            <li class="nav-item {{ request()->is('item-type-list') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('item-type-list') }}">
                    <i class="fas fa-box text-warning"></i>
                    <span style="font-size: 12px;">Metal Type</span>
                </a>
            </li>

            <!-- Stock Items -->
            <li class="nav-item {{ request()->is('items-list') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('items-list') }}">
                    <i class="fas fa-boxes fa-2x text-warning" style="font-size: 18px;"></i>
                    <span style="font-size: 12px;">Stock</span>
                </a>
            </li>

            <!-- Stock Filling -->
            <li class="nav-item {{ request()->is('stock-filling') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('stock-filling') }}">
                    <i class="fas fa-boxes fa-2x text-warning"></i>
                    <span>Stock Filling</span>
                </a>
            </li>

            <li class="nav-item {{ request()->is('stock-adjustment-list') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('stock-adjustment-list') }}">
                    <i class="fas fa-boxes fa-2x text-warning"></i>
                    <span>Stock Transfer</span>
                </a>
            </li>

            @endif



            @if(strpos(Auth::user()->user_type, 'purchase') !== false)

            <li class="nav-item {{ request()->is('purchase-list') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('purchase-list') }}">
                    <i class="fa fa-tools fa-2x text-warning"></i>
                    <span>Purchase List</span>
                </a>
            </li>
            @endif

            @if(strpos(Auth::user()->user_type, 'staff') !== false)

            <li class="nav-item {{ request()->routeIs('staff.index', 'staff.create') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('staff.index') }}">
                    <i class="bi bi-person-workspace text-warning"></i>
                    <span>Staff</span>
                </a>
            </li>
            @endif

            @if(strpos(Auth::user()->user_type, 'karigar') !== false)

            <li class="nav-item {{ request()->is('karigar-list') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('karigar-list') }}">
                    <i class="fa fa-tools fa-2x text-warning"></i>
                    <span>Karigar List</span>
                </a>
            </li>
            @endif

            @if(strpos(Auth::user()->user_type, 'supplier') !== false)

            <li class="nav-item {{ request()->is('supplier-list') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('supplier-list') }}">
                    <i class="fa fa-truck fa-2x text-warning"></i>
                    <span>Supplier List</span>
                </a>
            </li>
            @endif

            <!-- @if(strpos(Auth::user()->user_type, 'rates') !== false)
            <li class="nav-item {{ request()->is('metal-rates-list') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('metal-rates-list') }}">
                    <i class="fas fa-users"></i>
                    <span>Metal Rates</span>
                </a>
            </li>
            @endif
			-->
            @if(strpos(Auth::user()->user_type, 'ncsale') !== false)
            <li class="nav-item {{ request()->is('nc-sales-list') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('nc-sales-list') }}">
                    <i class="fas fa-file-invoice fa-2x text-warning" style="font-size: 18px;"></i>
                    <span style="font-size: 12px;">NC Sale</span>
                </a>
            </li>
            @endif
            <li class="nav-item {{ request()->is('nc-sales-list') ? 'active' : '' }}">
                <a class="nav-link" href="{{route('profile.edit')}}">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-warning" style="font-size: 18px;"></i>
                    <span style="font-size: 12px;">Profile</span>
                </a>
            </li>
            <li class="nav-item {{ request()->is('nc-sales-list') ? 'active' : '' }}">
                <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-warning" style="font-size: 18px;"></i>
                    <span style="font-size: 12px;">Logout</span>
                </a>
            </li>
            <li class="nav-item {{ request()->is('nc-sales-list') ? 'active' : '' }}">
                <a class="nav-link">

                    <span style="font-size: 12px;">{{ Auth::user()->name }}</span>
                </a>
            </li>


            <div class="text-center d-md-inline" style="display:none !important">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column" style="height:100vh; overflow:scroll;">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav
                    class="navbar navbar-expand navbar-light bg-dark text-light topbar static-top shadow d-block d-md-none">

                    <!--      <a class="navbar-brand" href="#">
        <img src="{{asset('asset/images/logo/logoh.png')}}" alt="Logo" style="height:60px" class="w-100">
    </a> -->

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <!-- <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-secondary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form> -->

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-light small">{{ Auth::user()->name }}</span>
                                <img class="img-profile rounded-circle" src="{{asset('asset/img/logo/user.png')}}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{route('profile.edit')}}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <!-- <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a> -->
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                @yield('content')

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer p-3 bg-dark">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto text-light">
                        <p>Copyright &copy; Designed & Developed by <a class="text-decoration-none text-light"
                                target="_blank" href="https://webwideit.solutions">webwideit.solutions</a> 2024</p>
                    </div>
                </div>
            </footer>

            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <a class="btn btn-primary" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </a>
                    </form>

                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap core JavaScript-->

    <script src="{{asset('/asset/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('/asset/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('/asset/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('/asset/js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{asset('/asset/vendor/chart.js/Chart.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('/asset/js/demo/chart-area-demo.js')}}"></script>



    <!-- table js -->
    <script src="{{asset('/asset/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('/asset/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('/asset/js/demo/datatables-demo.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    setTimeout(function() {
        let alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            alert.style.transition = "opacity 0.5s ease";
            alert.style.opacity = "0";
            setTimeout(function() {
                alert.remove();
            }, 500); // Ensure it's removed from the DOM after fade out
        });
    }, 2000);
    </script>
    <script>
    // Add an event listener to all input fields with type="date" to show the date picker
    document.querySelectorAll('input[type="date"]').forEach(function(dateInput) {
        dateInput.addEventListener('click', function() {
            this.showPicker(); // Show date picker when any date input is clicked
        });
    });
    </script>
</body>

</html>
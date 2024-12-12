@extends('layouts.dashboard')
@section('title', 'All Users')
@section('meta_description', 'System user list.')
@section('content')


<!-- Main Content -->
<div id="content">

    

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
          
        </div>
        <!-- Content Row -->
        <div class="row Dashboard__navigation__card">
            <!-- Customer Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="{{url('customers-list')}}">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body align-content-center">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">
                                        Customer
                                    </div>
                                 
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-user fa-2x text-warning"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Customer Due  Accounts Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="due-account.html">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body align-content-center">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">
                                        Due Accounts
                                    </div>
                                    <!-- <div class="h5 mb-0 font-weight-bold text-gray-800">
                            $215,000
                          </div> -->
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-money-bill fa-2x text-warning"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Order Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="order.html">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body align-content-center">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">
                                        Order
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-shopping-cart fa-2x text-warning"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Sale Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="sale.html">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body align-content-center">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">
                                        Sale
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-tag fa-2x text-warning"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <!-- supplier Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="{{url('supplier-list')}}">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body align-content-center">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">
                                        supplier
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-wrench fa-2x text-warning"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Karigar Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="karagir-list">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body align-content-center">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">
                                        Karigar
                                    </div>
                                    <!-- <div class="h5 mb-0 font-weight-bold text-gray-800">
                            $40,000
                          </div> -->
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-wrench fa-2x text-warning"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Estimate Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body align-content-center">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">
                                    Estimate
                                </div>
                                <!-- <div class="h5 mb-0 font-weight-bold text-gray-800">
                          $215,000
                        </div> -->
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-file-alt fa-2x text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Valuations Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body align-content-center">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">
                                    Valuations
                                </div>
                                <!-- <div class="row no-gutters align-items-center">
                          <div class="col-auto">
                            <div
                              class="h5 mb-0 mr-3 font-weight-bold text-gray-800"
                            >
                              50%
                            </div>
                          </div>
                          <div class="col">
                            <div class="progress progress-sm mr-2">
                              <div
                                class="progress-bar bg-info"
                                role="progressbar"
                                style="width: 50%"
                                aria-valuenow="50"
                                aria-valuemin="0"
                                aria-valuemax="100"
                              ></div>
                            </div>
                          </div>
                        </div> -->
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-balance-scale fa-2x text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reports Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body align-content-center">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">
                                    Reports
                                </div>
                                <!-- <div class="h5 mb-0 font-weight-bold text-gray-800">
                          18
                        </div> -->
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-chart-bar fa-2x text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Stock Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="items-list">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body align-content-center">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">
                                        Stock
                                    </div>
                                    <!-- <div class="h5 mb-0 font-weight-bold text-gray-800">
                          18
                        </div> -->
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-boxes fa-2x text-warning"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Stock Movement Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="{{ url('stock-adjustment-list') }}">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body align-content-center">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">
                                        Stock Movement
                                    </div>
                                    <!-- <div class="h5 mb-0 font-weight-bold text-gray-800">
                          18
                        </div> -->
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calculator fa-2x text-warning"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Employess Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="staff-list">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body align-content-center">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">
                                        Staff
                                    </div>

                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-warning"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Item Catgeory Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="categories-list">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body align-content-center">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">
                                        Item Category
                                    </div>

                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-warning"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Item Location Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="locations-list">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body align-content-center">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">
                                        Item Location
                                    </div>

                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-boxes fa-2x text-warning"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Item Sub Location Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="sub-locations-list">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body align-content-center">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">
                                        Item Sub Location
                                    </div>

                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-boxes fa-2x text-warning"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Metal Rate Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="metal-rates-list">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body align-content-center">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">
                                        Metal Rate
                                    </div>

                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-boxes fa-2x text-warning"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

        </div>
        <!-- Content Row -->
        <!-- Content Row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

@endsection
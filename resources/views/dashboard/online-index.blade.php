@extends('layouts.dashboard')
@section('title', 'ERP Admin Online Dashboard')
@section('meta_description', 'System Dashboard.')
@section('content')
<!-- Begin Page Content -->

<div class="container-fluid">
    <div id="content">
        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800 mt-3">ONLINE DASHBOARD</h1>
                <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-download fa-sm text-white-50"></i> Generate
                    Report</a> -->
            </div>
            <!-- Content Row -->
            <div class="row Dashboard__navigation__card">

                <!-- Product Catgeory Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <a href="{{url('online-customers-list')}}">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body align-content-center">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">
                                            Customers
                                        </div>

                                    </div>
                                    <div class="col-auto">
                                        <img src="{{asset('asset/images/icon/Customers.png')}}" alt="" class="img-fluid"
                                            width="40px">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Product Catgeory Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <a href="{{url('product-categories')}}">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body align-content-center">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">
                                            Product Category
                                        </div>

                                    </div>
                                    <div class="col-auto">
                                        <img src="{{asset('asset/images/icon/Customers.png')}}" alt="" class="img-fluid"
                                            width="40px">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Product Attribute Card Module -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <a href="{{url('product-attribute-list')}}">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body align-content-center">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">
                                            Product Attribute
                                        </div>

                                    </div>
                                    <div class="col-auto">
                                        <img src="{{asset('asset/images/icon/Customers.png')}}" alt="" class="img-fluid"
                                            width="40px">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Product Attribute Card Module -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <a href="{{url('product-list')}}">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body align-content-center">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">
                                            Products
                                        </div>

                                    </div>
                                    <div class="col-auto">
                                        <img src="{{asset('asset/images/icon/Customers.png')}}" alt="" class="img-fluid"
                                            width="40px">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Product Attribute Card Module -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <a href="{{url('media')}}">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body align-content-center">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">
                                            Media
                                        </div>

                                    </div>
                                    <div class="col-auto">
                                        <img src="{{asset('asset/images/icon/Customers.png')}}" alt="" class="img-fluid"
                                            width="40px">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Tax Card Module -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <a href="{{url('tax-list')}}">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body align-content-center">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">
                                            Taxes
                                        </div>

                                    </div>
                                    <div class="col-auto">
                                        <img src="{{asset('asset/images/icon/Customers.png')}}" alt="" class="img-fluid"
                                            width="40px">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Discount Card Module -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <a href="{{url('discount-list')}}">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body align-content-center">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">
                                            Discount
                                        </div>

                                    </div>
                                    <div class="col-auto">
                                        <img src="{{asset('asset/images/icon/Customers.png')}}" alt="" class="img-fluid"
                                            width="40px">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                  <!-- Orders Card Module -->
                  <div class="col-xl-3 col-md-6 mb-4">
                    <a href="{{url('online-orders-list')}}">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body align-content-center">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">
                                            Online Orders
                                        </div>

                                    </div>
                                    <div class="col-auto">
                                        <img src="{{asset('asset/images/icon/Customers.png')}}" alt="" class="img-fluid"
                                            width="40px">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Blogs Card Module -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <a href="{{url('blogs-list')}}">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body align-content-center">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">
                                            Blogs
                                        </div>

                                    </div>
                                    <div class="col-auto">
                                        <img src="{{asset('asset/images/icon/Customers.png')}}" alt="" class="img-fluid"
                                            width="40px">

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
</div>
<!-- /.container-fluid -->

@endsection
@extends('layouts.dashboard')
@section('title', 'ERP Admin Dashboard')
@section('meta_description', 'System Dashboard.')
@section('content')
<!-- Begin Page Content -->
 
<div class="container-fluid">
    <div id="content">
        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800 mt-3">DASHBOARD</h1>
                <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-download fa-sm text-white-50"></i> Generate
                    Report</a> -->
            </div>
            <!-- Content Row -->
            <div class="row Dashboard__navigation__card">

            @if(strpos(Auth::user()->user_type, 'customer') !== false)
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
                                        <!-- <div class="h5 mb-0 font-weight-bold text-gray-800">
                        $40,000
                      </div> -->
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

                <div class="col-xl-3 col-md-6 mb-4">
                    <a href="{{url('due-customers-list')}}">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body align-content-center">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">
                                            Due Accounts
                                        </div>
                                        <!-- <div class="h5 mb-0 font-weight-bold text-gray-800">
                        $40,000
                      </div> -->
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
					
				@endif
                @if(strpos(Auth::user()->user_type, 'repair-items') !== false)

                <!-- Repair Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <a href="{{ url('order-list') }}">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body align-content-center">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">
                                           Order
                                        </div>

                                    </div>
                                    <div class="col-auto">
                                        <img src="{{asset('asset/images/icon/order.png')}}" alt="" class="img-fluid"
                                            width="40px">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
				
				<div class="col-xl-3 col-md-6 mb-4">
                    <a href="{{ url('repair-order-list') }}">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body align-content-center">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">
                                          Repair Order
                                        </div>

                                    </div>
                                    <div class="col-auto">
                                        <img src="{{asset('asset/images/icon/order.png')}}" alt="" class="img-fluid"
                                            width="40px">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endif

				@if(strpos(Auth::user()->user_type, 'sale') !== false)
                <!-- Sale Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <a  href="{{ url('sales-list') }}">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body align-content-center">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">
                                            Sale
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <img src="{{asset('asset/images/icon/Sale.png')}}" alt="" class="img-fluid"
                                            width="40px">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endif

                @if(strpos(Auth::user()->user_type, 'supplier') !== false)
                <!-- supplier Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <a href="{{url('supplier-list')}}">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body align-content-center">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">
                                            Supplier
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                       <img src="{{asset('asset/images/icon/supplier.png')}}" alt="" class="img-fluid"
                                            width="40px">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <a href="{{url('/karigar-list')}}">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body align-content-center">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">
                                            Karigar


                                        </div>
                                    </div>
                                    <div class="col-auto">
                                       <img src="{{asset('asset/images/icon/Karagir.png')}}" alt="" class="img-fluid"
                                            width="40px">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Estimate Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
					 <a href="{{ url('sales-quotation') }}">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body align-content-center">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">
                                        Estimate Quotation
                                    </div>
                                    <!-- <div class="h5 mb-0 font-weight-bold text-gray-800">
                      $215,000
                    </div> -->
                                </div>
                                <div class="col-auto">
                                    <img src="{{asset('asset/images/icon/budget.png')}}" alt="" class="img-fluid"
                                            width="40px">
                                </div>
                            </div>
                        </div>
                    </div>
						 </a>
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
                                    
                                </div>
                                <div class="col-auto">
                                    <img src="{{asset('asset/images/icon/Valuation.png')}}" alt="" class="img-fluid"
                                            width="40px">
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
                                    <img src="{{asset('asset/images/icon/Reports.png')}}" alt="" class="img-fluid"
                                            width="40px">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @endif

                <!-- @if(strpos(Auth::user()->user_type, 'staff') !== false) -->
                <!-- Employess Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <a href="{{route('stock.item')}}">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body align-content-center">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">
                                            Stock
                                        </div>

                                    </div>
                                    <div class="col-auto">
                                        <img src="{{asset('asset/images/icon/Stock.png')}}" alt="" class="img-fluid"
                                            width="40px">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

				
				

                <div class="col-xl-3 col-md-6 mb-4">
                    <a href="#">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body align-content-center">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">
                                            Accounting
                                        </div>

                                    </div>
                                    <div class="col-auto">
                                        <img src="{{asset('asset/images/icon/customeraccount.png')}}" alt="" class="img-fluid"
                                            width="40px">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <a href="{{route('staff.index')}}">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body align-content-center">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">
                                        Employees
                                        </div>

                                    </div>
                                    <div class="col-auto">
                                        <img src="{{asset('asset/images/icon/employs.png')}}" alt="" class="img-fluid"
                                            width="40px">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endif

                

                <!-- @if(strpos(Auth::user()->user_type, 'purchase') !== false) -->
                <!-- Employess Card Example -->
                <!-- <div class="col-xl-3 col-md-6 mb-4">
                    <a href="{{url('purchase-list')}}">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body align-content-center">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">
                                            Purchase
                                        </div>

                                    </div>
                                    <div class="col-auto">
                                        <img src="{{asset('asset/images/icon/employs.png')}}" alt="" class="img-fluid"
                                            width="40px">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endif -->
                

               
                <!-- @if(strpos(Auth::user()->user_type, 'karigar') !== false) -->
                <!-- karigar Card Example -->
                <!-- <div class="col-xl-3 col-md-6 mb-4">
                    <a href="karigar-list">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body align-content-center">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">
                                            Karigar
                                        </div> -->
                                        <!-- <div class="h5 mb-0 font-weight-bold text-gray-800">
                        $40,000
                      </div> -->
                                    <!-- </div>
                                    <div class="col-auto">
                                        <i class="fas fa-wrench fa-2x text-warning"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endif -->

                


                <!-- @if(strpos(Auth::user()->user_type, 'stock') !== false) -->

                <!-- Item Location Card Example -->
                <!-- <div class="col-xl-3 col-md-6 mb-4">
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
                                        										<i class="bi bi-geo-alt-fill text-warning"></i>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <a href="{{ url('sub-locations-list') }}">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body align-content-center">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">
                                            Sub Location
                                        </div>

                                    </div>
                                    <div class="col-auto">
										<i class="bi bi-geo-alt text-warning"></i>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div> -->

                <!-- Item Catgeory Card Example -->
                <!-- <div class="col-xl-3 col-md-6 mb-4">
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
                </div> -->

                <!-- Item Type Card Example -->
                <!-- <div class="col-xl-3 col-md-6 mb-4">
                    <a href="{{url('item-type-list')}}">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body align-content-center">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">
                                            Item Type
                                        </div>

                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-users fa-2x text-warning"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div> -->

			
                <!-- Stock Item Card Example -->
                <!-- <div class="col-xl-3 col-md-6 mb-4">
                    <a href="items-list">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body align-content-center">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">
                                            Stock Items
                                        </div> -->
                                        <!-- <div class="h5 mb-0 font-weight-bold text-gray-800">
                      18
                    </div> -->
                                    <!-- </div>
                                    <div class="col-auto">
                                        <i class="fas fa-boxes fa-2x text-warning"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div> -->
				
					<!-- Stock Filling Card Example -->
                <!-- <div class="col-xl-3 col-md-6 mb-4">
                    <a href="{{ url('stock-filling') }}">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body align-content-center">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">
                                            Stock Filling
                                        </div>

                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-boxes fa-2x text-warning"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div> -->




               <!-- <div class="col-xl-3 col-md-6 mb-4">
                    <a href="{{ url('stock-adjustment-list') }}">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body align-content-center">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">
                                            Transfer Stock
                                        </div>
                                        <!-- <div class="h5 mb-0 font-weight-bold text-gray-800">
                      18
                    </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-calculator fa-2x text-warning"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div> -->
                <!-- @endif -->
				
				  <!-- @if(strpos(Auth::user()->user_type, 'repair-items') !== false) -->

                <!-- Repair Card Example -->
                <!-- <div class="col-xl-3 col-md-6 mb-4">
                    <a href="{{ url('repair-items-list') }}">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body align-content-center">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">
                                           Repair Items
                                        </div>

                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-geo-alt-fill text-warning"></i>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endif -->

                <!-- @if(strpos(Auth::user()->user_type, 'rates') !== false) -->
                <!-- Metal Rate Card Example -->
                <!-- <div class="col-xl-3 col-md-6 mb-4">
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
                @endif -->
				
				<!-- @if(strpos(Auth::user()->user_type, 'sale') !== false) -->
                <!-- Jewellery Sale Card Example -->
                <!-- <div class="col-xl-3 col-md-6 mb-4">
                    <a href="{{ url('sales-list') }}">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body align-content-center">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">
                                            Jewellery Sale
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
                @endif -->

                <!-- @if(strpos(Auth::user()->user_type, 'scrap-gold') !== false) -->
                <!-- Scrap Gold Card Example -->
                <!-- <div class="col-xl-3 col-md-6 mb-4">
                    <a href="{{ url('scrap-gold') }}">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body align-content-center">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">
                                        Scrap Gold
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
                @endif -->
				
				  <!-- @if(strpos(Auth::user()->user_type, 'quotation') !== false) -->
                <!-- Scrap Gold Card Example -->
                <!-- <div class="col-xl-3 col-md-6 mb-4">
                    <a href="{{ url('sales-quotation') }}">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body align-content-center">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">
                                        Estimate Quotation
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
                @endif -->
				
				  <!-- @if(strpos(Auth::user()->user_type, 'ncsale') !== false) -->
                <!-- Scrap Gold Card Example -->
                <!-- <div class="col-xl-3 col-md-6 mb-4">
                    <a href="{{ url('nc-sales-list') }}">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body align-content-center">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">
                                       NC Sale
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
                @endif -->

                <!-- @if(strpos(Auth::user()->user_type, 'vishaal') !== false) -->
                <!-- Customer Due  Accounts Example -->
                <!-- <div class="col-xl-3 col-md-6 mb-4">
                    <a href="due-account.html">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body align-content-center">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">
                                            Due Accounts
                                        </div> -->
                                        <!-- <div class="h5 mb-0 font-weight-bold text-gray-800">
                        $215,000
                      </div> -->
                                    <!-- </div>
                                    <div class="col-auto">
                                        <i class="fas fa-money-bill fa-2x text-warning"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div> -->

                <!-- Order Example -->
                <!-- <div class="col-xl-3 col-md-6 mb-4">
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
                </div> -->
                


                

                <!-- Valuations Card Example -->
                <!-- <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body align-content-center">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">
                                        Valuations
                                    </div> -->
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
                                <!-- </div>
                                <div class="col-auto">
                                    <i class="fas fa-balance-scale fa-2x text-warning"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->

                <!-- Reports Card Example -->
                <!-- <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body align-content-center">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">
                                        Reports
                                    </div> -->
                                    <!-- <div class="h5 mb-0 font-weight-bold text-gray-800">
                      18
                    </div> -->
                                <!-- </div>
                                <div class="col-auto">
                                    <i class="fas fa-chart-bar fa-2x text-warning"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->

                <!-- Stock Movement Card Example -->






                <!-- @endif -->
			
            </div>
            <!-- Content Row -->
            <!-- Content Row -->
        </div>
        <!-- /.container-fluid -->
    </div>
</div>
<!-- /.container-fluid -->

@endsection
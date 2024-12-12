@extends('layouts.dashboard')
@section('title', 'Order List')
@section('meta_description', 'System user list.')
@section('content')


    <style>
        input {
            border: ##df9700 !important
        }

        .dropbtn:focus {
            background-color: #3e8e41;
        }

        #myInput {
            box-sizing: border-box;
            background-image: url('searchicon.png');
            background-position: 14px 12px;
            background-repeat: no-repeat;
            font-size: 16px;
            padding: 14px 20px 12px 45px;
            border: none;
            border-bottom: 1px solid #ddd;
        }

        #myInput:focus {
            outline: 3px solid #ddd;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f6f6f6;
            min-width: 230px;
            overflow: auto;
            border: 1px solid #ddd;
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown a:hover {
            background-color: #ddd;
        }

        .show {
            display: block;
        }

        table.table-bordered.dataTable{
            max-height: 40vh;
            overflow: scroll;
        }

        /* #ConplaitOrder_filter, #dataTable1_filter{display: flex; justify-content: end;} */
    </style>

    <div id="content">
        <!-- Begin Page Content -->

        <div class="d-flex gap-2 flex-column flex-md-row justify-content-between py-3 bg-light card-header"
            style="
    position: sticky;
    top: 0;
    z-index: 100;">
            <!-- Page Heading -->
            <a href="{{ route('dashboard') }}" class="JewelleryPrimaryButton">
                <i class="fas fa-arrow-left mr-2"></i> Back to Menu
            </a>
            <h1 class="h3 mb-0 text-gray-800 " id="orderHeading">PENDING ORDERS</h1>
            <button class="JewelleryPrimaryButton" data-toggle="modal" data-target="#simpleModal"> <i
                    class="bi bi-person-add"></i> Add Customer</button>
        </div>

        <div class="container-fluid">

            <!-- Content Row -->
            <div class="my-4">
                <div class="">
                    <div class="col-12 card">
                        <div class="">
                            <div class="">
                                <!-- Nav tabs -->
                                <ul class="nav nav-pills py-3 nav-justified" id="pills-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="tab-div TabMaskDiv" id="add-new-customer-tab" data-toggle="pill"
                                            href="#add-new-customer" role="tab" aria-controls="add-new-customer"
                                            aria-selected="false">
                                            <div class="card border-left-warning shadow h-100 abc">
                                                <div class="card-body align-content-center">
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col mr-2">
                                                            <div class="TabText text-sm font-weight-bold text-warning mb-1">
                                                                Create Order
                                                            </div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <img src="{{ asset('/asset/images/icon/order.png') }}"
                                                                alt="Customer Icon" class="img-fluid" width="40px">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="nav-item d-none">
                                        <a class="tab-div TabMaskDiv " id="pills-customer-tab" data-toggle="pill"
                                            href="#pills-customer" role="tab" aria-controls="pills-customer"
                                            aria-selected="true">
                                            <div class="card border-left-warning shadow h-100 abc">
                                                <div class="card-body align-content-center">
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col mr-2">
                                                            <div class="TabText text-sm font-weight-bold text-warning mb-1">
                                                                All Orders
                                                            </div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <img src="{{ asset('/asset/images/icon/order.png') }}"
                                                                alt="Customer Icon" class="img-fluid" width="40px">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>


                                    <li class="nav-item">
                                        <a class="tab-div TabMaskDiv active" id="complete-repair-order-tab" data-toggle="pill"
                                            href="#complete-repair-order" role="tab"
                                            aria-controls="complete-repair-order" aria-selected="false">
                                            <div class="card border-left-warning shadow h-100 abc">
                                                <div class="card-body align-content-center">
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col mr-2">
                                                            <div
                                                                class="TabText text-sm font-weight-bold text-warning  mb-1">
                                                                Pending Orders
                                                            </div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <img src="{{ asset('/asset/images/icon/order.png') }}"
                                                                alt="Customer Icon" class="img-fluid" width="40px">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>

                                    </li>
                                    <li class="nav-item">
                                        <a class="tab-div TabMaskDiv" id="pending-repair-order-tab" data-toggle="pill"
                                            href="#pending-repair-order" role="tab" aria-controls="pending-repair-order"
                                            aria-selected="false">
                                            <div class="card border-left-warning shadow h-100 abc">
                                                <div class="card-body align-content-center">
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col mr-2">
                                                            <div
                                                                class="TabText text-sm font-weight-bold text-warning  mb-1">
                                                                Complete Orders
                                                            </div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <img src="{{ asset('/asset/images/icon/order.png') }}"
                                                                alt="Customer Icon" class="img-fluid" width="40px"
                                                                data-pagespeed-url-hash="2390888316"
                                                                onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Success/Error Messages -->
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Tab Content -->
                        <div class="tab-content" id="pills-tabContent">
                            <!-- Repair Items List Tab -->
                            <div class="tab-pane fade " id="pills-customer" role="tabpanel"
                                aria-labelledby="pills-customer-tab">


                                <div class="">
                                    <div class="table-responsive" style="max-height:55vh; overflow-y: scroll;">
                                        <!-- table here -->
                                    </div>
                                </div>

                            </div>

                            <!-- Add New Item Tab -->
                            <div class="tab-pane fade " id="add-new-customer" role="tabpanel"
                                aria-labelledby="add-new-customer-tab">
                                <div class="col-12 py-3 my-3 card" id="addItemsSection">
                                    <h2 class="h5 mb-3">Customer Details:</h2>
                                    <form id="customerForm" action="{{ route('store.repair.order') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <!-- Customer Dropdown -->
                                        <div class="">
                                            <div class="form__fields p-0">
                                                @if (session('customer'))
                                                    <input class="form-control" type="text" id="search"
                                                        placeholder="Enter mobile number or name of customer"
                                                        value="{{ session('customer')->mobile_no }}" required>
                                                @else
                                                    <input class="form-control" type="text" id="search"
                                                        placeholder="Enter mobile number or name of customer" required>
                                                @endif

                                                @if (session('customer'))
                                                    <input type="hidden" id="customerId" name="customer_id"
                                                        value="{{ session('customer')->customer_id }}">
                                                @else
                                                    <input type="hidden" id="customerId" name="customer_id" />
                                                @endif
                                                <ul id="customer-list"></ul>

                                                @if (session('customer'))
                                                    <div id="customer-details" class="mt-3" style="">
                                                        <h2>{{ session('customer')->first_name }}</h2>
                                                        <p>Mobile: 
															{{ substr(session('customer')->mobile_no, 0, 4) . ' ' . substr(session('customer')->mobile_no, 4, 3) . ' ' . substr(session('customer')->mobile_no, 7, 3) }}
														</p>
                                                        <p>Email: {{ session('customer')->email ?? 'N/A' }}</p>
                                                        <p>Address: {{ session('customer')->address ?? 'N/A' }}</p>
                                                    </div>
                                                @else
                                                    <div id="customer-details" class="mt-3" style="display: none;">
                                                    </div>
                                                @endif
                                            </div>

                                        </div>

                                        <!-- Customer Details Fields -->

                                        <div class="form-row align-items-center mb-3 d-none">
                                            <div class="col-md-3">
                                                <label for="first_name" class="form-label">Customer Name</label>
                                            </div>
                                            <div class="col-md-9 ">
                                                <input type="text" class="form-control" id="first_name"
                                                    name="first_name" readonly />
                                            </div>
                                        </div>
                                        <div class="form-row align-items-center mb-3 d-none">
                                            <div class="col-md-3">
                                                <label for="email" class="form-label">Customer Email</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="email" class="form-control" id="email" name="email"
                                                    readonly />
                                            </div>
                                        </div>
                                        <div class="form-row align-items-center mb-3 d-none">
                                            <div class="col-md-3">
                                                <label for="gender" class="form-label">Gender</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="gender" name="gender"
                                                    readonly />
                                            </div>
                                        </div>
                                        <div class="form-row align-items-center mb-3 d-none">
                                            <div class="col-md-3">
                                                <label for="date_of_birth" class="form-label">Date of Birth</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="date" class="form-control" id="date_of_birth"
                                                    name="date_of_birth" readonly />
                                            </div>
                                        </div>
                                        <div class="form-row align-items-center mb-3 d-none">
                                            <div class="col-md-3">
                                                <label for="repair_order_no" class="form-label">Repair Order
                                                    Number</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="repair_order_no"
                                                    name="repair_order_no" />
                                            </div>
                                        </div>

                                        <hr>


                                        <!-- Items Details -->
                                        <h4 class="col-12 mt-3 p-0 h5">Items Details:</h4>


                                        <div class="form-row align-items-center mb-3">

                                            <div class="col-md-3">
                                                <label class="form-label" for="order_date">Order Date</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input class="form-control" type="date" name="order_date"
                                                    id="order_date" required>
                                            </div>
                                        </div>

                                        <div class="form-row align-items-center mb-3">

                                            <div class="col-md-3">
                                                <label class="form-label" for="order_due_date">Order Due Date</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input class="form-control" type="date" name="order_due_date"
                                                    id="order_due_date" required>
                                            </div>
                                        </div>



                                        <!-- Dynamic Item Rows -->
                                        <div id="itemsContainer"></div>


                                        <div class="d-flex justify-content-between my-3">
                                            <button type="button" class="btn btn-primary" id="addItemRowBtn"><i
                                                    class="bi bi-plus"></i> Add Item</button>
                                           
                                        </div>
										
										<hr>
										<div class="my-4">
											<div class="form-row align-items-center mb-3">
												<div class="col-md-3">
													<label for="estimateamount" class="form-label">Estimate Amount £</label>
												</div>
												<div class="col-md-9">
													<input type="text" class="form-control" id="estimateamount" name="estimateamount" placeholder="Enter Estimate Amount" />
												</div>
											</div>
											
											<div class="form-row align-items-center mb-3">
												<div class="col-md-3">
													<label for="weight${rowIndex}" class="form-label">Deposit Paid By Cash
												</div>
												<div class="col-md-9">
													<input type="text" class="form-control" id="DepositPaidByCash" name="DepositPaidByCash" placeholder="Enter Deposit Paid By Cash" />
												</div>
											</div>
											
											<div class="form-row align-items-center mb-3">
												<div class="col-md-3">
													<label for="DepositPaidByCard" class="form-label">Deposit Paid By Card
												</div>
												<div class="col-md-9">
													<input type="text" class="form-control" id="DepositPaidByCard" name="DepositPaidByCard" placeholder="Enter Deposit Paid By Card" />
												</div>
											</div>
											
												<div class="form-row align-items-center mb-3">
												<div class="col-md-3">
													<label for="DepositPaidByCard" class="form-label">Deposit Paid By Gold
												</div>
												<div class="col-md-9">
													<input type="text" class="form-control" id="DepositPaidByGold" name="DepositPaidByGold" placeholder="Enter Deposit Paid By Gold" />
												</div>
											</div>
													
													<div class="form-row align-items-center mb-3">
												<div class="col-md-3">
													<label for="DepositPaidByCard" class="form-label">Internal Gold REF
												</div>
												<div class="col-md-9">
													<input type="text" class="form-control" id="InternalGoldREF" name="InternalGoldREF" placeholder="Enter Gold Reference" />
												</div>
											</div>
										</div>
										 <div class="d-flex justify-content-end mt-3">
                                           
                                            <button type="submit" class="JewelleryPrimaryButton"><i
                                                    class="bi bi-floppy"></i> Save Order</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="tab-pane fade show active my-4" id="complete-repair-order" role="tabpanel"
                                aria-labelledby="complete-repair-order-tab">

                                <div class="table-responsive">
									 <div class="mb-3">
                                        <div class="text-center">
                                            
                                            Search: <input type="text" id="firstsearchInput" class="p-1" placeholder="" onkeyup="searchTable()">
                                        </div>
                                    </div>
                                    <table class="table table-bordered" id="pendingOrdersTable" width="100%" cellspacing="0">
                                        <thead class="text-center" style="background-color:#df9700; color:#fff">
                                            <tr>
                                                <th>Order No</th>
                                                <th>Customer Name</th>
												<th class="mobile-number">Mobile Number</th>
                                                <th  class="note-column">Order Description</th>
                                                <th class="mobile-number">Order Date</th>
                                                <th class="mobile-number">Delivery Date</th>
                                                <th>Karigar Code</th>
                                                <th>Karigar Order Status</th>
                                                <th>Image</th>
                                                <th>Customer Notified</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody class="text-center">
                                            @foreach ($pendingrepairOrders as $pendingrepairOrder)
                                                <tr >
                                                    <td>
                                                        <a
                                                            href="{{ route('order.details', ['order_no' => $pendingrepairOrder->id]) }}">
                                                            {{ $pendingrepairOrder->id }}
                                                        </a>
                                                    </td>
                                                    <td>{{ $pendingrepairOrder->customer->first_name }} {{ $pendingrepairOrder->customer->last_name }}
                                                    </td>
													<td class="mobile-number">
								{{ ''.substr($pendingrepairOrder->customer->mobile_no, 0, 4).' '.substr($pendingrepairOrder->customer->mobile_no, 4, 3).' '.substr($pendingrepairOrder->customer->mobile_no, 7, 3).' '.substr($pendingrepairOrder->customer->mobile_no, 10) }}
								
							</td>
                                                    <td class="note-column">
															@foreach ($pendingrepairOrder->orderItems as $item)
																<p>{{ $loop->iteration }}. {{ $item->description }}</p><br>
															@endforeach
														</td>

                                                    
													
                                                    <td class="mobile-number">{{ \Carbon\Carbon::parse($pendingrepairOrder->order_date)->format('d-m-y') }}</td>

                                                    <td class="mobile-number">{{ \Carbon\Carbon::parse($pendingrepairOrder->order_date)->format('d-m-y') }}</td>

													<td>
															@foreach ($pendingrepairOrder->orderItems as $item)
																<p>{{ $loop->iteration }}. {{ $item->karigar->karigar_name }}</p><br>
															@endforeach
													</td>
                                                    <td>

                                                        @if ($pendingrepairOrder->order_status == 'Completed')
                                                            <button class="btn btn-success">{{ $pendingrepairOrder->order_status }}</button>
                                                        @else
                                                           <button class="btn btn-danger">Pending</button>
                                                        @endif
                                                    </td>
													
													<td>
																													@foreach ($pendingrepairOrder->orderItems as $index => $item)
    <p>{{ $loop->iteration }}.</p>
    @php
        $photos = json_decode($item->photo);
    @endphp
    @if ($photos && count($photos) > 0)
        <!-- Display thumbnail image with onclick event -->
        <img src="{{ asset('asset/images/orderitems/' . $photos[0]) }}" 
             alt="Order Item Photo" 
             style="width: 100px; height: auto; cursor: pointer;"
             onclick="newshowImageModal('{{ asset('asset/images/orderitems/' . $photos[0]) }}', {{ $index }})">
        <br>
    @else
        <p>No photos available.</p>
    @endif

    <!-- Unique Modal Structure for each image -->
    <div class="modal fade" id="newimageModal{{ $index }}" tabindex="-1" role="dialog" aria-labelledby="newimageModalLabel{{ $index }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newimageModalLabel{{ $index }}">Order Item Photo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <!-- Image that will be shown in modal -->
                    <img id="newmodalImage{{ $index }}" src="" alt="Order Item Photo" style="width: 100%; height: auto;">
                </div>
            </div>
        </div>
    </div>
@endforeach
															
														</td>


                                                    <td>@if ($pendingrepairOrder->customer_notified == 'Completed')
														<button class="btn btn-success">Message Sent</button>
                                                        @else
														<button class="btn btn-danger">Not Notified</button>
                                                            
                                                        @endif
                                                    </td>
                                                    <td>
														
                                                                <a class="btn btn-primary" title="Convert Into Invoice"
                                                                    href="{{ route('order.details', ['order_no' => $pendingrepairOrder->id]) }}"><button>View</button></a>


                                                    </td>
                                                  
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>


                            <div class="tab-pane fade my-4" id="pending-repair-order" role="tabpanel"
                                aria-labelledby="complete-repair-order-tab">

                                <div class="table-responsive">
                                <div class="mb-3">
                                        <div class="text-center">
                                            
                                            Search: <input type="text" id="searchInput" class="p-1" placeholder="" onkeyup="searchTable()">
                                        </div>
                                    </div>

                                    <table class="table table-bordered" id="repairOrdersTable" width="100%" cellspacing="0">
                                        <thead class="text-center" style="background-color:#df9700; color:#fff">
                                            <tr>
                                                <th>Order No</th>
                                                <th>Customer Name</th>
												<th class="mobile-number">Mobile Number</th>
                                                <th  class="note-column">Order Description</th>
                                                <th class="mobile-number">Order Date</th>
                                                <th class="mobile-number">Delivery Date</th>
                                                <th>Karigar Code</th>
                                                
                                                <th>Karigar Order Status</th>
                                                <th>Image</th>
                                                <th>Customer Notified</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody class="text-center">
                                            @foreach ($completerepairOrders as $pendingrepairOrder)
                                                <tr>
                                                    <td>
                                                        <a
                                                            href="{{ route('order.details', ['order_no' => $pendingrepairOrder->id]) }}">
                                                            {{ $pendingrepairOrder->id }}
                                                        </a>
                                                    </td>
                                                    <td>{{ $pendingrepairOrder->customer->first_name }} {{ $pendingrepairOrder->customer->last_name }}
                                                    </td>
													<td class="mobile-number">
								{{ ''.substr($pendingrepairOrder->customer->mobile_no, 0, 4).' '.substr($pendingrepairOrder->customer->mobile_no, 4, 3).' '.substr($pendingrepairOrder->customer->mobile_no, 7, 3).' '.substr($pendingrepairOrder->customer->mobile_no, 10) }}
								
							</td>
                                                    <td class="note-column">
															@foreach ($pendingrepairOrder->orderItems as $item)
																<p>{{ $loop->iteration }}. {{ $item->description }}</p><br>
															@endforeach
														</td>

                                                    
													
                                                    <td class="mobile-number">{{ \Carbon\Carbon::parse($pendingrepairOrder->order_date)->format('d-m-y') }}</td>

                                                    <td class="mobile-number">{{ \Carbon\Carbon::parse($pendingrepairOrder->order_date)->format('d-m-y') }}</td>

													<td>
															@foreach ($pendingrepairOrder->orderItems as $item)
																<p>{{ $loop->iteration }}. {{ $item->karigar->karigar_name }}</p><br>
															@endforeach
													</td>
                                                    <td>

                                                         @if ($pendingrepairOrder->order_status == 'Completed')
                                                            <button class="btn btn-success">{{ $pendingrepairOrder->order_status }}</button>
                                                        @else
                                                           <button class="btn btn-danger">Pending</button>
                                                        @endif
                                                    </td>
													
													<td>
															@foreach ($pendingrepairOrder->orderItems as $index => $item)
    <p>{{ $loop->iteration }}.</p>
    @php
        $photos = json_decode($item->photo);
    @endphp
    @if ($photos && count($photos) > 0)
        <!-- Display thumbnail image with onclick event -->
        <img src="{{ asset('asset/images/orderitems/' . $photos[0]) }}" 
             alt="Order Item Photo" 
             style="width: 100px; height: auto; cursor: pointer;"
             onclick="showImageModal('{{ asset('asset/images/orderitems/' . $photos[0]) }}', {{ $index }})">
        <br>
    @else
        <p>No photos available.</p>
    @endif

    <!-- Unique Modal Structure for each image -->
    <div class="modal fade" id="imageModal{{ $index }}" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel{{ $index }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel{{ $index }}">Order Item Photo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <!-- Image that will be shown in modal -->
                    <img id="modalImage{{ $index }}" src="" alt="Order Item Photo" style="width: 100%; height: auto;">
                </div>
            </div>
        </div>
    </div>
@endforeach

														</td>


                                                    <td>@if ($pendingrepairOrder->customer_notified == 'Completed')
														<button class="btn btn-success">Message Sent</button>
                                                        @else
														<button class="btn btn-danger">Not Notified</button>
                                                            
                                                        @endif
                                                    </td>
                                                    <td>
														@if ($pendingrepairOrder->payment_status == 'Completed')
														<button class="btn btn-success m-1">Invoice Completed</button>
														@else
                                                            @if ($pendingrepairOrder->order_status == 'Completed')
                                                                <a class="btn btn-primary m-1" title="Convert Into Invoice"
                                                                    href="{{ route('repair.invoice', ['repair_order_no' => $pendingrepairOrder->id]) }}"><button><i
                                                                            class="bi bi-receipt"></i> Sale</button></a>
                                                            @else
                                                                <button class="btn btn-success m-1">{{$pendingrepairOrder->order_status}}</button>
                                                            @endif
														
														@endif
														
														<a class="btn btn-primary m-1" href="{{ route('order.details', ['order_no' => $pendingrepairOrder->id]) }}">View</a>
                                                        

                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>



    <!-- Add Customer Modal -->

    <!-- Add New Customer Modal -->
    <div class="modal fade" id="simpleModal" tabindex="-1" role="dialog" aria-labelledby="simpleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form-sample" action="{{ route('store.customer') }}" enctype="multipart/form-data"
                    method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title text-warning h4" id="simpleModalLabel">Add New Customer</h5>
                        <div>
                            <button type="submit" class="JewelleryPrimaryButton ml-2"><i class="bi bi-floppy-fill"></i>
                                Save</button>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" class="h2">&times;</span>
                            </button>
                        </div>
                    </div>
                    <div class="modal-body">

                        <!-- Form to Add New Customer -->

                        <!--   <div class="d-sm-flex gap-2 justify-content-between">
                                            <h6 class="m-0 h3 font-weight-bold text-warning">
                                            Add New Customer
                </h6>
                <div><a href="{{ route('customers.list') }}"<button class="JewelleryPrimaryButton gap-2 btn-primary"> <i class="bi bi-arrow-left"></i> Back</button></a>
                 
                                        </div>
                                        </div> -->

                        <div class="MainForm">
                            <div class="row g-3" style="overflow-y: scroll; height: 60vh;">
                                <!-- First Name -->
                                <div class="col-md-12 form__fields">
                                    <label for="firstName" class="form-label">First Name*</label>


                                    <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                        id="firstName" name="first_name" placeholder="Enter First Name"
                                        value="{{ old('first_name') }}" required />
                                    @error('first_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Last Name -->
                                <div class="col-md-12 form__fields">
                                    <label for="lastName" class="form-label">Last Name*</label>

                                    <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                        id="lastName" name="last_name" placeholder="Enter Last Name"
                                        value="{{ old('last_name') }}" required />
                                    @error('last_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Mobile Number -->
                                <div class="col-md-12 form__fields">
                                    <label for="mobileNo" class="form-label">Mobile Number*</label>

                                    <input type="text" class="form-control @error('mobile_no') is-invalid @enderror"
                                        id="mobileNo" name="mobile_no" placeholder="Enter Mobile Number"
                                        value="{{ old('mobile_no') }}" required />
                                    @error('mobile_no')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Address -->
                                <div class="col-md-12 form__fields">
                                    <label for="address" class="form-label">Address</label>

                                    <input type="text" class="form-control @error('address') is-invalid @enderror"
                                        id="address" name="address" placeholder="Enter Address"
                                        value="{{ old('address') }}" />
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- town -->
                                <div class="col-md-12 form__fields">
                                    <label for="town" class="form-label">Town</label>

                                    <input type="text" class="form-control @error('town') is-invalid @enderror"
                                        id="town" name="town" placeholder="Enter town"
                                        value="{{ old('town') }}" />
                                    @error('town')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- county  -->
                                <div class="col-md-12 form__fields">
                                    <label for="county" class="form-label">County</label>

                                    <input type="text" class="form-control @error('county') is-invalid @enderror"
                                        id="county" name="county" placeholder="Enter county"
                                        value="{{ old('county') }}" />
                                    @error('county')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>


                                <!-- Post Code -->
                                <div class="col-md-12 form__fields">
                                    <label for="post-code" class="form-label">Post Code</label>

                                    <input type="text" class="form-control @error('post-code') is-invalid @enderror"
                                        id="post-code" name="post_code" placeholder="Enter Post Code"
                                        value="{{ old('post_code') }}" />
                                    @error('post-code')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- note  -->
                                <div class="col-md-12 form__fields">
                                    <label for="note" class="form-label">Note</label>

                                    <textarea class="form-control @error('note') is-invalid @enderror" id="note" row="6" name="note" placeholder="Enter Note">{{ old('note') }}</textarea>
                                    @error('note')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>


                                <!-- Email -->
                                <div class="col-md-12 form__fields">
                                    <label for="email" class="form-label">Email</label>

                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" placeholder="Enter Email"
                                        value="{{ old('email') }}" />
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Gender -->
                                <div class="col-md-12 form__fields">
                                    <label for="gender" class="form-label">Gender</label>

                                    <select class="form-control @error('gender') is-invalid @enderror" id="gender"
                                        name="gender">
                                        <option value="" selected>--Select Gender--</option>
                                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male
                                        </option>
                                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female
                                        </option>
                                    </select>
                                    @error('gender')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>



                                <!-- Date of Birth -->
                                <div class="col-md-12 form__fields">
                                    <label for="dob" class="form-label">Date of Birth</label>

                                    <input type="date"
                                        class="form-control @error('date_of_birth') is-invalid @enderror" id="dob"
                                        name="date_of_birth" value="{{ old('date_of_birth') }}" />
                                    @error('date_of_birth')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- WhatsApp Number -->
                                <div class="col-md-12 form__fields">
                                    <label for="whatsappNo" class="form-label">WhatsApp</label>

                                    <input type="text" class="form-control" id="whatsappNo" name="whatsapp_no"
                                        placeholder="Enter WhatsApp Number" value="{{ old('whatsapp_no') }}" />
                                </div>



                                <!-- Instagram  -->
                                <div class="col-md-12 form__fields">
                                    <label for="instagram" class="form-label">Instagram</label>

                                    <input type="text" class="form-control @error('instagram') is-invalid @enderror"
                                        id="instagram" name="instagram" placeholder="Enter Instagram"
                                        value="{{ old('instagram') }}" />
                                    @error('instagram')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Facebook  -->
                                <div class="col-md-12 form__fields">
                                    <label for="facebook" class="form-label">Facebook</label>

                                    <input type="text" class="form-control @error('facebook') is-invalid @enderror"
                                        id="facebook" name="facebook" placeholder="Enter Facebook"
                                        value="{{ old('facebook') }}" />
                                    @error('facebook')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Tiktok  -->
                                <div class="col-md-12 form__fields">
                                    <label for="tiktok" class="form-label">Tiktok</label>

                                    <input type="text" class="form-control @error('tiktok') is-invalid @enderror"
                                        id="tiktok" name="tiktok" placeholder="Enter Tiktok"
                                        value="{{ old('tiktok') }}" />
                                    @error('tiktok')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Religion  -->
                                <div class="col-md-12 form__fields">
                                    <label for="religion" class="form-label">Religion</label>

                                    <input type="text" class="form-control @error('religion') is-invalid @enderror"
                                        id="religion" name="religion" placeholder="Enter Religion"
                                        value="{{ old('religion') }}" />
                                    @error('religion')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                </form>
            </div>

        </div>
    </div>
    <!-- End Modal -->

    <!-- Assign Karigar Modal -->
    <div class="modal fade" id="fillModal" tabindex="-1" role="dialog" aria-labelledby="fillModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="fillModalLabel">Assign Karigar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="fillForm" action="{{ route('assign.karigar') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="itemIds" name="item_ids">
                        <input type="hidden" id="itemInputPrice" name="itemInputPrice">

                        <div class="form-group">
                            <label for="location">Karigar</label>
                            <select class="form-control" id="location" name="karigar" required>
                                <option value="" disabled selected>Select Karigar</option>
                                @foreach ($karagirs as $karigar)
                                    <option value="{{ $karigar->karigar_id }}">{{ $karigar->karigar_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="itemId">Repair Item ID</label>
                            <input type="text" class="form-control" id="itemId" name="item_id"
                                placeholder="Enter Repair Item ID">
                        </div>
                        <div class="form-group">
                            <label for="itemprice">Repair Item Price</label>
                            <input type="number" class="form-control" id="itemprice" name="itemprice"
                                placeholder="Enter Repair Item Price">
                        </div>
                        <!-- New Add Button -->
                        <button type="button" id="addItemBtn" class="btn btn-info mb-3">Add ID</button>

                        <div class="form-group">
                            <label>Added Items</label>
                            <ul class="list-group" id="itemList"></ul>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Model -->

<!-- Modal for Image Preview -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Image Preview</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img id="modalImage" src="" alt="" class="img-fluid">
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            // Delegate event for dynamically created category select elements
            $('#itemsContainer').on('change', 'select[id^="category"]', function() {
                var categoryId = $(this).val(); // Get selected category ID
                var rowIndex = this.id.replace('category', ''); // Extract row index from id
                console.log(categoryId);

                if (categoryId) {
                    $.ajax({
                        url: '/raman-jeweller-erp/public/get-category-details/' + categoryId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            console.log(data);

                            // Populate and manage CategorySize dropdown
                            $('#CategorySize' + rowIndex).empty();
                            if (data.sizes && Object.keys(data.sizes).length > 0) {
                                $('#CategorySize' + rowIndex).append(
                                    '<option value="">Select Size</option>');
                                $.each(data.sizes, function(key, value) {
                                    $('#CategorySize' + rowIndex).append(
                                        '<option value="' + value + '">' + value +
                                        '</option>');
                                });
                                $('#CategorySize' + rowIndex).show();
                                $('#CategorydivSize' + rowIndex).show();
                            } else {
                                $('#CategorydivSize' + rowIndex).hide(); // Hide if no data
                            }

                            // Populate and manage CategoryShape dropdown
                            $('#CategoryShape' + rowIndex).empty();
                            if (data.shapes && Object.keys(data.shapes).length > 0) {
                                $('#CategoryShape' + rowIndex).append(
                                    '<option value="">Select Shape</option>');
                                $.each(data.shapes, function(key, value) {
                                    $('#CategoryShape' + rowIndex).append(
                                        '<option value="' + value + '">' + value +
                                        '</option>');
                                });
                                $('#CategoryShape' + rowIndex).show();
                                $('#CategorydivShape' + rowIndex).show();
                            } else {
                                $('#CategorydivShape' + rowIndex).hide(); // Hide if no data
                            }

                            // Handle diamond shapes, types, and other sections similarly
                            if (data.diamondshapes && Object.keys(data.diamondshapes).length >
                                0) {
                                $('#Diamondshape' + rowIndex).empty().append(
                                    '<option value="">Select Diamond Shape</option>');
                                $.each(data.diamondshapes, function(key, value) {
                                    $('#Diamondshape' + rowIndex).append(
                                        '<option value="' + value + '">' + value +
                                        '</option>');
                                });
                                $('#Diamondshape' + rowIndex).show();
                                $('#Diamondshapediv' + rowIndex).show();
                                $('#CentreDiamondWeightDiv' + rowIndex).show();
                                $('#TotalDiamondWeightDiv' + rowIndex).show();
                                $('#MatchingWeddingBandDiv' + rowIndex).show();
                                $('#HalfETDiv' + rowIndex).show();
                                $('#FullETDiv' + rowIndex).show();
                                $('#CostCentreDiamondDiv' + rowIndex).show();
                                $('#MountCostDiv' + rowIndex).show();
                                $('#WeddingBandCostDiv' + rowIndex).show();
                            } else {
                                $('#Diamondshapediv' + rowIndex).hide(); // Hide if no data
                                $('#CentreDiamondWeightDiv' + rowIndex).hide();
                                $('#TotalDiamondWeightDiv' + rowIndex).hide();
                                $('#MatchingWeddingBandDiv' + rowIndex).hide();
                                $('#HalfETDiv' + rowIndex).hide();
                                $('#FullETDiv' + rowIndex).hide();
                                $('#CostCentreDiamondDiv' + rowIndex).hide();
                                $('#MountCostDiv' + rowIndex).hide();
                                $('#WeddingBandCostDiv' + rowIndex).hide();
                            }

                            if (data.diamondtypes && Object.keys(data.diamondtypes).length >
                                0) {
                                $('#Diamondtype' + rowIndex).empty().append(
                                    '<option value="">Select Diamond Type</option>');
                                $.each(data.diamondtypes, function(key, value) {
                                    $('#Diamondtype' + rowIndex).append(
                                        '<option value="' + value + '">' + value +
                                        '</option>');
                                });
                                $('#Diamondtype' + rowIndex).show();
                                $('#Diamondtypediv' + rowIndex).show();
                            } else {
                                $('#Diamondtypediv' + rowIndex).hide(); // Hide if no data
                            }
                        }
                    });
                } else {
                    // Reset related fields if no category is selected
                    var rowIndex = this.id.replace('category', ''); // Extract row index from id
                    $('#CategorySize' + rowIndex).empty().append('<option value="">Select Size</option>')
                        .hide();
                    $('#CategoryShape' + rowIndex).empty().append('<option value="">Select Shape</option>')
                        .hide();
                    $('#Diamondshape' + rowIndex).empty().append(
                        '<option value="">Select Diamond Shape</option>').hide();
                    // Hide any other dependent fields similarly
                }
            });
        });
    </script>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script>
        $(document).ready(function() {
            const form = $('#customerForm');

            $('#search').on('input', function() {
                const query = $(this).val();

                if (query.length > 0) {
                    $.get('/raman-jeweller-erp/public/customers/search', {
                        query: query
                    }, function(data) {
                        $('#customer-list').empty();
                        data.forEach(customer => {
							const mobileNo = `${customer.mobile_no}`;
  					const formattedMobile = mobileNo.substr(0, 4) + ' ' + mobileNo.substr(4, 3) + ' ' + mobileNo.substr(7, 3);
				
                            $('#customer-list').append(
								
                                `<li class="list-group-item" data-id="${customer.customer_id}">${customer.first_name} - ${formattedMobile}</li>`
                            );
                        });
                    });
                } else {
                    $('#customer-list').empty();
                }
            });

            $(document).on('click', '#customer-list li', function() {
                const customerId = $(this).data('id');
                $.get(`/raman-jeweller-erp/public/customers/search/${customerId}`, function(data) {
					
					const mobileNo = `${data.mobile_no}`;
  		const formattedMobile = mobileNo.substr(0, 4) + ' ' + mobileNo.substr(4, 3) + ' ' + mobileNo.substr(7, 3);
  
                    $('#customer-details').html(`
                    <h2>${data.first_name}</h2>
                <p>Mobile: ${formattedMobile}</p>
                <p>Email: ${data.email || 'N/A'}</p>
                <p>Address: ${data.address || 'N/A'}</p>
                <p>Due Amount: £${data.dueamount ? number_format(data.dueamount) : 'N/A'}</p>
                <p>NC Sale Count: ${data.countncsale || 'N/A'}</p>
                <p>Order Count: ${data.countrepairorder || 'N/A'}</p>
                `).show();
                    $('#customerId').val(customerId); // Set hidden customer ID field
                    $('#customer-list').empty(); // Clear the list after selection
                });
            });
        });
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const addItemRowBtn = document.getElementById('addItemRowBtn');
        const itemsContainer = document.getElementById('itemsContainer');
        let rowIndex = 0;

        // Function to add dynamic row
        function addItemRow() {
            rowIndex++;
            
            const row = document.createElement('div');
            row.className = 'item-row'; // Class for easier selection
            row.innerHTML = `
                <!-- Dynamically created form row -->
                <div class="form-row align-items-center mb-3">
                <div class="col-md-3">
                    <label for="category${rowIndex}" class="form-label">Category</label>
                </div>
                <div class="col-md-9">
                    <select class="form-control" name="categories${rowIndex}" id="category${rowIndex}" required>
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="form-row align-items-center mb-3" id="CategorydivSize${rowIndex}" style="display:none;">
                <div class="col-md-3">
                    <label for="CategorySize${rowIndex}" class="form-label">Size</label> 
                </div>
                <div class="col-md-9">
                    <select class="form-control" name="CategorySize${rowIndex}" id="CategorySize${rowIndex}" > 
                        <option value="">Select Size</option>
                    </select>
                </div>
            </div>
            
            <div class="form-row align-items-center mb-3" id="CategorydivShape${rowIndex}" style="display:none;">
                <div class="col-md-3">
                    <label for="CategoryShape${rowIndex}" class="form-label">Shape</label> 
                </div>
                <div class="col-md-9">
                    <select class="form-control" name="CategoryShape${rowIndex}" id="CategoryShape${rowIndex}" > 
                        <option value="">Select Shape</option>
                    </select>
                </div>
            </div>


            <div class="form-row align-items-center mb-3" id="Diamondtypediv0" style="display:none;">
                <div class="col-md-3">
                    <label for="Diamondtype${rowIndex}" class="form-label">Diamond Type</label> 
                </div>
                <div class="col-md-9">
                    <select class="form-control" name="Diamondtype${rowIndex}" id="Diamondtype${rowIndex}" > 
                        <option value="">Select Shape</option>
                    </select>
                </div>
            </div>

            
            <div class="form-row align-items-center mb-3" id="Diamondshapediv0" style="display:none;">
                <div class="col-md-3">
                    <label for="Diamondshape${rowIndex}" class="form-label">Diamond Shape</label> 
                </div>
                <div class="col-md-9">
                    <select class="form-control" name="Diamondshape${rowIndex}" id="Diamondshape${rowIndex}" > 
                        <option value="">Select Shape</option>
                    </select>
                </div>
            </div>

            <div class="form-row align-items-center mb-3" id="CentreDiamondWeightDiv0" style="display:none;">
                <div class="col-md-3">
                    <label for="CentreDiamondWeight${rowIndex}" class="form-label">Centre Diamond Weight</label> 
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control" id="CentreDiamondWeight${rowIndex}" name="CentreDiamondWeight${rowIndex}" placeholder="Enter Centre Diamond Weight" />

                </div>
            </div>

            <div class="form-row align-items-center mb-3" id="TotalDiamondWeightDiv${rowIndex}" style="display:none;">
                <div class="col-md-3">
                    <label for="TotalDiamondWeight${rowIndex}" class="form-label">Total Diamond Weight</label> 
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control" id="TotalDiamondWeight${rowIndex}" name="TotalDiamondWeight${rowIndex}" placeholder="Enter Total Diamond Weight" />
                </div>
            </div>


            <div class="form-row align-items-center mb-3" id="MatchingWeddingBandDiv${rowIndex}" style="display:none;">
                <div class="col-md-3">
                    <label class="form-label" for="matching_band${rowIndex}">Matching Wedding Band:</label> 
                </div>
                <div class="col-md-9">
                    <input type="radio" id="yes${rowIndex}" name="matching_band${rowIndex}" value="yes">
                        <label for="yes${rowIndex}">Yes</label><br>

                        <input type="radio" id="no${rowIndex}" name="matching_band${rowIndex}" value="no">
                        <label for="no${rowIndex}">No</label><br>
                </div>
            </div>
        
            <div class="form-row align-items-center mb-3" id="HalfETDiv${rowIndex}" style="display:none;">
                <div class="col-md-3">
                    <label for="HalfET${rowIndex}" class="form-label">Half ET</label> 
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control" id="HalfET${rowIndex}" name="HalfET${rowIndex}" placeholder="Half ET" />
                </div>
            </div>

            <div class="form-row align-items-center mb-3" id="FullETDiv${rowIndex}" style="display:none;">
                <div class="col-md-3">
                    <label for="FullET${rowIndex}" class="form-label">Full ET</label> 
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control" id="FullET${rowIndex}" name="FullET${rowIndex}" placeholder="Full ET" />
                </div>
            </div>

            <div class="form-row align-items-center mb-3" id="CostCentreDiamondDiv${rowIndex}" style="display:none;">
                <div class="col-md-3">
                    <label for="CostCentreDiamond${rowIndex}" class="form-label">Cost Centre Diamond</label> 
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control" id="CostCentreDiamond${rowIndex}" name="CostCentreDiamond${rowIndex}" placeholder="Enter Cost Centre Diamond" />
                </div>
            </div>

            <div class="form-row align-items-center mb-3" id="MountCostDiv${rowIndex}" style="display:none;">
                <div class="col-md-3">
                    <label for="MountCost${rowIndex}" class="form-label">Mount Cost</label> 
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control" id="MountCost${rowIndex}" name="MountCost${rowIndex}" placeholder="Enter Mount Cost" />
                </div>
            </div>

            <div class="form-row align-items-center mb-3" id="WeddingBandCostDiv${rowIndex}" style="display:none;">
                <div class="col-md-3">
                    <label for="WeddingBandCost${rowIndex}" class="form-label">Wedding Band Cost</label> 
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control" id="WeddingBandCost${rowIndex}" name="WeddingBandCost${rowIndex}" placeholder="Enter Wedding Band Cost" />
                </div>
            </div>

        <div class="form-row align-items-center mb-3">
            <div class="col-md-3">
                <label for="metalType${rowIndex}" class="form-label">Metal Type</label>
            </div>
            <div class="col-md-9">
                <select class="form-control" name="metal_types${rowIndex}" id="metal_type${rowIndex}" required>
                    <option value="">Select Metal Type</option>
                    @foreach ($itemTypes as $itemType)
                    <option value="{{ $itemType->item_type_name }}">{{ $itemType->item_type_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-row align-items-center mb-3">
            <div class="col-md-3">
                <label for="weight${rowIndex}" class="form-label">Estimate Weight (grams)</label>
            </div>
            <div class="col-md-9">
                <input type="text" class="form-control" id="item_weight${rowIndex}" name="weights${rowIndex}" placeholder="Enter Item Weight" />
            </div>
        </div>
		
		        <div class="form-row align-items-center mb-3">
            <div class="col-md-3">
                <label for="note${rowIndex}" class="form-label">Order Note</label>
            </div>
            <div class="col-md-9">
				<textarea class="form-control @error('note') is-invalid @enderror" id="note${rowIndex}" row="6" name="note${rowIndex}" placeholder="Enter Order Note" >{{ old('note${rowIndex}') }}</textarea>
            </div>
        </div>

                <!-- More dynamic fields based on the form -->
                <div class="form-row align-items-center mb-3">
                    <div class="col-md-3">
                        <label for="item_image${rowIndex}" class="form-label">Upload Image</label>
                    </div>
                    <div class="col-md-5">
                        <input type="file" class="form-control" id="item_image${rowIndex}" accept="image/*" multiple>
                    </div>
                    <div class="col-md-4">
                        <label for="item_photo${rowIndex}" class="form-label" style="background: gray; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; font-size: 16px;">Take Photo</label>
                        <input type="file" class="form-control" id="item_photo${rowIndex}" accept="image/*" capture="camera" multiple style="opacity: 0; position: absolute; z-index: -1;">
                    </div>
                </div>

                <!-- Image preview section -->
                <div class="form-row align-items-center mb-3">
				<div class="col-md-3"> </div>
                    <div class="row col-md-9" id="preview-list${rowIndex}"></div>
                </div>

                <!-- Hidden consolidated input to hold files -->
                <input type="file" class="form-control" id="consolidated_image_input${rowIndex}" name="item_image${rowIndex}[]" accept="image/*" multiple style="display: none;">
                

                                                       
									
                <div class="form-row align-items-center mb-3">
                <div class="col-md-3">
                    <label for="form_input_karigar${rowIndex}" class="form-label">Assign Karigar</label>
                </div>
                <div class="col-md-9">
                    <select class="form-control" name="form_input_karigar${rowIndex}" id="form_input_karigar${rowIndex}" required>
                        <option value="">Select Karigar</option>
                        @foreach ($karagirs as $karagir)
                        <option value="{{ $karagir->karigar_id }}">{{ $karagir->karigar_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
			
		
		
		<div class="modal fade" id="imageModal${rowIndex}" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel${rowIndex}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="imageModalLabel${rowIndex}">Image Preview</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <img id="modalImage${rowIndex}" src="" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
		
                <!-- Remove button -->
                <div class="form-row align-items-center justify-content-end mb-3">
                    <div class="mx-2">
                        <button type="button" class="btn btn-danger remove-row-btn">Remove</button>
                    </div>
                </div>
				
				<hr class="my-3">
            `;

			
			
            itemsContainer.appendChild(row);
			
			        // Attach event listeners for the newly added row
        const yesRadio = document.getElementById(`yes${rowIndex}`);
        const noRadio = document.getElementById(`no${rowIndex}`);
        const halfETDiv = document.getElementById(`HalfETDiv${rowIndex}`);
        const fullETDiv = document.getElementById(`FullETDiv${rowIndex}`);

        // Event listeners for yes/no radio buttons
        yesRadio.addEventListener('change', function() {
            if (yesRadio.checked) {
                halfETDiv.style.display = 'flex';
                fullETDiv.style.display = 'flex';
            }
        });

        noRadio.addEventListener('change', function() {
            if (noRadio.checked) {
                halfETDiv.style.display = 'none';
                fullETDiv.style.display = 'none';
            }
        });

            // File input handling
            const uploadInput = document.getElementById(`item_image${rowIndex}`);
            const cameraInput = document.getElementById(`item_photo${rowIndex}`);
            const consolidatedInput = document.getElementById(`consolidated_image_input${rowIndex}`);
            const previewList = document.getElementById(`preview-list${rowIndex}`);
            let allFiles = [];

			
				 
            // Update preview list and consolidate input
            function updatePreviewList(files) {
                Array.from(files).forEach(file => {
                    if (file && file.type.startsWith('image/')) {
                        const reader = new FileReader(); // Create a FileReader to read the file

                        // Event listener to execute when file is read
                        reader.onload = function(event) {
                            const imageElement = document.createElement('img'); // Create an img element
                            imageElement.src = event.target.result; // Set the source to the file content
                            imageElement.alt = file.name; // Set alt attribute to the file name
                            imageElement.style.width = '100px'; // Set a fixed width for preview (adjust as needed)
                            imageElement.style.height = '100px'; // Set a fixed height for preview (adjust as needed)
                            imageElement.style.margin = '5px'; // Add some margin for spacing
                       
                        // Show image in the corresponding modal
                        imageElement.addEventListener('click', function() {
                            const modalImage = document.getElementById(`modalImage${rowIndex}`);
                            modalImage.src = event.target.result;
                            $(`#imageModal${rowIndex}`).modal('show'); // Show modal
                        });

                        

                        const previewContainer = document.createElement('div');
                        previewContainer.appendChild(imageElement);
                    
                        previewList.appendChild(previewContainer);
                    };

                        reader.readAsDataURL(file); // Read the file as a data URL
                    }
                });
            }

            function updateConsolidatedInput() {
                const dataTransfer = new DataTransfer(); // Consolidate files
                allFiles.forEach(file => dataTransfer.items.add(file)); // Add each file
                consolidatedInput.files = dataTransfer.files; // Assign back to hidden input
            }

            // Event listener for file upload
            uploadInput.addEventListener('change', function(event) {
                const files = event.target.files;
                allFiles = allFiles.concat(Array.from(files)); // Add new files to the list
                updatePreviewList(files); // Update the preview
                updateConsolidatedInput(); // Update the consolidated input
            });

            // Event listener for camera input
            cameraInput.addEventListener('change', function(event) {
                const files = event.target.files;
                allFiles = allFiles.concat(Array.from(files)); // Add new files
                updatePreviewList(files);
                updateConsolidatedInput();
            });

            // Remove button handling
            row.querySelector('.remove-row-btn').addEventListener('click', function() {
                itemsContainer.removeChild(row); // Remove the row from the DOM
            });
        }

        // Add event listener to the "Add Item" button
        addItemRowBtn.addEventListener('click', addItemRow);
    });
		

</script>
		



<script>
$(document).ready(function() {
    $('#ConplaitOrder').DataTable({
        "searching": true,    // Enable the search feature
        "paging": false,      // Disable pagination
        "lengthChange": false, // Disable length change (entries selector)
        "info": false,        // Disable info
        "ordering": false     // Disable ordering
    });
});
</script>

<script>
    function searchTable() {
        const input = document.getElementById("searchInput").value.toLowerCase();
        const rows = document.querySelectorAll("#repairOrdersTable tr");

        rows.forEach((row, index) => {
            if (index === 0) return; // Skip the header row
            const columns = row.querySelectorAll("td");
            const match = Array.from(columns).some(td => td.innerText.toLowerCase().includes(input));
            row.style.display = match ? "" : "none";
        });
    }
</script>
		
		<script>
    function searchTable() {
        const input = document.getElementById("firstsearchInput").value.toLowerCase();
        const rows = document.querySelectorAll("#pendingOrdersTable tr");

        rows.forEach((row, index) => {
            if (index === 0) return; // Skip the header row
            const columns = row.querySelectorAll("td");
            const match = Array.from(columns).some(td => td.innerText.toLowerCase().includes(input));
            row.style.display = match ? "" : "none";
        });
    }
</script>
<script>
    document.getElementById("pending-repair-order-tab").addEventListener("click", function() {
        document.getElementById("orderHeading").innerText = "COMPLETE ORDERS";
    });
	document.getElementById("complete-repair-order-tab").addEventListener("click", function() {
        document.getElementById("orderHeading").innerText = "PENDING ORDERS";
    });
	document.getElementById("add-new-customer-tab").addEventListener("click", function() {
        document.getElementById("orderHeading").innerText = "CREATE ORDERS";
    });
	
</script>

<script>

function showImageModal(imageUrl, index) {
    // Set the image source for the specific modal
    document.getElementById(`modalImage${index}`).src = imageUrl;
    
    // Show the modal with the unique ID
    $(`#imageModal${index}`).modal('show');
}
	
	function newshowImageModal(imageUrl, index) {
    // Set the image source for the specific modal
    document.getElementById(`newmodalImage${index}`).src = imageUrl;
    
    // Show the modal with the unique ID
    $(`#newimageModal${index}`).modal('show');
}
</script>


@endsection

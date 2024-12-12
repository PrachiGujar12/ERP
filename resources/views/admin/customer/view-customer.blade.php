@extends('layouts.dashboard')
@section('title', 'View Customer')
@section('meta_description', 'System Dashboard.')
@section('content')

<div id="content">

    <!-- Page Heading -->
    <div class="d-flex gap-2 flex-column flex-md-row justify-content-between py-3 bg-light card-header" style="
    position: sticky;
    top: 0;
    z-index: 100;">
		 <a  href="{{route('customers.list')}}" class="btn JewelleryPrimaryAction">
                <i class="fas fa-arrow-left mr-2"></i> Back
            </a>
        <h4 class="h3"><i class="bi bi-person"></i> {{$customer->first_name}} {{$customer->last_name}}</h4>
        <div>
            @if($customer->whatsapp_no)
            <a href="https://wa.me/{{$customer->whatsapp_no}}" target="_blank" type="button"
                class="JewelleryPrimaryAction btn" title="WhatsApp"><i class="bi bi-whatsapp"></i> WhatsApp
            </a>
            @endif

            <!-- Call Button -->
            @if($customer->mobile_no)<a href="tel:{{$customer->mobile_no}}" class="JewelleryPrimaryAction btn"
                target="_blank" title="Call">
                <i class="bi bi-telephone-outbound"></i> Call
            </a>@endif

            <!-- Email Button -->
            @if($customer->email)
            <a href="mailto:{{$customer->email}}" class="JewelleryPrimaryAction btn" target="_blank" title="Email">
                <i class="bi bi-envelope"></i> Email
            </a>@endif

            <!-- Edit Button -->
            <a class="btn JewelleryPrimaryAction" title="Edit"
                href="{{ route('edit.customer', $customer->customer_id) }}">
                <i class="bi bi-pencil-square"></i> Edit
            </a>

           
        </div>
    </div>

    <!-- Begin Page Content -->
    <div class="container-fluid mt-4">

        <!-- Customer Details Table -->
        <div class="container-fluid customer__page">
            <div class="">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="card-header border bg-info text-light">
                            CUSTOMER DETAILS
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable44" width="100%" cellspacing="0">
                                <tbody>
                                    @if($customer->mobile_no)
                                    <tr>
                                        <th>Phone Number</th>
                                        <td colspan="2">{{ ''.substr($customer->mobile_no, 0, 4).' '.substr($customer->mobile_no, 4, 3).' '.substr($customer->mobile_no, 7, 3).' '.substr($customer->mobile_no, 10) }}</td>
                                    </tr>
                                    @endif

                                    @if($customer->address)
                                    <tr>
                                        <th>Address</th>
                                        <td colspan="2">{{$customer->address}}</td>
                                    </tr>
                                    @endif

                                    @if($customer->town)
                                    <tr>
                                        <th>Town</th>
                                        <td colspan="2">{{$customer->town}}</td>
                                    </tr>
                                    @endif
									
									@if($customer->county)
                                    <tr>
                                        <th>County</th>
                                        <td colspan="2">{{$customer->county}}</td>
                                    </tr>
                                    @endif

                                    @if($customer->post_code)
                                    <tr>
                                        <th>Postcode</th>
                                        <td colspan="2">{{ strtoupper($customer->post_code) }}</td>
                                    </tr>
                                    @endif
									
									@if($customer->note)
                                    <tr>
                                        <th>Note</th>
                                        <td colspan="2">{{$customer->note}}</td>
                                    </tr>
                                    @endif

                                    @if($customer->email)
                                    <tr>
                                        <th>Email</th>
                                        <td colspan="2">{{$customer->email}}</td>
                                    </tr>
                                    @endif

                                    @if($customer->gender)
                                    <tr>
                                        <th>Gender</th>
                                        <td colspan="2">{{$customer->gender}}</td>
                                    </tr>
                                    @endif

                                    @if($customer->religion)
                                    <tr>
                                        <th>Religion</th>
                                        <td colspan="2">{{$customer->religion}}</td>
                                    </tr>
                                    @endif

                                    @if($customer->facebook)
                                    <tr>
                                        <th>Facebook</th>
                                        <td colspan="2">{{$customer->facebook}}</td>
                                    </tr>
                                    @endif

                                    @if($customer->instagram)
                                    <tr>
                                        <th>Instagram</th>
                                        <td colspan="2">{{$customer->instagram}}</td>
                                    </tr>
                                    @endif

                                    @if($customer->tiktok)
                                    <tr>
                                        <th>TikTok</th>
                                        <td colspan="2">{{$customer->tiktok}}</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Due Details Table -->
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="card-header border bg-danger text-light">
                            DUE DETAILS
                        </div>
                        <div class="table-responsive" style="max-height: 40vh; overflow-y: auto;">
    <table class="table table-bordered" id="dataTable11" width="100%" cellspacing="0">
        <thead class="text-center" style="position: sticky; top: 0; background-color: #fff; z-index: 1;">
            <tr >
                <th>Invoice Number</th>
                <th>Date</th>
                <th>Invoice Amount</th>
                <th>Amount Paid</th>
                <th>Due Amount</th>
                <th>Due Date</th>
				
            </tr>
        </thead>
        <tbody class="text-center">
            @foreach($sales as $sale)
            <tr data-href="{{ route('customer.view.sales.items', $sale->sale_id) }}">
                <td>{{ $sale->sale_id }}</td>
                <td>{{ $sale->created_at->format('d-m-Y') }}</td>
                <td>£{{ number_format($sale->total_amount) }}</td>
                <td>£{{ number_format($sale->paid_amount) }}</td>
                <td>£{{ number_format($sale->due_amount) }}</td>
                <td>
					@if(\Carbon\Carbon::parse($sale->due_date) > \Carbon\Carbon::today())
						<button class="btn btn-success">{{ \Carbon\Carbon::parse($sale->due_date)->format('d-m-Y') }}</button>
					@else
						<button class="btn btn-danger">{{ \Carbon\Carbon::parse($sale->due_date)->format('d-m-Y') }}</button>
					@endif
				</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

                    </div>
                </div>

                <!-- Order Details Table -->
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="card-header border bg-success text-light">
                            ORDER DETAILS
                        </div>
                       <div class="table-responsive" style="max-height: 40vh; overflow-y: auto;">
    <table class="table table-bordered" id="dataTable22" width="100%" cellspacing="0">
                                <thead class="text-center" style="position: sticky; top: 0; background-color: #fff; z-index: 1;">
                                    <tr>
                                        <th>Order Number</th>
                                        <th>Order Status</th>
                                        <th>Estimate Amount</th>
                                        <th>Order Date</th>
                                        <th>Order Due Date</th>
                                        
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach($Orders as $Order)
                                    <tr data-href="{{ route('customer.order.view', $Order->id) }}">
										
                                        <td>{{ $Order->id }}</td>
                                        <td>
											@if($Order->order_status == "Pending")
											<button class="btn btn-danger">{{ $Order->order_status }}</button>
											@elseif($Order->order_status == "Completed")
											<button class="btn btn-success">{{ $Order->order_status }}</button>
											@else()
											<button class="btn btn-info">{{ $Order->order_status }}</button>
											@endif
										</td>
                                        <td>£{{ number_format($Order->estimate_amount) }}</td>
                                        <td>
                                            @if(\Carbon\Carbon::parse($Order->created_at)->gt(\Carbon\Carbon::now()))
                                            <button class="btn btn-secondary">
                                                {{ \Carbon\Carbon::parse($Order->created_at)->format('d-m-Y') }}

                                            </button>
                                            @else
                                            <button class="btn btn-secondary">
                                             	{{ \Carbon\Carbon::parse($Order->created_at)->format('d-m-Y') }}

                                            </button>
                                            @endif
                                        </td>
										<td>
                                            @if(\Carbon\Carbon::parse($Order->estimated_delivery_date)->gt(\Carbon\Carbon::now()))
                                            <button class="btn btn-success">
                                               {{ \Carbon\Carbon::parse($Order->estimated_delivery_date)->format('d-m-Y') }}

                                            </button>
                                            @else
                                            <button class="btn btn-danger">
                                             	{{ \Carbon\Carbon::parse($Order->estimated_delivery_date)->format('d-m-Y') }}

                                            </button>
                                            @endif
                                        </td>
										
										
                                        
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
				
				
				<!-- Order Details Table -->
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="card-header border bg-primary text-light">
                           REPAIR ORDER DETAILS
                        </div>
                       <div class="table-responsive" style="max-height: 40vh; overflow-y: auto;">
    <table class="table table-bordered" id="dataTable22" width="100%" cellspacing="0">
                                <thead class="text-center" style="position: sticky; top: 0; background-color: #fff; z-index: 1;">
                                    <tr>
                                        <th>Order Number</th>
                                        <th>Order Status</th>
                                        <th>Estimate Amount</th>
                                        <th>Order Date</th>
                                        <th>Order Due Date</th>
                                        
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach($RepairOrders as $Order)
                                    <tr data-href="{{ route('customer.repair.items.details', $Order->id) }}">
										
                                        <td>{{ $Order->id }}</td>
                                        <td>
											@if($Order->order_status == "Pending")
											<button class="btn btn-danger">{{ $Order->order_status }}</button>
											@elseif($Order->order_status == "Completed")
											<button class="btn btn-success">{{ $Order->order_status }}</button>
											@else()
											<button class="btn btn-info">{{ $Order->order_status }}</button>
											@endif
										</td>
                                        <td>£{{ number_format($Order->estimate_amount) }}</td>
                                        <td>
                                            @if(\Carbon\Carbon::parse($Order->created_at)->gt(\Carbon\Carbon::now()))
                                            <button class="btn btn-secondary">
                                                {{ \Carbon\Carbon::parse($Order->created_at)->format('d-m-Y') }}

                                            </button>
                                            @else
                                            <button class="btn btn-secondary">
                                             	{{ \Carbon\Carbon::parse($Order->created_at)->format('d-m-Y') }}

                                            </button>
                                            @endif
                                        </td>
										<td>
                                            @if(\Carbon\Carbon::parse($Order->estimated_delivery_date)->gt(\Carbon\Carbon::now()))
                                            <button class="btn btn-success">
                                               {{ \Carbon\Carbon::parse($Order->estimated_delivery_date)->format('d-m-Y') }}

                                            </button>
                                            @else
                                            <button class="btn btn-danger">
                                             	{{ \Carbon\Carbon::parse($Order->estimated_delivery_date)->format('d-m-Y') }}

                                            </button>
                                            @endif
                                        </td>
										
										
                                        
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- NC Details Table -->
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="card-header border bg-warning text-dark">
                            NC DETAILS
                        </div>
                        <div class="table-responsive" style="max-height: 40vh; overflow-y: auto;">
    <table class="table table-bordered" id="dataTable33" width="100%" cellspacing="0">
                                <thead class="text-center" style="position: sticky; top: 0; background-color: #fff; z-index: 1;">
                                    <tr>
                                        <th>NC Number</th>
                                        <th>Total Amount</th>
                                        <th>Paid Amount</th>
                                        <th>Due Amount</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach($ncsales as $ncsale)
                                    <tr data-href="{{ route('customer.view.NCsales.items', $ncsale->id) }}">
                                        <td>{{ $ncsale->id }}</td>
										
                                        <td>£{{ number_format($ncsale->total_cost) }}</td>
                                        
                                        <td>£{{ number_format($ncsale->paid_amount) }}</td>
										
                                        <td>£{{ number_format($ncsale->due_amount) }}</td>
                                        <td>{{$ncsale->created_at->format('d-y-m')}}</td>
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

   

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const tables = document.querySelectorAll('table');

        const observerOptions = {
            root: null, // Use the viewport as the root
            rootMargin: '0px', // No margin around the root
            threshold: 0.1 // 10% of the table should be visible to consider it in view
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-sticky');
                } else {
                    entry.target.classList.remove('is-sticky');
                }
            });
        }, observerOptions);

        // Observe each table for visibility changes
        tables.forEach(table => {
            observer.observe(table);
        });
    });
    </script>

</div>

@endsection

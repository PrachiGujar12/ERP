@extends('layouts.dashboard')
@section('title', 'Order Details')
@section('meta_description', 'Details for repair items.')
@section('content')

<div id="content">
	
	
	   <div class="d-flex gap-2 flex-column flex-md-row justify-content-between py-3 bg-light card-header" style="
    position: sticky;
    top: 0;
    z-index: 100;">
        <a href="{{route('order.details', $order->id )}}"><button class="JewelleryPrimaryButton">
			<i class="fas fa-arrow-left mr-2"></i> Back </button>
        </a>

        <h1 class="h2 mb-0 text-gray-800">ITEM DETAILS</h1>
<div>
	<a href=""><button class="JewelleryPrimaryButton d-none"><i class="bi bi-pencil-square"></i> Edit</button></a>

	<button class="JewelleryPrimaryButton" onclick="openWhatappAlert()">
    <i class="bi bi-bell-fill"></i> Karigar Reminder
</button>

        
    </div>
	
    </div>
	
	
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        

                            <!-- Success/Error Messages -->
                            @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            @if(session('error'))
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
        <!-- Content Row -->
        <div class="container-fluid customer__page my-4">
			
			<div class="card my-4">
                    <div class="card-body">
                       
						<div class="card-header border bg-info text-light">
                            CUSTOMER DETAILS
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable44" width="100%" cellspacing="0">
                                <tbody>
									@if($order->id)
                                    <tr>
                                        <th>Order Number</th>
                                        <td colspan="2">{{$order->id}}</td>
                                    </tr>
                                    @endif
									
									@if($order->customer->first_name)
                                    <tr>
                                        <th>Name</th>
                                        <td colspan="2">{{$order->customer->first_name}} {{$order->customer->last_name}}</td>
                                    </tr>
                                    @endif
                                    @if($order->customer->mobile_no)
                                    <tr>
                                        <th>Phone Number</th>
                                        <td colspan="2">{{ ''.substr($order->customer->mobile_no, 0, 4).' '.substr($order->customer->mobile_no, 4, 3).' '.substr($order->customer->mobile_no, 7, 3).' '.substr($order->customer->mobile_no, 10) }}</td>
                                    </tr>
                                    @endif

                                    @if($order->customer->address)
                                    <tr>
                                        <th>Address</th>
                                        <td colspan="2">{{$order->customer->address}} {{$order->customer->town}} {{$order->customer->county}} {{$order->customer->post_code}}</td>
                                    </tr>
                                    @endif
									

                                </tbody>
                            </table>
                        </div>
						
						
						<div class="card-header border bg-info text-light">
                            DATE
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable44" width="100%" cellspacing="0">
                                <tbody>
									
									
									@if($order->created_at)
                                    <tr>
                                        <th>Date Order Received</th>
                                        <td colspan="2">{{$order->created_at->format('d-m-Y')}} </td>
                                    </tr>
                                    @endif
									
									@if($order->estimated_delivery_date)
                                    <tr>
                                        <th>Due Date</th>
                                        <td colspan="2">{{ \Carbon\Carbon::parse($order->estimated_delivery_date)->format('d-m-Y') }}
</td>
                                    </tr>
                                    @endif

                                </tbody>
                            </table>
                        </div>
						
                    </div>
                </div>
			
            <div class="">
                <div class="card">
                    <div class="card-body">
						<div class="">
    
    <div class="row">
        <div class="col-12">
            <div class="card mb-3">
                <div class="card-body bg-light">
                    <form id="fillForm" action="{{ route('assign.karigar') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="itemIds" name="item_ids" value="{{ $item->repair_id }}">

                        

                        <div class="row mb-2">
                            <div class="col-6"><strong>Category:</strong></div>
                            <div class="col-6">
								<select class="" id="category" name="categoryy" required>
                                        <option value="" disabled selected>Select Karigar</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->category_id }}" {{ $category->category_id == $item->categoryy->category_id ? 'selected' : '' }}>{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
								
								</div>
                        </div>
<hr class="p-2">

                        <div class="row mb-2">
                            <div class="col-6"><strong>Metal Type:</strong></div>
                            <div class="col-6">
								
								<select class="" id="metal_type" name="metal_type" required>
                                        <option value="" disabled selected>Select Metal Type:</option>
                                        @foreach($itemTypes as $itemType)
                                            <option value="{{ $itemType->item_type_name }}" {{ $itemType->item_type_name == $item->metal_type ? 'selected' : '' }}>{{ $itemType->item_type_name }}</option>
                                        @endforeach
                                    </select>
								</div>
                        </div>

                        
<hr class="p-2">

                        <div class="row mb-2">
                            <div class="col-6"><strong>Weight:</strong></div>
							<div class="col-6">
    <input type="text" class="form-control" name="item_weight" value="{{ $item->item_weight }}" />
</div>

                            
                        </div>
<hr class="p-2">
						
						                        <div class="row mb-2">
                            <div class="col-6"><strong>Order Note:</strong></div>
                            <div class="col-6">
								
    <textarea class="form-control" name="description">{{ $item->description }}</textarea>


							</div>

                        </div>
<hr class="p-2">

                   <!--     <div class="row mb-2">
                            <div class="col-6"><strong>Customer Repair Cost:</strong></div>
                            <div class="col-6">{{ $item->amount }}</div>
                        </div>
<hr class="p-2"> -->

						<div class="row mb-2">
                            <div class="col-6"><strong>Image:</strong></div>
							<div class="col-6 row  m-0">
							  @if($item->photo)
								@php
									$photos = json_decode($item->photo, true); // Decode the JSON string into an array
								@endphp
								@foreach($photos as $photo)
									<img class="m-2" src="{{ asset('asset/images/orderitems/' . $photo) }}" alt="Item Image" style="width:auto; height:100px;">
								@endforeach
															@else
															N/A
															@endif
							</div>

                        </div>
						<hr class="p-2">
                        <div class="row mb-2">
                            <div class="col-6"><strong>Karigar Name:</strong></div>
                            <div class="col-6">
                                @if($item->Karigar)
                                    {{ $item->Karigar->karigar_name }}
                                @else
                                    <select class="" id="location" name="karigar" required>
                                        <option value="" disabled selected>Select Karigar</option>
                                        @foreach($karagirs as $karigar)
                                            <option value="{{ $karigar->karigar_id }}">{{ $karigar->karigar_name }}</option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                        </div>
<hr class="p-2">

                        <div class="row mb-2">
                            <div class="col-6"><strong>Karigar Repair Cost:</strong></div>
                            <div class="col-6">
                                @if($item->price)
                                    {{ $item->price }}
                                @else
                                    <input type="number" class="" id="itemInputPrice" min="0" name="itemInputPrice" placeholder="Enter karigar Repair Cost">
                                @endif
                            </div>
                        </div>
<hr class="p-2">

                        <div class="row mb-2">
                            <div class="col-6"><strong>Status:</strong></div>
                            <div class="col-6">
                                @if($item->status)
									@if($item->status == "Cancel")
										<button type="button" class="btn btn-danger">Cancelled</button>
									@else
										<button type="button" class="btn btn-success">{{$item->status}}</button>
                                	@endif
                                @else
                                    <button  type="button" class="btn btn-warning">Pending</button>
                                @endif
                            </div>
                        </div>
<hr class="p-2">

						<div class="row mb-2">
                            <div class="col-6"><strong>Assigned Date:</strong></div>
                            <div class="col-6">
                                @if($item->assigned_date)
                                    {{ \Carbon\Carbon::parse($item->assigned_date)->format('d-m-Y') }}
                                @else
                                    Not Available
                                @endif
                            </div>
                        </div>
						<hr class="p-2">
                        <div class="row mb-2">
                            <div class="col-6"><strong>Due Date:</strong></div>
                            <div class="col-6">
                                @if($order->estimated_delivery_date)
                                   @php
										$estimatedDeliveryDate = \Carbon\Carbon::parse($order->estimated_delivery_date);
									@endphp

									@if($estimatedDeliveryDate->isPast())
										<button class="btn btn-danger">{{ $estimatedDeliveryDate->format('d-m-Y') }}</button>
									@else
										{{ $estimatedDeliveryDate->format('d-m-Y') }}
									@endif

                                @else
                                    Not Available
                                @endif
                            </div>
                        </div>
<hr class="p-2">
                        <div class="row mb-2">
                            <div class="col-6"><strong>Received Date:</strong></div>
                            <div class="col-6">
                                @if($item->status == 'Assigned')
                                    <input type="date" name="received_date">
                                @else
                                    @if($item->received_date)
                                        {{ \Carbon\Carbon::parse($item->received_date)->format('d-m-Y') }}
                                    @else
                                        Not Assigned Yet
                                    @endif
                                @endif
                            </div>
                        </div>

						@if($item->status == "Cancel")
						@else
						<hr class="p-2">
                        <div class="row mb-2">
							
                            <div class="col-6"><strong>Action:</strong></div>
                            <div class="col-6">
                                @if($item->received_date)
                                    <button disabled class="btn btn-secondary">Update</button>
                                @else
                                    <button type="submit" class="btn btn-success">Update</button>
                                @endif
                               
								
                            </div>
                        </div>
						 @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
   
</div>
						
                    </div>
                </div>
            </div>

			
        </div>
    </div>
    <!-- /.container-fluid -->
</div>



<script>

	


</script>
@endsection
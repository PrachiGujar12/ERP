@extends('layouts.dashboard')
@section('title', 'Order Details')
@section('meta_description', 'Details for repair items.')
@section('content')

<div id="content">
	
	
	   <div class="d-flex gap-2 flex-column flex-md-row justify-content-between py-3 bg-light card-header" style="
    position: sticky;
    top: 0;
    z-index: 100;">
        <a href="{{route('customers.list')}}"><button class="JewelleryPrimaryButton">
			<i class="fas fa-arrow-left mr-2"></i> Back </button>
        </a>

        <h1 class="h2 mb-0 text-gray-800">ORDER DETAILS: {{$order->id}}</h1>
<div>
<button class="JewelleryPrimaryButton" onclick="openPrintAlert()">
    <i class="bi bi-printer"></i> Print
</button>
	<button class="JewelleryPrimaryButton" onclick="openWhatappAlert()">
    <i class="bi bi-share"></i> Send To
</button>
	@if($order->order_status == "Cancel")
	@else
	<button class="JewelleryPrimaryButton" onclick="openCancelAlert()">
    <i class="bi bi-x-circle"></i> Cancel Order
</button>
	@endif
        
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
        <div class="customer__page my-4">
            <div class="">
                <div class="card">
                    <div class="card-body">
						<div class="">
							
							<div class="">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable123456" width="100%" cellspacing="0">
                                            <thead class="text-center">
                                                <tr>
                                                    <th>Item ID</th>
                                                    <th>Customer Name</th>
                                                    <th class="mobile-column">Mobile Number</th>
                                                    <th class="note-column">Order Description</th>
                                                    <th >Date Order Given</th>
                                                    <th>Order Due Date</th>
                                                    <th>Karigaar Code</th>
													
                                                    <th>Assigned to Karigaar</th>
                                                    <th>Images</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-center">
                                                @foreach($items as $item)
                                                
													<tr>

                                                    <td>{{$item->repair_id}}</td>
                                                    <td>{{$order->customer->first_name}}</td>
                                                    <td class="mobile-column">{{ ''.substr($order->customer->mobile_no, 0, 4).' '.substr($order->customer->mobile_no, 4, 3).' '.substr($order->customer->mobile_no, 7, 3).' '.substr($order->customer->mobile_no, 10) }}</td>
                                                    
                                                    <td class="note-column">
														{{$item->description}}
                                                    </td>
                                                    <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($order->estimated_delivery_date)->format('d-m-Y') }}
</td>
                                                    <td>
														@if($item->karigar_id)
														{{ $item->karigar_id}}
														@else
														N/A
														@endif
													</td>
													
                                                    <td>
														@if($item->status)
														@if($item->status == "Cancel")
															<button type="button" class="btn btn-danger">Cancelled</button>
														@else
															<button type="button" class="btn btn-success">{{$item->status}}</button>
														@endif
														@else
															<button class="btn btn-warning">Pending</button>
														@endif
													</td>
													
                                                    <td>
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
													</td>
													<td><button type="button" class="btn btn-primary m-1"  onclick="openActionAlert()">Action</button>
														<a class="btn btn-success m-1" href="{{ route('customer.repair.order.details', ['order_no' => $order->id, 'itemid' => $item->repair_id]) }}">View</a></td>
													
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
			
			
						<div class="card my-4">
                    <div class="card-body">
                        
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable44" width="100%" cellspacing="0">
                                <tbody>
									
									@if($order->estimate_amount)
                                    <tr>
                                        <th >Estimated Cost</th>
                                        <td colspan="10">£{{ number_format($order->estimate_amount) }}</td>
                                    </tr>
                                    @endif
                                    @foreach($orderpayments as $orderpayment)
                                    <tr>
                                        <th >Deposit Paid By {{$orderpayment->payment_type}}</th>
                                        <td colspan="5">£{{ number_format($orderpayment->amount) }}</td>
                                        <td colspan="5">{{$orderpayment->created_at->format('d-m-Y')}}</td>
										
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
			
			
			<div class="card my-4">
                    <div class="card-body">
                        
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable44" width="100%" cellspacing="0">
                                <tbody>
									
									@if($order->estimate_amount)
                                    <tr>
                                        <th >Amount Return</th>
                                        <td colspan="10">£{{ number_format($orderReturnPaymentsTotal) }}</td>
                                    </tr>
                                    @endif
									
									
                                    @foreach($orderreturnpayments as $orderreturnpayment)
                                    <tr>
                                        <th >Deposit Return By {{$orderreturnpayment->payment_type}}</th>
                                        <td colspan="5">£{{ number_format($orderreturnpayment->amount) }}</td>
                                        <td colspan="5">{{$orderreturnpayment->created_at->format('d-m-Y')}}</td>
										
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
			
			
        </div>
    </div>
    <!-- /.container-fluid -->
</div>



<script>
	@php
        $filteredItems = $items->reject(function ($item) {
            return $item->status === 'Cancel';
        })->values()->toArray();  // Convert the result to an array
    @endphp

    const items = @json($filteredItems);

	
function openActionAlert() {
	
    Swal.fire({
        title: '',
        showCancelButton: true,
        confirmButtonText: 'Make As Received',
        cancelButtonText: 'Send Karigar Reminder',
    }).then((result) => {
        if (result.isConfirmed) {
            
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            // External print logic here (open print dialog for external printers)
            // You may replace this with a specific external print function
           // window.print(); // Adjust as needed
        }
    });
}
	
	
function openPrintAlert() {
    Swal.fire({
        title: 'Print Options',
        showCancelButton: true,
        confirmButtonText: 'Internal Print',
        cancelButtonText: 'External Print',
    }).then((result) => {
        if (result.isConfirmed) {
            // Internal print logic here
            window.print(); // This can be customized
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            // External print logic here (open print dialog for external printers)
            // You may replace this with a specific external print function
            window.print(); // Adjust as needed
        }
    });
}
	
	function openWhatappAlert() {
    Swal.fire({
        title: 'Send To',
        showCancelButton: true,
        confirmButtonText: 'Karigar',
        cancelButtonText: 'Client',
    }).then((result) => {
        if (result.isConfirmed) {
            // Internal print logic here
            //window.print(); // This can be customized
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            // External print logic here (open print dialog for external printers)
            // You may replace this with a specific external print function
           // window.print(); // Adjust as needed
        }
    });
}
	
function openCancelAlert() {
	const items = @json($items);
    Swal.fire({
        title: 'Cancel Order',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No',
    }).then((result) => {
        if (result.isConfirmed) {
            openselectitemAlert(items);
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            // External print logic here (open print dialog for external printers)
            // You may replace this with a specific external print function
           // window.print(); // Adjust as needed
        }
    });
}
	
function openselectitemAlert() {
	
	
    // Generate checkboxes dynamically
    let checkboxHtml = '';
    items.forEach(item => {
		console.log(item);
        checkboxHtml += `<div>
            <input type="checkbox" name="items[]" value="${item.repair_id}" id="item_${item.repair_id}">
            <label for="item_${item.repair_id}">Item ${item.repair_id} {{ $item->categoryy->category_name }}</label>
        </div>`;
    });

    Swal.fire({
        title: 'Select Items',
        html: `<form id="itemsForm" action="{{ route('remove.repair.item') }}" method="POST">@csrf ${checkboxHtml}</form>`,
        showCancelButton: true,
        confirmButtonText: 'Selected',
        cancelButtonText: 'Cancel',
        preConfirm: () => {
				// Get all checkboxes
				let checkboxes = document.querySelectorAll('input[name="items[]"]');

			
				// Get selected checkboxes
				let selectedItems = document.querySelectorAll('input[name="items[]"]:checked');
			

				// If no items are selected, show validation error
				if (selectedItems.length === 0) {
					Swal.showValidationMessage('Please select at least one item');
					return false;
				}

				// Check if all items are selected
				let allSelected = Array.from(checkboxes).every(checkbox => checkbox.checked);
					

				// If only some items are selected, return false (partial selection)
				if (checkboxes.length === selectedItems.length) {
					return true;
				}
			
				
			}
    }).then((result) => {
		
        if (result.isConfirmed) {
			
			let checkboxes = document.querySelectorAll('input[name="items[]"]');
				// Get selected checkboxes
				let selectedItems = document.querySelectorAll('input[name="items[]"]:checked');
			
            if (checkboxes.length === selectedItems.length) {
                // If all items are selected, show the next alert
                openReturnAlert();
            } else {
				console.log("vishal");
                // If not all items are selected, submit the form to remove selected items
                document.getElementById('itemsForm').submit();
            }
        }
    });
}

function openReturnAlert() {
    Swal.fire({
        title: 'Choose Option',
        input: 'radio',
        inputOptions: {
            needmoney: 'Need Money',
            bygold: 'By Gold'
        },
        inputValidator: (value) => {
            if (!value) {
                return 'You need to choose an option!';
            }
        },
        showCancelButton: true,
        confirmButtonText: 'Next',
    }).then((result) => {
        if (result.isConfirmed) {
            if (result.value === 'needmoney') {
                openReturnTypeAlert();
            } else if (result.value === 'bygold') {
                window.location.href = '/get-gold-form-order';
            }
        }
    });
}

function openReturnTypeAlert() {
    Swal.fire({
        title: 'Enter Amount Details',
        html:
			
            '<form id="itemsForm" action="{{ route('remove.repair.order') }}" method="POST">@csrf <input id="amount_by_cash" name="cashamount" class="swal2-input" placeholder="Amount by Cash" type="number">' +
            '<input name="orderid" value="{{$order->id}}" type="hidden">'+
            '<input id="amount_by_card" class="swal2-input" placeholder="Amount by Card" name="cardamount" type="number"></form>',
        focusConfirm: false,
        showCancelButton: true,
        confirmButtonText: 'Confirm',
        preConfirm: () => {
            const cashAmount = document.getElementById('amount_by_cash').value;
            const cardAmount = document.getElementById('amount_by_card').value;

            // Validate input amounts
            if (!cashAmount || !cardAmount) {
                Swal.showValidationMessage('Please enter both amounts.');
                return false; // Prevents the modal from closing
            }

            // If validation passes, return true to proceed with form submission
            return { cashAmount, cardAmount }; // Return the amounts for further use if needed
        }
    }).then((result) => {
        if (result.isConfirmed) {
            const cashAmount = result.value.cashAmount;
            const cardAmount = result.value.cardAmount;

            // You can use the amounts if needed here (e.g., sending them with the form)
            console.log(`Cash Amount: ${cashAmount}, Card Amount: ${cardAmount}`);

            // Submit the form to remove items after amount confirmation
            document.getElementById('itemsForm').submit();
        }
    });
}


</script>
@endsection
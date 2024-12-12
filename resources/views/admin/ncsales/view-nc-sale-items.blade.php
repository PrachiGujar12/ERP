@extends('layouts.dashboard')
@section('title', 'NC Sale')
@section('meta_description', 'System user list.')
@section('content')

<div id="content">
	
	<div class="d-flex gap-2 flex-column flex-md-row justify-content-between py-3 bg-light card-header" style="
    position: sticky;
    top: 0;
    z-index: 100;">
		<a href="{{route('ncsaleslist')}}" class="JewelleryPrimaryButton"><button>
							<i class="fas fa-arrow-left mr-2"></i> Back
			</button></a>
            <div class=" mb-2 mb-md-0 p-0">
                <h6 class="h2 mb-0 text-gray-800">Nc Sale - {{$salesItems->id}}</h6>
            </div>
		<div>
			@if($salesItems->customer->whatsapp_no)
			<button class="JewelleryPrimaryButton" onclick="openWhatsAppAlert()">
    <i class="bi bi-whatsapp"></i> WhatsApp
</button>@endif
		<button class="JewelleryPrimaryButton"><i class="bi bi-telephone"></i> Call</button>
			

<button class="JewelleryPrimaryButton" onclick="openPrintAlert()">
    <i class="bi bi-printer"></i> Print
</button>
			
		<button class="JewelleryPrimaryButton" onclick="openAddPaymentAlert()">
    + Add Payment
</button>

            </div>
		
		
		
	</div>
	
	
    <!-- Begin Page Content -->
    <div class="">
        <!-- Page Heading -->
        <!-- Content Row -->
        <div class="">
            <div class="container-fluid ">
				@if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                                @endif
                                @if(session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                                @endif
				
				<div class="card my-4">
                    <div class="card-body">
                        <div class="card-header border bg-info text-light">
                            CUSTOMER DETAILS
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable44" width="100%" cellspacing="0">
                                <tbody>
									
									@if($salesItems->customer->first_name)
                                    <tr>
                                        <th>Name</th>
                                        <td colspan="2">{{$salesItems->customer->first_name}} {{$salesItems->customer->last_name}}</td>
                                    </tr>
                                    @endif
                                    @if($salesItems->customer->mobile_no)
                                    <tr>
                                        <th>Phone Number</th>
                                        <td colspan="2">{{ ''.substr($salesItems->customer->mobile_no, 0, 4).' '.substr($salesItems->customer->mobile_no, 4, 3).' '.substr($salesItems->customer->mobile_no, 7, 3).' '.substr($salesItems->customer->mobile_no, 10) }}</td>
                                    </tr>
                                    @endif

                                    @if($salesItems->customer->address)
                                    <tr>
                                        <th>Address</th>
                                        <td colspan="2">{{$salesItems->customer->address}}</td>
                                    </tr>
                                    @endif

                                    @if($salesItems->customer->town)
                                    <tr>
                                        <th>Town</th>
                                        <td colspan="2">{{$salesItems->customer->town}}</td>
                                    </tr>
                                    @endif
									
									@if($salesItems->customer->county)
                                    <tr>
                                        <th>County</th>
                                        <td colspan="2">{{$salesItems->customer->county}}</td>
                                    </tr>
                                    @endif

                                    @if($salesItems->customer->post_code)
                                    <tr>
                                        <th>Postcode</th>
                                        <td colspan="2">{{$salesItems->customer->post_code}}</td>
                                    </tr>
                                    @endif
									
									@if($salesItems->customer->note)
                                    <tr>
                                        <th>Note</th>
                                        <td colspan="2">{{$salesItems->customer->note}}</td>
                                    </tr>
                                    @endif

                                    @if($salesItems->customer->email)
                                    <tr>
                                        <th>Email</th>
                                        <td colspan="2">{{$salesItems->customer->email}}</td>
                                    </tr>
                                    @endif

                                    @if($salesItems->customer->gender)
                                    <tr>
                                        <th>Gender</th>
                                        <td colspan="2">{{$salesItems->customer->gender}}</td>
                                    </tr>
                                    @endif

                                    @if($salesItems->customer->religion)
                                    <tr>
                                        <th>Religion</th>
                                        <td colspan="2">{{$salesItems->customer->religion}}</td>
                                    </tr>
                                    @endif

                                    @if($salesItems->customer->facebook)
                                    <tr>
                                        <th>Facebook</th>
                                        <td colspan="2">{{$salesItems->customer->facebook}}</td>
                                    </tr>
                                    @endif

                                    @if($salesItems->customer->instagram)
                                    <tr>
                                        <th>Instagram</th>
                                        <td colspan="2">{{$salesItems->customer->instagram}}</td>
                                    </tr>
                                    @endif

                                    @if($salesItems->customer->tiktok)
                                    <tr>
                                        <th>TikTok</th>
                                        <td colspan="2">{{$salesItems->customer->tiktok}}</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
				
                <div class="card my-4 p-4">
					
					
                    <!-- Tab panes -->
                    <div class="tab-content" id="pills-tabContent">
						<div class="d-sm-flex align-items-center justify-content-between mb-4">
						<div>
							<h1 class="h5 mb-0 text-gray-800"></h1>
						</div>
						<div>	
						
						</div>
						</div>
							

						<p>{{$salesItems->status}}</p>
                        <div class="tab-pane fade show active" id="pills-customer" role="tabpanel"
                            aria-labelledby="pills-customer-tab">
                            <div class="card mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-warning">
                                       Items List
                                    </h6>
                                </div>
                                
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable123" width="100%" cellspacing="0">
                                            <thead class="text-center" style="background-color:#df9700; color:#fff">
                                                <tr>
                                                    <th>Date Reserved</th>
                                                    <th>Category</th>
                                                    <th>Metal Type</th>
                                                    
                                                    <th>Item Weight</th>
                                                    
                                                    <th> Amount</th>
                                                    <th> Action</th>
													
                                                </tr>
                                            </thead>

                                            <tbody class="text-center">
                                                @foreach($stockItems as $stockItem)
                                                <tr>
                                                    <td>{{ \Carbon\Carbon::parse($salesItems->date)->format('d-m-Y') }}
														
													</td>
                                                    <td>{{ $stockItem->category }}</td>
                                                    <td>{{ $stockItem->metal_type }}</td>
                                                    
                                                    <td>{{ $stockItem->item_weight }}</td>
                                                    
                                                    <td>£{{ number_format($stockItem->sale_amount) }}</td>
													<td><button class="btn btn-primary" onclick="openActionAlert({{ $stockItem->item_id }}, {{ $salesItems->id }})">Action</button>
</td>
													
                                                </tr>
                                                @endforeach
												<tr>
													<td colspan="4">NC Total</td>
													<td>£{{ number_format($salesItems->total_cost) }}</td>
												</tr>
												<tr>
													<td colspan="4">NC Paid Amount</td>
													<td>£{{ number_format($salesItems->paid_amount) }}</td>
												</tr>
												<tr>
													<td colspan="4">NC Due Amount</td>
													<td>£{{ number_format($salesItems->due_amount) }}</td>
												</tr>
												
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                </div>
								
								<div class="card mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-warning">
                                       Payment Details
                                    </h6>
                                </div>
								<div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable1213" width="100%" cellspacing="0">
                                            <thead class="text-center" style="background-color:#df9700; color:#fff">
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Payment Type</th>
                                                    <th>Amount Paid</th>
                                                </tr>
                                            </thead>

                                            <tbody class="text-center">
                                                @foreach($ncpaymentdeatils as $index => $stockItem)
												
                                                <tr>
                                                    <td>{{ \Carbon\Carbon::parse($stockItem->created_at)->format('d-m-Y') }}</td>
                                                    
                                                    
                                                    <td>{{ $stockItem->payment_type }}</td>
                                                    

                                                    <td>£{{ number_format($stockItem->amount) }}</td>
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
        </div>
    </div>
    <!-- Content Row -->
</div>
<!-- Hidden remove item form -->
<form id="removeItemForm" action="" method="POST" style="display: none;">
    @csrf
    @method('POST')
</form>

<script>
function openWhatsAppAlert() {
    Swal.fire({
        title: 'WhatsApp Options',
        showCancelButton: true,
        confirmButtonText: 'Message',
        cancelButtonText: 'Send PDF',
        preConfirm: (value) => {
            if (!value) {
                return false;
            }
        }
    }).then((result) => {
        if (result.isConfirmed) {
            // Open WhatsApp with a pre-filled message
            window.open('https://wa.me/{{ $salesItems->customer->whatsapp_no }}?text=Your%20message%20here', '_blank');
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            // Open WhatsApp for sending a file (like a PDF)
            window.open('https://wa.me/{{ $salesItems->customer->whatsapp_no }}', '_blank');
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

function openAddPaymentAlert() {
    Swal.fire({
        title: 'Add Payment',
        html: `
            <form id="addPaymentForm" action="{{ route('update.NCsale.payment', $salesItems->id) }}" method="POST">
                @csrf
                <input id="cash" name="AmountPaidByCash" type="number" class="swal2-input" placeholder="Enter cash amount" min="0" step="0.01">
                <input id="card" name="AmountPaidByCard" type="number" class="swal2-input" placeholder="Enter card amount" min="0" step="0.01">
                <input id="gold" name="AmountPaidByGold" type="number" class="swal2-input" placeholder="Enter gold amount" min="0" step="0.01">
                <input id="transaction_id" name="transaction_id" type="text" class="swal2-input" placeholder="Transaction ID (for card payments)" style="display:none">
                <input id="InternalGoldREF" name="InternalGoldREF" type="text" class="swal2-input" placeholder="Gold Ref Number (for gold payments)" style="display:none">
            </form>
        `,
        focusConfirm: false,
        showCancelButton: true,
        confirmButtonText: 'Submit',
        preConfirm: () => {
            const cash = document.getElementById('cash').value;
            const card = document.getElementById('card').value;
            const gold = document.getElementById('gold').value;

            if (!cash && !card && !gold) {
                Swal.showValidationMessage('Please enter at least one payment method (Cash, Card, or Gold)');
                return false; // Stop form submission
            }
        }
    }).then((result) => {
        if (result.isConfirmed) {
            // Submit the form when at least one payment method is provided
            document.getElementById('addPaymentForm').submit();
        }
    });
}

function openActionAlert(itemId, ncsaleId) {
    Swal.fire({
        title: 'Select an Action',
        showCancelButton: true,
        confirmButtonText: 'Remove This Item',
        cancelButtonText: 'Edit Amount',
    }).then((result) => {
        if (result.isConfirmed) {
            // Show confirmation for removal
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, remove it!',
                cancelButtonText: 'No, keep it'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the hidden form to the remove route
                    const form = document.getElementById('removeItemForm');
                    form.action = `/raman-jeweller-erp/public/remove-nc-sale-item/${itemId}/${ncsaleId}`;
                    form.submit();
                }
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            // Open edit amount alert
            openEditAmountAlert(itemId, ncsaleId);
        }
    });
}


function openEditAmountAlert(itemId, ncsaleId) {
    Swal.fire({
        title: 'Edit Amount',
        html: `
          <form id="updateItemPriceForm" method="POST">
            @csrf
            @method('POST')
            <input id="amount" type="number" name="amount" class="swal2-input"  min="0" step="0.01" placeholder="Enter Amount" required>
          </form>
        `,
        focusConfirm: false,
        showCancelButton: true,
        confirmButtonText: 'Submit',
        preConfirm: () => {
            const amount = document.getElementById('amount').value;

            if (!amount) {
                Swal.showValidationMessage('Please enter a valid amount');
                return false;
            }

            // Update the form action dynamically
            const form = document.getElementById('updateItemPriceForm');
            form.action = `/raman-jeweller-erp/public/update-nc-sale-item-price/${itemId}/${ncsaleId}`; // Update the form action with itemId and ncsaleId

            // Submit the form manually
            form.submit();
        }
    });
}



	</script>
@endsection

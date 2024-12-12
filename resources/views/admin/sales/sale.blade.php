@extends('layouts.dashboard')
@section('title', 'Create Sale Order')
@section('meta_description', 'System user list.')
@section('content')

<div id="content">
	
	<div class="d-flex gap-2 flex-column flex-md-row justify-content-between py-3 bg-light card-header" style="
    position: sticky;
    top: 0;
    z-index: 100;"><a href="{{url('sales-list')}}"
                                    class="  JewelleryPrimaryButton" id="backButton">
                                    <i class="bi bi-arrow-left"></i> Back
                                </a>
                            <h6 class="h3 mb-0 text-gray-800">CREATE SALES ORDER</h6>
                            <!--<p id="date"></p>-->
                            <div class="text-center d-flex gap-2">
								
								<button class="JewelleryPrimaryButton" data-toggle="modal" data-target="#simpleModal"> <i class="bi bi-person-add"></i> Add Customer</button>

                                
                            </div>
                        </div>
    <!-- Begin Page Content -->
    <div class="container-fluid">
		
		
        <!-- Begin Page Content -->
        <div class="customer__page">
			
            <div class="">
                <form id="customerForm" action="{{ route('store.sale') }}" method="POST">
                    @csrf
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
                    <input type="hidden" id="itemIds" name="item_ids" value="">
                    <input type="hidden" id="itemamount" name="item_amount" value="">
					
					@if(session('customer')) 
					<input type="hidden" id="customerId" name="customer_id"  value="{{ session('customer')->customer_id }}">
					@else
                    <input type="hidden" id="customerId" name="customer_id" />
					@endif
                    <input type="hidden" id="totalAmount" name="total_amount" />


                    <div class="col-12 py-3 mt-3 card ">
                        

                        <div class=" py-0" >
                            <div class="col-md-12 ">
								
								
                                <div class="">
                                    <div class="form__fields p-0">
                                   @if(session('customer'))     
							<input class="form-control" type="text" id="search" placeholder="Enter mobile number or name of customer" value="{{ session('customer')->mobile_no }}">
										@else
										<input  class="form-control" type="text" id="search" placeholder="Enter mobile number or name of customer">
										@endif
									<ul id="customer-list"></ul>

									@if(session('customer'))     
									<div id="customer-details" class="mt-3" style="">
										<h2>{{ session('customer')->first_name }}</h2>
										<p>Mobile: 
    {{ substr(session('customer')->mobile_no, 0, 4) . ' ' . substr(session('customer')->mobile_no, 4, 3) . ' ' . substr(session('customer')->mobile_no, 7, 3) }}
</p>

										<p>Email: {{ session('customer')->email ?? 'N/A'  }}</p>
										<p>Address: {{ session('customer')->address ?? 'N/A'  }}</p>
									</div>
									@else
									<div id="customer-details" class="mt-3" style="display: none;"></div>
									@endif
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="card mt-2 border-0">
                                            <div class="card-body p-0" id="customerDetails">
                                                <!-- Customer details will be inserted here -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 ">
                                <div class="form-row">
                                    <!-- Date input -->
                                    <div class="col-md-6 form__fields d-none" >
                                        <label for="dateInput" class="form-label">Date</label>
                                        <input type="date" name="date" class="form-control" id="dateInput" />
                                    </div>


                                    <!-- Invoice Number -->
                                    <div class="col-md-6 form__fields d-none">
                                        <label for="invoiceNumber" class="form-label">Invoice Number</label>
                                        <input type="text" class="form-control" name="invoice_no" id="invoiceNumber"
                                            placeholder="Invoice Number" />
                                    </div>
                                    <!-- Selling Person Id -->
                                    <div class="col-md-6 form__fields d-none">
                                        <label for="sellingPersonId" class="form-label">Selling Person Id</label>
                                        <input type="text" class="form-control" name="selling_person_id"
                                            id="sellingPersonId" placeholder="Selling Person Id" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 p-0 mt-3 card ">
                        
                        <div class="card-body">
                        <div class="d-flex justify-content-center">
                        <div class="col-8">

                            <div class="form-row originalRow" id="ItemAdditionFormRow">
                                <div class="col-8 form__fields">
                                    <label for="textInput" class="form-label">Item Barcode</label>
                                    <input type="text" class="form-control" id="itemName" name="item_id"
                                        placeholder="Scan Item Barcode" />
                                </div>

                                <div class="col-4 form__fields align-items-end d-flex">
                                    <button type="button" class="JewelleryPrimaryButton" id="addnewItem">
                                        Add Item
                                    </button>
                                </div>
                            </div>
                            </div>
                            </div>
							

                            <div class="table-responsive">
								<table class="table table-bordered" id="itemTable">
									<thead class="thead-dark">
										<tr>
											<th>Item Id</th>
											<th>Category</th>
											<th>Metal Type</th>
											
											<th>Weight</th>
											<th>Amount</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<!-- Dynamically added rows will go here -->
									</tbody>
									<tfoot>
										<tr>
											<th colspan="5" class="text-right">Grand Total</th>
											<th id="grandTotal">$0</th>
										</tr>
									</tfoot>
								</table>
							</div>
                        </div>
                    </div>


                    <div class="my-3 card ">
						
						<div class="card-header">
							<h5 >Payment Mode</h5>
						</div>
                        <div class="">
                            
                            <!-- 
                            <div class="d-flex mb-3" style="gap: 30px">
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label pr-3" for="cashCheckbox">Cash</label>
                                    <input class="form-check-input" type="checkbox" id="cashCheckbox"
                                        onclick="toggleField('cash')" />
                                </div>
                                
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label pr-3" for="cardCheckbox">Card</label>
                                    <input class="form-check-input" type="checkbox" id="cardCheckbox"
                                        onclick="toggleField('card')" />
                                </div>

                            </div>-->
							
							<div class="col-md-12 form__fields"  style="display: flex">
								<label for="note" class="form-label col-sm-2 col-form-label">Note</label>

								<textarea class="form-control col-sm-10" id="note" row="6" name="note" placeholder="Enter Note">{{ old('note') }}</textarea>

							</div>
							
                            <div id="cashField" class="mb-3 form__fields" style="display: flex">
                                <label for="cashAmount" class="form-label col-sm-2 col-form-label">Cash
                                    Amount</label>
                                <input type="number" class="form-control col-sm-4" id="cashAmount" value="" name="cash_payment"
                                    placeholder="Enter cash amount" />
                            </div>

                            <div id="cardField" class="mb-3 form__fields" style="display: flex">
                                <label for="cardAmount" class="form-label col-sm-2 col-form-label">Card
                                    Amount</label>
                                <input type="number" class="form-control col-sm-4" id="cardAmount" value="" name="card_payment"
                                    placeholder="Enter card amount" />
                                <label for="voucherAmount" class="form-label col-sm-2 col-form-label">Transaction
                                    id</label>
                                <input type="number" class="form-control col-sm-4" id="voucherAmount"
                                    name="transaction_id" placeholder="Transaction id" />
                            </div>
							
							<div id="cardField" class="mb-3 form__fields" style="display: flex">
                                <label for="goldAmount" class="form-label col-sm-2 col-form-label">
                                    Amount Paid By Gold</label>
                                <input type="number" class="form-control col-sm-4" id="goldAmount" value="" name="gold_Amount"
                                    placeholder="Enter Amount By Gold" />
                                
								
								
                            </div>
							<div id="dueDateDiv" class="form__fields d-flex"></div>
							<div id="paymentModeDiv" class="form__fields"></div>
							

							<input type="hidden" id="due_amount" name="due_amount" value="">
                            <!-- Submit Button -->
                           
                        </div>
                    </div>
					
					 <div class="mb-3 mr-3 d-flex justify-content-end ">
                                <button type="submit" class="JewelleryPrimaryButton">
                                    Submit
                                </button>
								
                            </div>
                </form>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.container-fluid -->
</div>

<!-- Add New Customer Modal -->
<div class="modal fade" id="simpleModal" tabindex="-1" role="dialog" aria-labelledby="simpleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
			<form class="form-sample" action="{{ route('store.customer') }}" enctype="multipart/form-data" method="POST">
                                @csrf
            <div class="modal-header">
                <h5 class="modal-title text-warning h4" id="simpleModalLabel">Add New Customer</h5>
				<div>
				<button type="submit" class="JewelleryPrimaryButton ml-2"><i class="bi bi-floppy-fill"></i> Save</button>
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
								<div><a href="{{route('customers.list')}}"<button class="JewelleryPrimaryButton gap-2 btn-primary"> <i class="bi bi-arrow-left"></i> Back</button></a>
									
                                </div>
                                </div> -->
                           
				<div class="MainForm">
                                <div class="row g-3" style="overflow-y: scroll; height: 60vh;">
									<!-- First Name -->
                                    <div class="col-md-12 form__fields">
                                        <label for="firstName" class="form-label">First Name*</label>
                                    
                                   
                                        <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="firstName" name="first_name" placeholder="Enter First Name" value="{{ old('first_name') }}" required />
                                        @error('first_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Last Name -->
                                    <div class="col-md-12 form__fields">
                                        <label for="lastName" class="form-label">Last Name*</label>
                                   
                                        <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="lastName" name="last_name" placeholder="Enter Last Name" value="{{ old('last_name') }}" required/>
                                        @error('last_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
									
									<!-- Mobile Number -->
                                     <div class="col-md-12 form__fields">
                                        <label for="mobileNo" class="form-label">Mobile Number*</label>
                                    
                                        <input type="text" class="form-control @error('mobile_no') is-invalid @enderror" id="mobileNo" name="mobile_no" placeholder="Enter Mobile Number" value="{{ old('mobile_no') }}" required />
                                        @error('mobile_no')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
									
									<!-- Address -->
                                     <div class="col-md-12 form__fields">
                                        <label for="address" class="form-label">Address</label>
                                    
                                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" placeholder="Enter Address" value="{{ old('address') }}" />
                                        @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
									
									<!-- town -->
                                     <div class="col-md-12 form__fields">
                                        <label for="town" class="form-label">Town</label>
                                    
                                        <input type="text" class="form-control @error('town') is-invalid @enderror" id="town" name="town" placeholder="Enter town" value="{{ old('town') }}" />
                                        @error('town')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
									
									<!-- county  -->
                                     <div class="col-md-12 form__fields">
                                        <label for="county" class="form-label">County</label>
                                    
                                        <input type="text" class="form-control @error('county') is-invalid @enderror" id="county" name="county" placeholder="Enter county" value="{{ old('county') }}" />
                                        @error('county')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
									
									
									<!-- Post Code -->
                                     <div class="col-md-12 form__fields">
                                        <label for="post-code" class="form-label">Post Code</label>
                                    
                                        <input type="text" class="form-control @error('post-code') is-invalid @enderror" id="post-code" name="post_code" placeholder="Enter Post Code"  value="{{ old('post_code') }}" />
                                        @error('post-code')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

									<!-- note  -->
                                     <div class="col-md-12 form__fields">
                                        <label for="note" class="form-label">Note</label>
                                    
                                        <textarea class="form-control @error('note') is-invalid @enderror" id="note" row="6" name="note" placeholder="Enter Note" >{{ old('note') }}</textarea>
                                        @error('note')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
									

                                    <!-- Email -->
                                    <div class="col-md-12 form__fields">
                                        <label for="email" class="form-label">Email</label>
                                    
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter Email"  value="{{ old('email') }}"/>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Gender -->
                                     <div class="col-md-12 form__fields">
                                        <label for="gender" class="form-label">Gender</label>
                                    
                                        <select class="form-control @error('gender') is-invalid @enderror" id="gender" name="gender" >
                                            <option value="" selected>--Select Gender--</option>
                                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                        </select>
                                        @error('gender')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    
                                    <!-- Date of Birth -->
                                     <div class="col-md-12 form__fields">
                                        <label for="dob" class="form-label">Date of Birth</label>
                                    
                                        <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" id="dob" name="date_of_birth" value="{{ old('date_of_birth') }}" />
                                        @error('date_of_birth')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- WhatsApp Number -->
                                     <div class="col-md-12 form__fields">
                                        <label for="whatsappNo" class="form-label">WhatsApp</label>
                                    
                                        <input type="text" class="form-control" id="whatsappNo" name="whatsapp_no" placeholder="Enter WhatsApp Number" value="{{ old('whatsapp_no') }}" />
                                    </div>

                                    
									
                                    <!-- Instagram  -->
                                     <div class="col-md-12 form__fields">
                                        <label for="instagram" class="form-label">Instagram</label>
                                    
                                        <input type="text" class="form-control @error('instagram') is-invalid @enderror" id="instagram" name="instagram" placeholder="Enter Instagram" value="{{ old('instagram') }}"  />
                                        @error('instagram')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
									
									<!-- Facebook  -->
                                     <div class="col-md-12 form__fields">
                                        <label for="facebook" class="form-label">Facebook</label>
                                    
                                        <input type="text" class="form-control @error('facebook') is-invalid @enderror" id="facebook" name="facebook" placeholder="Enter Facebook" value="{{ old('facebook') }}" />
                                        @error('facebook')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
									
									<!-- Tiktok  -->
                                     <div class="col-md-12 form__fields">
                                        <label for="tiktok" class="form-label">Tiktok</label>
                                    
                                        <input type="text" class="form-control @error('tiktok') is-invalid @enderror" id="tiktok" name="tiktok" placeholder="Enter Tiktok"  value="{{ old('tiktok') }}"/>
                                        @error('tiktok')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
									
									<!-- Religion  -->
                                     <div class="col-md-12 form__fields">
                                        <label for="religion" class="form-label">Religion</label>
                                    
                                        <input type="text" class="form-control @error('religion') is-invalid @enderror" id="religion" name="religion" placeholder="Enter Religion" value="{{ old('religion') }}" />
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
</div>
<!-- End Modal -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    const form = $('#customerForm');

    $('#search').on('input', function() {
        const query = $(this).val();

        if (query.length > 0) {
            $.get('/raman-jeweller-erp/public/customers/search', { query: query }, function(data) {
				
				
                $('#customer-list').empty();
                data.forEach(customer => {
					const mobileNo = `${customer.mobile_no}`;
  					const formattedMobile = mobileNo.substr(0, 4) + ' ' + mobileNo.substr(4, 3) + ' ' + mobileNo.substr(7, 3);
				
                    $('#customer-list').append(`<li class="list-group-item" data-id="${customer.customer_id}">${customer.first_name} : ${formattedMobile}</li>`);
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

let alertShown = false; // Flag to track if alert has been shown

form.on('submit', function(event) {
    const customerIdInput = $('#itemIds');
    
    const totalAmountInput = parseFloat($('#totalAmount').val()) || 0;
    const cashAmountInput = parseFloat($('#cashAmount').val()) || 0;
    const cardAmountInput = parseFloat($('#cardAmount').val()) || 0;
    const dueAmountInput = parseFloat($('#due_amount').val()) || 0;

    const enteredAmount = cashAmountInput + cardAmountInput + dueAmountInput;

    // Check if customerId is empty
    if (!customerIdInput.val()) {
        event.preventDefault(); // Prevent form submission
        Swal.fire({
            title: 'Error!',
            text: 'Please select items.',
            icon: 'error',
            confirmButtonText: 'Okay'
        });
    } else if (totalAmountInput > enteredAmount) {
        // Prevent form submission if insufficient payment and alert hasn't been shown
        if (!alertShown) {
            event.preventDefault(); // Prevent form submission

            Swal.fire({
                title: 'Insufficient Payment!',
                text: `You need to pay more. Total is ${totalAmountInput}, but you entered ${enteredAmount}.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Convert to NC',
                cancelButtonText: 'Udhar'
            }).then((result) => {
                let form = document.querySelector('form');
                let dueAmount = totalAmountInput - enteredAmount;

                if (result.isConfirmed) {
                    alertShown = true; // Set the flag to true
                    
                    // Check if paymentModeDiv exists
                    let paymentModeDiv = document.getElementById('paymentModeDiv');
                    if (paymentModeDiv) {
                        // Add HTML to existing paymentModeDiv
                        paymentModeDiv.innerHTML += `
							<hr>
						
                            <p class="px-3" style="color:#df9700">NC Details</p>
                            <div class="d-flex mb-3 px-4 pt-3">
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label pr-3" for="dailyRadio">Daily</label>
                                    <input class="form-check-input" type="radio" name="payment_type" id="dailyRadio" value="daily" required>
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label pr-3" for="monthlyRadio">Monthly</label>
                                    <input class="form-check-input" type="radio" name="payment_type" id="monthlyRadio" value="monthly">
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label pr-3" for="yearlyRadio">Yearly</label>
                                    <input class="form-check-input" type="radio" name="payment_type" id="yearlyRadio" value="yearly">
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label pr-3" for="date">Date</label>
                                    <input class="form-check-input" type="date" name="date" id="date" required>
                                </div>
                            </div>
                            <div class="form-check form-check-inline px-4 pb-4">
                                <label class="form-check-label pr-3" for="duration">Duration</label>
                                <input class="form-check-input" type="number" min="1" name="duration" id="duration" required>
                            </div>
                        `;
                    }

                    document.getElementById('due_amount').value = dueAmount;

                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    alertShown = true; // Set the flag to true
                    
                    // Check if dueDateDiv exists
                    let dueDateDiv = document.getElementById('dueDateDiv');
                    if (dueDateDiv) {
                        // Add HTML to existing dueDateDiv
                        dueDateDiv.innerHTML += `
							<hr>
						
                            <label class="form-label col-sm-2 col-form-label" for="due_payment_date">Due Payment Date</label>
                            <input class="form-control col-sm-4" type="date" name="due_payment_date" id="due_payment_date" required>
                        `;
                    }
                }
            });
        } else {
            // If alert has already been shown, allow form submission
            form.submit();
        }
    } else {
        // If payment is sufficient, allow form submission
        form.submit();
    }
});




    // Add item functionality
    $('#addnewItem').on('click', function(event) {
        event.preventDefault(); // Prevent form from submitting
        const customer = $('#customerId').val();
        const itemId = $('#itemName').val();
        const itemAmount = $('#itemamount').val();
		
        if (customer) {
            if (itemId) {
                const itemIdsField = $('#itemIds');
                const itemAmountField = $('#itemamount');
				
                const existingIds = itemIdsField.val() ? itemIdsField.val().split(',') : [];
                const existingAmount = itemAmountField.val() ? itemAmountField.val().split(',') : [];
				

                if (existingIds.includes(itemId)) {
                    alert('This item is already added to the table.');
                    return; // Stop execution if itemId is already in the list
                }
				

                fetch(`https://demo.webwideit.solutions/raman-jeweller-erp/public/fetch-item?item_id=${itemId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data && data.item_id) {
                            const tbody = $('#itemTable tbody');
                            const newRow = $('<tr>').html(`
                                <td class="itemId">${data.item_id || 'N/A'}</td>
                                <td>${data.category || 'N/A'}</td>
                                <td>${data.metalType || 'N/A'}</td>
                               
                                <td>${data.item_weight || 'N/A'}</td>
                                <td><input type="number" class="form-control itemAmount" value="${data.amount || 0}" /></td>
                                <td><button class="btn btn-danger btn-sm removeItem">Remove</button></td>
                            `);
                            tbody.append(newRow);
                            updateGrandTotal(parseFloat(data.amount) || 0);
                            updateItemIds(data.item_id);
							
							updateAmount(data.amount, tbody.find('tr').length - 1);
							
                            $('#itemName').val(''); // Clear the input field
                        } else {
                            alert('ID does not exist or Item already sale');
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching item details:', error);
                        alert('Error fetching item details');
                    });
            } else {
                alert('Please enter an item id');
            }
        } else {
            alert('Please select a customer');
        }
    });

    // Function to update the hidden itemIds input
    function updateItemIds(itemId) {
        const itemIdsField = $('#itemIds');
        const existingIds = itemIdsField.val() ? itemIdsField.val().split(',') : [];
		

        if (!existingIds.includes(itemId)) {
            existingIds.push(itemId);
            itemIdsField.val(existingIds.join(','));
        }
    }
	
	function updateAmount(itemAmount, index) {
		const itemAmountField = $('#itemamount');
		let existingAmount = itemAmountField.val() ? itemAmountField.val().split(',') : [];

		// Ensure the existingAmount array is of the correct size
		if (existingAmount.length < index + 1) {
			existingAmount.length = index + 1;
		}

		// Update the amount at the specified index
		existingAmount[index] = itemAmount;

		// Update the hidden field with the new amounts
		itemAmountField.val(existingAmount.join(','));
	}

    // Function to remove an itemId from the hidden input
    function removeItemId(itemId) {
        const itemIdsField = $('#itemIds');
        const existingIds = itemIdsField.val() ? itemIdsField.val().split(',') : [];

        const newIds = existingIds.filter(id => id !== itemId); // Remove the specific itemId
        itemIdsField.val(newIds.join(','));
    }

    // Function to update the grand total
    function updateGrandTotal() {
        const grandTotalElement = $('#grandTotal');
        let totalAmount = 0;

        // Select all amount input fields in the table
        const amountInputs = $('.itemAmount');

        // Calculate the sum of all input amounts
        amountInputs.each(function() {
            const amount = parseFloat($(this).val().trim()) || 0;
            totalAmount += amount;
        });

        // Update the grand total element with the new total
        grandTotalElement.text(`Total: $${totalAmount.toFixed(2)}`);
        $('#totalAmount').val(totalAmount);
    }
	
	function removeItemAmount(index) {
    const itemAmountField = $('#itemamount');
    const existingAmounts = itemAmountField.val() ? itemAmountField.val().split(',') : [];

    // Remove the specific amount at the given index
    existingAmounts.splice(index, 1);

    // Update the hidden field with the new amounts array
    itemAmountField.val(existingAmounts.join(','));
}

    // Update the event listener to remove an item and recalculate the grand total
// Event listener to remove an item and its associated amount
$('#itemTable').on('click', '.removeItem', function() {
    // Get the row to be removed
    const row = $(this).closest('tr');

    // Get the itemId from the row
    const itemId = row.find('.itemId').text();

    // Get the index of the row being removed
    const rowIndex = row.index();

    // Remove the itemId from the hidden input
    removeItemId(itemId);

    // Remove the corresponding amount from the hidden input
    removeItemAmount(rowIndex);

    // Remove the row from the table
    row.remove();

    // Update the grand total after removing the item
    updateGrandTotal();
});

    // Update the total amount when an input amount changes
	$('#itemTable').on('input', '.itemAmount', function() {
		const itemAmount = $(this).val();

		// Get the index of the row where the input was changed
		const rowIndex = $(this).closest('tr').index();

		// Update the grand total
		updateGrandTotal();

		// Update the specific amount at that index
		updateAmount(itemAmount, rowIndex);
	});
});
</script>

<script>
    document.getElementById('backButton').addEventListener('click', function(event) {
        // Get the customerId value
        const customerId = document.getElementById('search').value;

        // If customerId has a value, show an alert
        if (customerId) {
            event.preventDefault(); // Prevent immediate navigation

            Swal.fire({
                title: 'Warning!',
                text: 'Are you sure you want to go back? You might lose unsaved changes.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, go back',
                cancelButtonText: 'Stay on this page'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If the user confirms, redirect to the sales list page
                    window.location.href = "{{ url('sales-list') }}";
                }
            });
        }
    });
</script>
@endsection
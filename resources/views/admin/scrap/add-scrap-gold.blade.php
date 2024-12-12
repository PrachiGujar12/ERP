@extends('layouts.dashboard')
@section('title', 'Add Scrap Gold')
@section('meta_description', 'System user list.')
@section('content')

<div id="content">
	
	        <div class="d-flex gap-2 flex-column flex-md-row justify-content-between py-3 bg-light card-header"
            style="
    position: sticky;
    top: 0;
    z-index: 100;">
            <!-- Page Heading -->
            <a href="{{ url('/scrap-gold') }}" class="JewelleryPrimaryButton">
                <i class="fas fa-arrow-left mr-2"></i> Back
            </a>
            <h1 class="h3 mb-0 text-gray-800 ">CREATE SCRAP GOLD ORDER</h1>
            <button class="JewelleryPrimaryButton" data-toggle="modal" data-target="#simpleModal"> <i
                    class="bi bi-person-add"></i> Add Customer</button>

        </div>
	
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Begin Page Content -->
        <div class="container-fluid customer__page">
            <div class="row">
                <form action="{{ route('store.scrap.gold') }}" method="POST">
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

                    <!-- Hidden input fields -->
                   
                    <input type="hidden" id="grandTotalInput" name="grand_total" />

                    <div class="card my-4 p-4">
                        <div class="form__fields p-0">
                                                @if (session('customer'))
                                                    <input class="form-control" type="text" id="search"
                                                        placeholder="Enter mobile number or name of customer"
                                                        value="{{ session('customer')->mobile_no }}" >
                                                @else
                                                    <input class="form-control" type="text" id="search"
                                                        placeholder="Enter mobile number or name of customer">
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
                                                        <p>Mobile: {{ session('customer')->mobile_no }}</p>
                                                        <p>Email: {{ session('customer')->email ?? 'N/A' }}</p>
                                                        <p>Address: {{ session('customer')->address ?? 'N/A' }}</p>
                                                    </div>
                                                @else
                                                    <div id="customer-details" class="mt-3" style="display: none;">
                                                    </div>
                                                @endif
                                            </div>
                    </div>


                    <div class="col-12 py-3 mt-3 card">

                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h2 class="h4">Add Items</h2>
                            </div>
                            <!-- Item Addition Form Row -->
                            <div class="form-row originalRow" id="ItemAdditionFormRow">
                                <div class="col-md-3 form__fields">
                                    <label for="textInput" class="form-label">Item Category</label>
                                    <select class="form-control" id="category">
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                        <option value="{{ $category->category_name }}">
                                            {{ $category->category_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 form__fields">
                                    <label for="metalType">Metal Type</label>
									<input type="text" class="form-control" id="metalType"
                                        placeholder="Enter Metal Type" />
									
                                    
                                </div>
                                <div class="col-md-3 form__fields">
                                    <label for="purity">Purity</label>
									<input type="text" class="form-control" id="purity"
                                        placeholder="Enter purity" />
                                   
                                </div>
                                <div class="col-md-3 form__fields">
                                    <label for="textInput" class="form-label">Metal Weight (g)</label>
                                    <input type="text" class="form-control" id="itemWeight"
                                        placeholder="Metal Weight" />
                                </div>
                                <div class="col-md-3 form__fields">
                                    <label for="textInput" class="form-label">Amount</label>
                                    <input type="text" class="form-control" id="amount" placeholder="Amount" />
                                </div>
                                <div class="col-md-4 form__fields align-items-end d-flex">
                                    <button class="btn btn-primary form__fields" id="addnewItem"
                                        onclick="addItem(event);">
                                        Add Item
                                    </button>
                                </div>
                            </div>

                            <table class="table table-bordered mt-3" id="itemTable">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>Category</th>
                                        <th>Metal Type</th>
                                        <th>Purity</th>
                                        <th>Item Weight <small>g</small></th>
                                        <th>Rate</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Items will be added dynamically -->
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="7" class="text-right">Grand Total: <span
                                                id="grandTotalDisplay">0</span></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div class="col-12 py-3 my-3 card ">
                        <div class="container mt-4">
                            <h6 class="m-0  text-warning h4">Payment:</h6>
                           
                            <div id="cashField" class="py-3" style="display: flex;">
                                <label for="cashAmount" class="form-label col-sm-2 col-form-label">Cash Amount</label>
                                <input type="number" class="form-control col-sm-4" id="cashAmount" name="cashAmount" />
                            </div>

                            <div class="justify-content-end d-flex">
                                <button type="submit" class="btn btn-primary px-md-5">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.container-fluid -->
</div>

<!-- Add new customer Modal -->
<div class="modal fade" id="simpleModal" tabindex="-1" role="dialog" aria-labelledby="simpleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="">
                <!-- Card with Box Shadow -->
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

                                    <textarea class="form-control @error('note') is-invalid @enderror" id="note" row="6" name="note" placeholder="Enter Note" style="height:auto !important">{{ old('note') }}</textarea>
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
</div>
<!-- End Modal -->
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
  					const formattedMobile = mobileNo.substr(0, 3) + ' ' + mobileNo.substr(3, 4) + ' ' + mobileNo.substr(7, 4);
				
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
  		const formattedMobile = mobileNo.substr(0, 3) + ' ' + mobileNo.substr(3, 4) + ' ' + mobileNo.substr(7, 4);
  
                    $('#customer-details').html(`
                    <h2>${data.first_name}</h2>
                    <p>Mobile: ${formattedMobile}</p>
                    <p>Email: ${data.email || 'N/A'}</p>
                    <p>Address: ${data.address || 'N/A'}</p>
                `).show();
                    $('#customerId').val(customerId); // Set hidden customer ID field
                    $('#customer-list').empty(); // Clear the list after selection
                });
            });
        });
    </script>


	
<script>
let rowIdCounter = 1;
let grandTotal = 0; // Variable to track the grand total

document.getElementById('addnewItem').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the form from submitting

    // Retrieve values from form fields
    const category = document.getElementById('category').value;
    const itemPurity = document.getElementById('purity').value;
    const itemMetalType = document.getElementById('metalType').value;
    const itemWeight = document.getElementById('itemWeight').value;
    const itemAmount = document.getElementById('amount').value;

    // Check if all fields are filled
    if (category && itemPurity && itemMetalType && itemWeight && itemAmount) {
        const tbody = document.querySelector('#itemTable tbody');
        const newRow = document.createElement('tr');
        const rowId = `row${rowIdCounter}`; // Generate a unique ID for the row

		console.log(rowId);
        newRow.id = rowId;

        newRow.innerHTML = `

                    <input type="hidden" name="categories[]" value="${category}">
                     <input type="hidden" name="metal_types[]" value="${itemMetalType}" >
                     <input type="hidden" name="purities[]" value="${itemPurity}" >
                      <input type="hidden" name="item_weight[]"  value="${itemWeight}">
                       <input type="hidden" name="amount[]" value="${itemAmount}">
               
            
            <td>${rowIdCounter}</td> 
            <td>${category}</td>
            <td>${itemMetalType}</td>
            <td>${itemPurity}</td>
            <td>${itemWeight}</td>
            <td>${itemAmount}</td>
            <td><button class="btn btn-danger btn-sm removeItem" data-row-id="${rowId}">Remove</button></td>
        `;

        tbody.appendChild(newRow);

        // Update the grand total
        updateGrandTotal(parseFloat(itemAmount) || 0);

        // Increment the row ID counter
        rowIdCounter++;

        // Clear the input fields after adding the new item
        document.getElementById('category').value = '';
        document.getElementById('purity').value = '';
        document.getElementById('metalType').value = '';
        document.getElementById('itemWeight').value = '';
        document.getElementById('amount').value = '';
    } else {
        alert('Please fill out all fields');
    }


});

// Event delegation to handle Remove button clicks
document.querySelector('#itemTable').addEventListener('click', function(event) {
    if (event.target.classList.contains('removeItem')) {
        const rowId = event.target.getAttribute('data-row-id');
        const row = document.getElementById(rowId);
        if (row) {
            const amount = parseFloat(row.cells[5].textContent.replace('$', ''));
            row.remove();

            // Update the grand total after removal
            updateGrandTotal(-amount);
        }
    }
});

function updateGrandTotal(amount) {
    grandTotal += amount;
    document.querySelector('#itemTable tfoot tr').innerHTML = `
        <th colspan="7" class="text-right">Grand Total: ${grandTotal}</th>
    `;

    // Update the cashAmount input field with the current grandTotal
    document.getElementById('cashAmount').value = grandTotal;

    document.getElementById('grandTotalInput').value = grandTotal;
}
</script>






@endsection
@extends('layouts.dashboard')
@section('title', 'Purchase List')
@section('meta_description', 'System user list.')
@section('content')

<div class="d-flex gap-2 flex-column flex-md-row justify-content-between py-3 bg-light card-header" style="position: sticky; top: 0; z-index: 100;">
	<a href="{{route('dashboard')}}" class="JewelleryPrimaryButton">
							<i class="fas fa-arrow-left mr-2"></i> Back to Menu
						</a>
            <div class=" mb-2 mb-md-0 p-0">
                <h6 class="h2 mb-0 text-gray-800">PURCHASE LIST</h6>
            </div>
           <a href="{{route('create.purchase')}}" class="JewelleryPrimaryButton">
							<i class="bi bi-plus-circle"></i> Add Purchase
						</a>
           
        </div>
<div id="content">
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        

        <!-- Content Row -->
        <div class="container-fluid customer__page my-4">
            <div class="row">
                <div class="col-12 card p-md-4">
                    <div class="row">
                        <div class="col-md-6 d-none">
                            <!-- Nav tabs -->
                            <ul class="nav nav-pills py-3 nav-justified" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-customer-tab" data-toggle="pill"
                                        href="#pills-customer" role="tab" aria-controls="pills-customer"
                                        aria-selected="false">Purchase List</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="add-new-customer-tab" data-toggle="pill"
                                        href="#add-new-customer" role="tab" aria-controls="add-new-customer"
                                        aria-selected="true">Add New</a>
                                </li>
                            </ul>
                        </div>
                    </div>

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
										@endforeach </ul> 
								</div> 
								@endif  
                    <!-- Tab panes -->
                    <div class="tab-content" id="pills-tabContent">
                        <!-- Purchase List Tab -->
                        <div class="tab-pane fade show active" id="pills-customer" role="tabpanel"
                            aria-labelledby="pills-customer-tab">
                            <div class="">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead class="text-center" style="background-color:#df9700; color:#fff">
                                                <tr>
                                                    <th>Id</th>
                                                    <th>PO Number</th>
                                                    <th>Supplier</th>
                                                    <th>Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-center">
                                                @foreach($purchases as $purchase)
                                                <tr>
                                                    <td>{{ $purchase->purchase_id }}</td>
                                                    <td>{{ $purchase->po_number }}</td>
                                                    <td>{{ $purchase->suppliers->full_name }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($purchase->date)->format('d M') }}</td>
                                                    <td>
                                                        <a href="{{ route('purchase.items', $purchase->purchase_id) }}"
                                                            class="btn btn-info">
                                                           <i class="bi bi-eye"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Add New Purchase Tab -->
                        <div class="tab-pane fade" id="add-new-customer" role="tabpanel"
                            aria-labelledby="add-new-customer-tab">
                           

                            <!-- Add New Item Section -->
                            <div class="col-12 py-3 mt-3 card " id="addItemsSection">
                                <div class="d-flex justify-content-between">
                                    <h2>Add New Item</h2>
                                </div>
                                <form action="{{ route('store.purchase.items') }}" method="POST">
                                    @csrf
                                   
									   <div class="form-row">
                                    <div class="col-md-6 form__fields">
                                        <label for="supplier" class="form-label">Supplier</label>
                                        <select class="form-control" name="supplier" id="supplier" required>
                                            <option value="">Select Supplier</option>
                                            @foreach($suppliers as $supplier)
                                            <option value="{{ $supplier->supplier_id }}">{{ $supplier->full_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>

                                   <div class="col-md-6 form__fields">
										<label for="dateInput" class="form-label">Date</label>
										<input type="date" class="form-control" name="date" id="dateInput" value="{{ old('date') }}" palceholder="Select Date" required />
									</div>

                                    <div class="col-md-6 form__fields">
                                        <label for="po_number" class="form-label">Purchase Number</label>
                                        <input type="text" class="form-control" id="po_number" name="po_number" value="{{ old('po_number') }}"
                                            placeholder="Invoice Number" required />
                                    </div>
                                </div>
                             <hr class="mt-2">
                                    <div class="form-row">
                                        <!-- Category -->
                                        <div class="col-md-6 form__fields">
                                            <label for="category">Category</label>
                                            <select class="form-control" name="categories[]" id="category" required>
                                                <option value="">Select Category</option>
                                                @foreach($categories as $category)
                                                <option value="{{ $category->category_name }} {{ old('categories') == '$category->category_name' ? 'selected' : '' }}">
                                                    {{ $category->category_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Metal Type -->
                                        <div class="col-md-6 form__fields">
                                            <label for="metalType">Metal Type</label>
                                            <select class="form-control" name="metal_types[]" id="metal_type" required>
                                                <option value="">Select Metal Type</option>
                                                @foreach($itemTypes as $itemType)
												   
                                                <option value="{{ $itemType->item_type_name }} {{ old('metal_types') == '$itemType->item_type_name' ? 'selected' : ''}}">
                                                    {{ $itemType->item_type_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Purity -->
                                     <!--     <div class="col-md-6 form__fields">
                                            <label for="purity">Purity</label>
                                            <select class="form-control" id="purity" name="purities[]" disabled>
                                                <option value="">Select Purity</option>
                                            </select>
                                        </div>-->

                                        <!-- Weight -->
                                        <div class="col-md-6 form__fields">
											<label for="weight">Weight <small>(In Grams)</small></label>
                                            <input type="text" class="form-control" id="item_weight" name="weights[]" value="{{ old('item_weight')}}" placeholder="Enter Item Weight" />
                                        </div>

                                       
                                        <!-- Quantity -->
                                     <div class="col-md-6 form__fields">
											<label for="quantity">Quantity</label>
											<input type="number" 
												   class="form-control @error('quantities.*') is-invalid @enderror" 
												   min="1" 
												   id="quantity" 
												   name="quantities[]" 
												   value="{{ old('quantities.0') }}" 
												   required/>
											@error('quantities.*')
											<div class="invalid-feedback">{{ $message }}</div>
											@enderror
										</div>
										
										   <!-- Amount -->
                                        <div class="col-md-6 form__fields">
                                            <label for="amount">Amount</label>
                                            <input type="text" class="form-control" id="amount" name="amounts[]" value="{{ old('amount')}}" placeholder="Enter Item Amount" />
                                        </div>

                                    </div>
                                    <div id="itemsContainer">
                                        <!-- Dynamic item rows will be appended here -->
                                    </div>
                                    <button type="button" class="btn btn-info mt-3" id="addItemRowBtn"><i class="bi bi-plus"></i> Add More
                                        Item</button>
                                    <div class="d-flex justify-content-between mt-3">
                                        <button type="submit" class="btn btn-secondary"><i class="bi bi-floppy"></i> Submit</button>
                                    </div>
                                </form>
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
    document.getElementById('dateInput').addEventListener('click', function() {
        this.showPicker();  // This will trigger the date picker
    });
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Function to fetch and populate purity options
    function populatePurityDropdown(metalTypeId, purityDropdown) {
        purityDropdown.innerHTML = '<option value="">Select Purity</option>';

        if (metalTypeId) {
            fetch(`https://demo.webwideit.solutions/raman-jeweller-erp/public/get-purity/${metalTypeId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.purity) {
                        const purities = data.purity.split(',');
                        purities.forEach(purity => {
                            const option = document.createElement('option');
                            option.value = purity.trim();
                            option.textContent = purity.trim();
                            purityDropdown.appendChild(option);
                        });
                        purityDropdown.disabled = false;
                    } else {
                        purityDropdown.disabled = true;
                    }
                });
        } else {
            purityDropdown.disabled = true;
        }
    }

    // Handle initial load event listener
    document.querySelectorAll('select[name="metal_types[]"]').forEach(select => {
        select.addEventListener('change', function() {
            const itemTypeId = this.value;
            const purityDropdown = this.closest('.form-row').querySelector('select[name="purities[]"]');
            populatePurityDropdown(itemTypeId, purityDropdown);
        });
    });

    // Handle dynamic row addition
    document.getElementById('addItemRowBtn').addEventListener('click', function() {
        const container = document.getElementById('itemsContainer');
        const rowIndex = container.children.length + 1;

        const row = document.createElement('div');
        row.className = 'form-row';
        row.innerHTML = `
            <div class="col-md-6 form__fields">
                <label for="category_${rowIndex}">Category ${rowIndex}</label>
                <select class="form-control" name="categories[]" id="category_${rowIndex}" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->category_name }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 form__fields">
                <label for="metalType_${rowIndex}">Metal Type ${rowIndex}</label>
                <select class="form-control" name="metal_types[]" id="metalType_${rowIndex}" required>
                    <option value="">Select Metal Type</option>
                    @foreach($itemTypes as $itemType)
                    <option value="{{ $itemType->item_type_name }}">{{ $itemType->item_type_name }}</option>
                    @endforeach
                </select>
            </div>
           
            <div class="col-md-6 form__fields">
                <label for="weight_${rowIndex}">Weight ${rowIndex}<small>(In Grams)</small></label>
                <input type="text" class="form-control" name="weights[]" id="weight_${rowIndex}" />
            </div>
            <div class="col-md-6 form__fields">
                <label for="quantity_${rowIndex}">Quantity ${rowIndex}</label>
                <input type="number" class="form-control" name="quantities[]" id="quantity_${rowIndex}" />
            </div>
            <div class="col-md-6 form__fields">
				<label for="amount_${rowIndex}">Amount ${rowIndex}</label>
				<input type="text" class="form-control" id="amount_${rowIndex}" name="amounts[]"  placeholder="Enter Item Amount" />
			</div>
            <div class="col-md-12 form__fields">
                <button type="button" class="btn btn-danger remove-row-btn" data-row-index="${rowIndex}">Remove</button>
            </div>
        `;
        container.appendChild(row);

        // Add event listener to the newly added metal type dropdown
        row.querySelector(`#metalType_${rowIndex}`).addEventListener('change', function() {
            const itemTypeId = this.value;
            const purityDropdown = row.querySelector(`#purity_${rowIndex}`);
            populatePurityDropdown(itemTypeId, purityDropdown);
        });

        // Add event listener to the newly added remove button
        row.querySelector('.remove-row-btn').addEventListener('click', function() {
            row.remove();
        });
    });
});
</script>
<!-- <div class="col-md-6 form__fields">
                <label for="purity_${rowIndex}">Purity ${rowIndex}</label>
                <select class="form-control" name="purities[]" id="purity_${rowIndex}" disabled>
                    <option value="">Select Purity</option>
                </select>
            </div>-->

@endsection
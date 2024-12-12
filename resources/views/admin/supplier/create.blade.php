@extends('layouts.dashboard')
@section('title', 'All Users')
@section('meta_description', 'System user list.')
@section('content')

<div id="content">
<div class="d-flex gap-2 flex-column flex-md-row justify-content-between py-3 bg-light card-header" style="position: sticky; top: 0; z-index: 100;">
	<a href="{{ url('/supplier-list') }}" class="JewelleryPrimaryButton" onclick="checkFormAndNavigate(event)">
    <i class="fas fa-arrow-left mr-2"></i> Back
</a>
            <div class=" mb-2 mb-md-0 p-0">
                <h6 class="h2 mb-0 text-gray-800">ADD SUPPLIER</h6>
            </div>
             <button type="submit" id="submitFormButton" class="JewelleryPrimaryButton">SAVE</button>
        
	
	</div>
    <!-- Begin Page Content -->
    <div class="container-fluid">
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
		 @if ($errors->any())
								<div class="alert alert-danger"> 
									<ul>
										@foreach ($errors->all() as $error) 
										<li>{{ $error }}</li>
										@endforeach </ul> 
								</div> 
								@endif 
        <!-- Page Heading -->

        <!-- Content Row -->
        <div class="container-fluid customer__page">
            <div class="row">
                <div class="col-12  my-4 p-md-4">
                    <div class="row">
                        <div class="col-md-6 d-none">
                            <!-- Nav tabs -->
                            <ul class="nav nav-pills py-3 nav-justified" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link " id="pills-customer-tab" data-toggle="pill"
                                        href="#pills-customer" role="tab" aria-controls="pills-customer"
                                        aria-selected="false">Suppliers List</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" id="add-new-customer-tab" data-toggle="pill"
                                        href="#add-new-customer" role="tab" aria-controls="add-new-customer"
                                        aria-selected="true">Add New Supplier</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Tab panes -->
                    <div class="tab-content" id="pills-tabContent">

                        <div class="tab-pane fade" id="pills-customer" role="tabpanel"
                            aria-labelledby="pills-customer-tab">
                            <div class="card mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-warning">
                                        Supplier List
                                    </h6>
                                </div>
                                
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead class="text-center" style="background-color:#df9700; color:#fff">
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Full Name</th>
                                                    <th>Email</th>
                                                    <th>Mobile Number</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-center">
                                                @foreach($suppliers as $supplier)
                                                <tr>
                                                    <td>{{ $supplier->supplier_id }}</td>
                                                    <td>{{ $supplier->full_name }}</td>
                                                    <td>{{ $supplier->email }}</td>
                                                    <td>{{ $supplier->mobile_no}}</td>
                                                    <td>
                                                        <a class="btn btn-sm btn-primary"
                                                            href="{{ route('edit.supplier', $supplier->supplier_id) }}">
                                                            Edit
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

                        <div class="tab-pane fade show active d-flex align-items-center justify-content-center" id="add-new-customer" role="tabpanel"
                            aria-labelledby="add-new-customer-tab">
                            <form action="{{ route('add.supplier') }}" class="col-9" method="POST" id="addCategoryForm"
                                enctype="multipart/form-data">
                                @csrf
                                <div class=" g-3">
									<div class="card p-2 mb-3">
								<div class="form__fields row">
            <label for="supplier_code" class="form-label col-md-4">Supplier Code</label>
            <input type="text" class="form-control col-md-8" id="supplier_code" name="supplier_code"  value="{{ old('supplier_code') }}" placeholder="Enter Supplier Code" required>
        </div>
        <div class="row form__fields">
            <label for="full_name" class="form-label col-md-4">Supplier Name</label>
            <input type="text" class="form-control col-md-8" id="full_name" name="full_name"  value="{{ old('full_name') }}" placeholder="Enter Supplier Name" required>
        </div>
		<div class="row form__fields">
			<label for="textInput" class="form-label col-md-4">Nick Name</label>
			<input type="text" class="form-control col-md-8" id="textInput" name="contact_person_name" value="{{ old('contact_person_name') }}" placeholder="Enter Contact Person Name" required>
		</div>
		<div class="row form__fields">
            <label for="company" class="form-label col-md-4">Company Name</label>
            <input type="text" class="form-control col-md-8" id="company" name="company" value="{{ old('company') }}" placeholder="Enter Company Name" required>
        </div>
        </div>
										
<!--start-->
									<div class="card p-2 mb-3">
		<div class="row form__fields">
            <label for="address" class="form-label col-md-4">Address</label>
            <input type="text" class="form-control col-md-8" id="address" name="address" value="{{ old('address') }}" placeholder="Enter Address" required>
        </div>
									
		<div class="row form__fields">
            <label for="town" class="form-label col-md-4">Town</label>
            <input type="text" class="form-control col-md-8" id="town" name="town" value="{{ old('town') }}" placeholder="Enter Town" required>
        </div>
									
		<div class="row form__fields">
            <label for="city" class="form-label col-md-4">City/County</label>
            <input type="text" class="form-control col-md-8" id="city" name="city" value="{{ old('city') }}" placeholder="Enter City/County" required>
        </div>
									
		<div class="row form__fields">
            <label for="post" class="form-label col-md-4">Post Code</label>
            <input type="text" class="form-control col-md-8" id="post" name="post" value="{{ old('post') }}" placeholder="Enter Post Code" required>
        </div>
									
		<div class="row form__fields">
            <label for="country" class="form-label col-md-4">Country</label>
            <input type="text" class="form-control col-md-8" id="country" name="country" value="{{ old('country') }}" placeholder="Enter Country" required>
        </div>
        </div>
										
									<div class="card p-2 mb-3">
									<!--end-->
        <div class="row form__fields">
            <label for="mobile_no" class="form-label col-md-4">Mobile Number</label>
            <input type="text" class="form-control col-md-8" id="mobile_no" name="mobile_no" value="{{ old('mobile_no') }}" placeholder="Enter Mobile Number" required>
        </div>
        <div class="row form__fields">
            <label for="email" class="form-label col-md-4">Email</label>
            <input type="email" class="form-control col-md-8" id="email" name="email" value="{{ old('email') }}" placeholder="Enter Email" required>
        </div>
        </div>
        <div class="card p-2 mb-3">
        <div class="row form__fields">
            <label for="note" class="form-label col-md-4">Note</label>
            <textarea class="form-control col-md-8" id="note" name="note" placeholder="Enter note here">{{ old('note') }}</textarea>
        </div>
        </div>

                                    
                                    <div class="col-12">
                                       
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- /.container-fluid -->
</div>
<script>
function checkFormAndNavigate(event) {
    event.preventDefault();
    const fields = ['supplier_code', 'full_name', 'mobile_no', 'email', 'address', 'note'];
    let allEmpty = true;

    for (const field of fields) {
        const input = document.getElementById(field);
        if (input && input.value.trim() !== '') {
            allEmpty = false;
            break;
        }
    }

    if (allEmpty) {
        window.location.href = "{{ url('/supplier-list') }}";
    } else {
        // Show confirm dialog and navigate back if the user clicks "OK"
        const confirmNavigation = confirm("You have entered data. Are you sure you want to go back?");
        if (confirmNavigation) {
            window.location.href = "{{ url('/supplier-list') }}";
        }
    }
}
</script>
<script>
    document.getElementById("submitFormButton").addEventListener("click", function() {
        document.getElementById("addCategoryForm").submit();
    });
</script>
@endsection

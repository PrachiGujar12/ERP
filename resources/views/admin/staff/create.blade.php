@extends('layouts.dashboard')
@section('title', 'All Users')
@section('meta_description', 'System user list.')
@section('content')
<div class="d-flex gap-2 flex-column flex-md-row justify-content-between py-3 bg-light card-header" style="position: sticky; top: 0; z-index: 100;">
	<a class="justify-content-end d-flex text-decoration-none" href="{{route('staff.index')}}">
        <button class="JewelleryPrimaryButton"><i class="bi bi-arrow-left-short"></i> Back</button>
    </a>
            <div class=" mb-2 mb-md-0 p-0">
                <h6 class="h2 mb-0 text-gray-800">ADD STAFF</h6>
            </div>
            <div class=" d-flex gap-2 justify-content-md-end p-0">
				
                <a href="{{route('staff.create')}}"><button class="JewelleryPrimaryButton"><i class="bi bi-person-fill-add"></i>
                        Add Staff
                    </button></a>
            </div>
        
	
	</div>

<div class="container-fluid">

    <div class="row justify-content-center">

        <div class="col-lg-8 col-md-10 col-sm-12 my-4">
           
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <!-- Display Error Messages -->
            @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <form action="{{ route('staff.store') }}" method="POST">
                <!-- CSRF Token for Laravel -->
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" class="form-control rounded" id="name" placeholder="Enter Name" name="name"
                        required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control rounded" id="email" placeholder="Enter Email" name="email"
                        required>
                </div>

                <div class="mb-3">
                    <label for="mobileNo" class="form-label">Mobile Number:</label>
                    <input type="text" class="form-control rounded" id="mobileNo" placeholder="Enter Mobile Number"
                        name="mobile_no" required>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Address:</label>
                    <input type="text" class="form-control rounded" id="address" placeholder="Enter Address"
                        name="address" required>
                </div>

                <div class="mb-3">
                    <label for="designation" class="form-label">Designation:</label>
                    <input type="text" class="form-control rounded" id="designation" placeholder="Enter Designation"
                        name="designation" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" class="form-control rounded" id="password" placeholder="Enter Password"
                        name="password" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">User Department:</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="purchase" name="user_type[]"
                            value="purchase">
                        <label class="form-check-label" for="purchase">Purchase</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="staff" name="user_type[]" value="staff">
                        <label class="form-check-label" for="staff">Staff</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="customer" name="user_type[]"
                            value="customer">
                        <label class="form-check-label" for="customer">Customer</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="karigar" name="user_type[]" value="karigar">
                        <label class="form-check-label" for="karigar">Karigar</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="supplier" name="user_type[]"
                            value="supplier">
                        <label class="form-check-label" for="supplier">Supplier</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="stock" name="user_type[]" value="stock">
                        <label class="form-check-label" for="stock">Stock</label>
                    </div>
					 <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="repair-items" name="user_type[]" value="repair-items">
                        <label class="form-check-label" for="repair-items">Reapir Items</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="rates" name="user_type[]" value="rates">
                        <label class="form-check-label" for="rates">Metal Rate</label>
                    </div>
					   <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="sale" name="user_type[]" value="sale">
                        <label class="form-check-label" for="sale">Jewellery Sale</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="scrap-gold" name="user_type[]" value="scrap-gold">
                        <label class="form-check-label" for="scrap-gold">Scrap Gold</label>
                    </div>
					 <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="quotation" name="user_type[]" value="quotation">
                        <label class="form-check-label" for="quotation">Estimate Quotation</label>
                    </div>
					 <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="ncsale" name="user_type[]" value="ncsale">
                        <label class="form-check-label" for="ncsale">NC Sale</label>
                    </div>
                    <!-- <div class="form-check">
        <input class="form-check-input" type="checkbox" id="purchase" name="user_type[]" value="purchase">
        <label class="form-check-label" for="purchase">Purchase</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" id="production" name="user_type[]" value="production">
        <label class="form-check-label" for="production">Production</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" id="quality" name="user_type[]" value="quality">
        <label class="form-check-label" for="quality">Quality</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" id="store" name="user_type[]" value="store">
        <label class="form-check-label" for="store">Store</label>
    </div> -->
                </div>


                <button type="submit" class="btn btn-primary w-100">Add Staff</button>
            </form>
        </div>
    </div>


</div>
<!-- /.container-fluid -->


@endsection
@extends('layouts.dashboard')
@section('title', 'Edit Staff')
@section('meta_description', 'System user list.')
@section('content')

<div class="container-fluid">
    <a class="" href="{{route('staff.index')}}">
        <button class="btn btn-secondary"><i class="bi bi-arrow-left-short"></i> Back</button>
    </a>
    <div class="row justify-content-center">

        <div class="col-lg-8 col-md-10 col-sm-12 my-4">
            <h2 class="text-center h3 text-gray-800">Edit Staff - {{$user->name}}</h2>
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
            <form action="{{ route('staff.update', $user->id) }}" method="POST">
                <!-- CSRF Token for Laravel -->
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" class="form-control rounded" id="name" value="{{ old('name', $user->name) }}"
                        placeholder="Enter Name" name="name" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control rounded" id="email" value="{{ old('name', $user->email) }}"
                        placeholder="Enter Email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="mobileNo" class="form-label">Mobile Number:</label>
                    <input type="text" class="form-control rounded" id="mobileNo"
                        value="{{ old('mobile_no', $user->mobile_no) }}" placeholder=" Enter Mobile Number"
                        name="mobile_no" required>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Address:</label>
                    <input type="text" class="form-control rounded" id="address"
                        value="{{ old('address', $user->address) }}" placeholder="Enter Address" name="address"
                        required>
                </div>

                <div class="mb-3">
                    <label for="designation" class="form-label">Designation:</label>
                    <input type="text" class="form-control rounded" id="designation"
                        value="{{ old('designation', $user->designation) }}" placeholder="Enter Designation"
                        name="designation" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">User Department:</label>
                    @php

                    $userTypes = array_map('trim', explode(',', $user->user_type));
                    @endphp

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="purchase" name="user_type[]"
                            value="purchase" {{ in_array('purchase', $userTypes) ? 'checked' : '' }}>
                        <label class="form-check-label" for="purchase">Purchase</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="staff" name="user_type[]" value="staff"
                            {{ in_array('staff', $userTypes) ? 'checked' : '' }}>
                        <label class="form-check-label" for="staff">Staff</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="customer" name="user_type[]"
                            value="customer" {{ in_array('customer', $userTypes) ? 'checked' : '' }}>
                        <label class="form-check-label" for="customer">Customer</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="karigar" name="user_type[]" value="karigar"
                            {{ in_array('karigar', $userTypes) ? 'checked' : '' }}>
                        <label class="form-check-label" for="karigar">Karigar</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="supplier" name="user_type[]"
                            value="supplier" {{ in_array('supplier', $userTypes) ? 'checked' : '' }}>
                        <label class="form-check-label" for="supplier">Supplier</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="stock" name="user_type[]" value="stock"
                            {{ in_array('stock', $userTypes) ? 'checked' : '' }}>
                        <label class="form-check-label" for="stock">Stock</label>
                    </div>
					
					<div class="form-check">
                        <input class="form-check-input" type="checkbox" id="repair-items" name="user_type[]"
                            value="repair-items" {{ in_array('repair-items', $userTypes) ? 'checked' : '' }}>
                        <label class="form-check-label" for="repair-items">Reapir Items</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="rates" name="user_type[]" value="rates"
                            {{ in_array('rates', $userTypes) ? 'checked' : '' }}>
                        <label class="form-check-label" for="rates">Metal Rate</label>
                    </div>
					
					  <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="sale" name="user_type[]" value="sale"
                            {{ in_array('sale', $userTypes) ? 'checked' : '' }}>
                        <label class="form-check-label" for="sale">Jewellery Sale</label>
                    </div>

                 <!--   <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="purchase-exchange" name="user_type[]" value="purchase-exchange"
                            {{ in_array('purchase-exchange', $userTypes) ? 'checked' : '' }}>
                        <label class="form-check-label" for="purchase-exchange">Purchase Exchange</label>
                    </div> -->
					
					 <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="scrap-gold" name="user_type[]" value="scrap-gold"
                            {{ in_array('scrap-gold', $userTypes) ? 'checked' : '' }}>
                        <label class="form-check-label" for="scrap-gold">Scrap Gold</label>
                    </div>
					
					 <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="quotation" name="user_type[]" value="quotation"
                            {{ in_array('quotation', $userTypes) ? 'checked' : '' }}>
                        <label class="form-check-label" for="quotation">Estimate Quotation</label>
                    </div>
					
					<div class="form-check">
                        <input class="form-check-input" type="checkbox" id="ncsale" name="user_type[]" value="ncsale"
                            {{ in_array('ncsale', $userTypes) ? 'checked' : '' }}>
                        <label class="form-check-label" for="ncsale">NC Sale</label>
                    </div>

                    <!--<div class="form-check">
        <input class="form-check-input" type="checkbox" id="purchase" name="user_type[]" value="purchase"
               {{ in_array('purchase', $userTypes) ? 'checked' : '' }}>
        <label class="form-check-label" for="purchase">Purchase</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" id="production" name="user_type[]" value="production"
               {{ in_array('production', $userTypes) ? 'checked' : '' }}>
        <label class="form-check-label" for="production">Production</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" id="quality" name="user_type[]" value="quality"
               {{ in_array('quality', $userTypes) ? 'checked' : '' }}>
        <label class="form-check-label" for="quality">Quality</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" id="store" name="user_type[]" value="store"
               {{ in_array('store', $userTypes) ? 'checked' : '' }}>
        <label class="form-check-label" for="store">Store</label>
    </div> -->
                </div>


                <button type="submit" class="btn btn-primary w-100">Update User</button>
            </form>
        </div>
    </div>


</div>
<!-- /.container-fluid -->


@endsection
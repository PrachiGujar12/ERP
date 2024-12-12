@extends('layouts.dashboard')

@section('title', 'Edit Tax')
@section('meta_description', 'System attribute edit page.')

@section('content')
<div id="content">

    <!-- Header Section -->
    <div class="d-flex gap-2 flex-column flex-md-row justify-content-between py-3 bg-light card-header"
        style="position: sticky; top: 0; z-index: 100;">
        <a href="{{ url('tax-list') }}" class="JewelleryPrimaryButton" id="backButton">
            <i class="bi bi-arrow-left"></i> Back
        </a>
        <h6 class="h3 mb-0 text-gray-800">Edit Tax</h6>
    </div>

    <!-- Page Content -->
    <div class="container-fluid">
        <div class="card mt-3">
            <form action="{{ route('update-tax', $tax->tax_id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                
                <!-- Success and Error Messages -->
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

                <!-- Form Fields -->
                <div class="p-3">
                    <!-- Name Field -->
                    <div class="row mb-3">
                        <label for="name" class="col-sm-2 col-form-label">Name <span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name', $tax->name) }}" placeholder="Enter Name" required>
                        </div>
                    </div>

                    <!-- Percentage Field -->
                    <div class="row mb-3">
                        <label for="percentage" class="col-sm-2 col-form-label">Percentage <span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="percentage" name="percentage"
                                value="{{ old('percentage', $tax->percentage) }}" placeholder="Enter Percentage" required>
                        </div>
                    </div>

                    <!-- Status Dropdown -->
                    <div class="row mb-3">
                        <label for="status" class="col-sm-2 col-form-label">Status <span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <select id="status" name="status" class="form-control" required>
                                <option value="" disabled {{ old('status', $tax->status) == '' ? 'selected' : '' }}>Select Status</option>
                                <option value="active" {{ old('status', $tax->status) == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status', $tax->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="d-flex justify-content-end p-3">
                    <button type="submit" class="JewelleryPrimaryButton">Submit</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection

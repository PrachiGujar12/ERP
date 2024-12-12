@extends('layouts.dashboard')

@section('title', 'Create Tax')
@section('meta_description', 'System user list.')

@section('content')
<div id="content">
    <div class="d-flex gap-2 flex-column flex-md-row justify-content-between py-3 bg-light card-header" style="
    position: sticky;
    top: 0;
    z-index: 100;">
        <a href="{{url('tax-list')}}" class="JewelleryPrimaryButton">
            <i class="fas fa-arrow-left mr-2"></i> Back
        </a>
        <div class=" mb-2 mb-md-0 p-0">
            <h6 class="h2 mb-0 text-gray-800">ADD NEW TAX</h6>
        </div>
        <div class=" d-flex gap-2 justify-content-md-end p-0">

        </div>
    </div>

    <div class="container-fluid">
        <div class="customer__page">
            <!-- Page Content -->
            <form action="{{route('store-tax')}}" method="POST" enctype="multipart/form-data" class="mt-4">
                @csrf
                <div class="row">
                    <!-- Main Content -->
                    <div class="col-md-12">
                        <!-- Product Details Card -->
                        <div class="card mb-4 shadow-sm">
                            <div class="card-body">
                                <h2 class="card-title mb-3"><b>Tax Details</b>
                                    <hr>
                                </h2>

                                <!-- Product Name -->
                                <div class="form-group mb-3">
                                    <label for="name"><b>Tax Name</b></label>
                                    <input type="text" name="name" id="name" placeholder="Tax Name" class="form-control"
                                        required>
                                </div>

                            

                                <!-- Percentage -->
                                <div class="form-group mb-3">
                                    <label for="percentage"><b>Percentage %</b></label>
                                    <input type="number" name="percentage" id="percentage" placeholder="Percentage %"
                                        class="form-control" required>
                                </div>

                               <!-- Status -->
                                <div class="form-group mb-3">
                                    <label for="status"><b>Status</b></label>
                                    <select id="status" name="status" class="form-control">
                                        <option value="" disabled selected>Select Status</option>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>

                            </div>
                        </div>


                        <!-- Submit Button -->
                        <div class="text-end">
                            <button type="submit" class="JewelleryPrimaryButton mb-3 ">Save</button>
                        </div>
                    </div>


                </div>
            </form>
        </div>
    </div>
</div>

@endsection
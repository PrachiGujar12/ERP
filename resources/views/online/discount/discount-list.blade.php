@extends('layouts.dashboard')
@section('title', 'Discount List')
@section('meta_description', 'System user list.')
@section('content')

<div class="">
    <div class="d-flex gap-2 flex-column flex-md-row justify-content-between py-3 bg-light card-header sticky-top"
        style="z-index: 100;">
        <a href="{{ route('online-dashboard') }}" class="JewelleryPrimaryButton">
            <i class="fas fa-arrow-left mr-2"></i> Back to Menu
        </a>
        <div class="mb-2 mb-md-0 p-0">
            <h6 class="h2 mb-0 text-gray-800">DISCOUNT LIST</h6>
        </div>
        <div class="d-flex gap-2 justify-content-md-end p-0">
            <a href="{{ url('create-new-discount') }}">
                <button class="JewelleryPrimaryButton">
                    <i class="bi bi-file-earmark-plus"></i> Create New Discount
                </button>
            </a>
        </div>
    </div>

    <div class="container-fluid">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="card my-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead class="text-center" style="background-color:#df9700; color:#fff">
                            <tr>
                                <th>ID</th>
                                <th>Discount On</th>
                                <th>Product Id</th>
                                <th>Category Id</th>
                                <th>Coupon Code</th>
                                <th>Discount Type</th>
                                <th>Discount Value</th>
                                <th>From Date</th>
                                <th>To Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach($discounts as $discount)
                            <tr>
                                <td>{{ $discount->discount_id }}</td>


                                <td>{{$discount->discount_on}}</td>
                                
                                <td>
                                    @if($discount->discount_on == "product")
                                    {{$discount->product_id}}
                                    @else
                                        -
                                    @endif
                                </td>

                                <td>
                                    @if($discount->discount_on == "category")
                                    {{$discount->category_id}}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{$discount->coupon_code}}</td>
                                <td>{{$discount->discount_type}}</td>
                                <td>
                                    @if($discount->discount_type == "percentage")
                                    {{$discount->percentage_discount_value}}%
                                    @else
                                    {{$discount->fixed_discount_value}} /-
                                    @endif
                                </td>
                                <td>{{ \Carbon\Carbon::parse($discount->start_date)->format('d-m-Y') }} - {{$discount->start_time}}</td>
                                <td>{{ \Carbon\Carbon::parse($discount->end_date)->format('d-m-Y') }} - {{$discount->end_time}}</td>
                                <td>
                                    <!-- Edit button linking to the edit page -->
                                    <a href="{{ route('edit-discount', $discount->discount_id) }}"
                                        class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <!-- Delete button with confirmation -->
                                    <form action="{{ route('delete-discount', $discount->discount_id) }}" method="POST"
                                        style="display:inline;"
                                        onsubmit="return confirm('Are you sure you want to delete this discount?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>

                                </td>
                            </tr>


                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>






@endsection
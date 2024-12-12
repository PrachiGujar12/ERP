@extends('layouts.dashboard')
@section('title', 'Online Orders List')
@section('meta_description', 'System user list.')
@section('content')

<div class="">
    <div class="d-flex gap-2 flex-column flex-md-row justify-content-between py-3 bg-light card-header"
        style="position: sticky; top: 0; z-index: 100;">
        <a href="{{ route('online-dashboard') }}" class="JewelleryPrimaryButton">
            <i class="fas fa-arrow-left mr-2"></i> Back to Menu
        </a>
        <div class="mb-2 mb-md-0 p-0">
            <h6 class="h2 mb-0 text-gray-800">ONLINE ORDERS LIST</h6>
        </div>
        <div></div>
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

        <!-- DataTales Example -->
        <div class="card my-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead class="text-center" style="background-color:#df9700; color:#fff">
                            <tr>
                                <th>ID</th>
                                <th>Customer</th>
                                <th>Product Id</th>
                                <th>Product Price</th>
                                <th>Subtotal</th>
                                <th>Grand Total</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody class="text-center">
                            @foreach($onlineorders as $onlineorder)
                            <tr>
                                <td>{{ $onlineorder->online_order_id }}</td>
                                <td>{{ $onlineorder->customer->first_name }}</td>
                                <td>{{ $onlineorder->product->product_name }}</td>
                                <td>{{ $onlineorder->product_price }}</td>
                                <td>{{ $onlineorder->subtotal }}</td>
                                <td>{{ $onlineorder->grand_total }}</td>
                                <td>{{ \Carbon\Carbon::parse($onlineorder->created_at)->format('Y/m/d') }}</td>
                                <td>
                                    <!-- Add View button -->
                                    <a href="{{ route('view.online.order', $onlineorder->online_order_id) }}"
                                        class="btn btn-info btn-sm">View</a>
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
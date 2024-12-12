@extends('layouts.dashboard')
@section('title', 'View Order')
@section('meta_description', 'View order details.')
@section('content')

<div class="container-fluid">
    <div class="card my-4">
        <div class="card-header">
            <h3 class="mb-0">Order Details</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Order ID:</strong> {{ $order->online_order_id }}</p>
                    <p><strong>Customer Name:</strong> {{ $order->customer->first_name }} {{ $order->customer->last_name }}</p>
                    <p><strong>Product Name:</strong> {{ $order->product->product_name }}</p>
                    <p><strong>Product Price:</strong> {{ $order->product_price }}</p>
                    <p><strong>Shape:</strong> {{ $order->shape }}</p>
                    <p><strong>Metal Type:</strong> {{ $order->metalType }}</p>
                    <p><strong>Diamond Type:</strong> {{ $order->diamondType }}</p>
                    <p><strong>Ring Size:</strong> {{ $order->ring_size }}</p>
                    <p><strong>Subtotal:</strong> {{ $order->subtotal }}</p>
                    <p><strong>Grand Total:</strong> {{ $order->grand_total }}</p>
                    <p><strong>Created At:</strong> {{ \Carbon\Carbon::parse($order->created_at)->format('Y/m/d') }}</p>
                </div>
            </div>

            <!-- Back to Orders Button -->
            <div class="mt-3">
                <a href="{{ url('/online-orders-list') }}" class="btn btn-primary">Back to Orders</a>
            </div>
        </div>
    </div>
</div>


@endsection

@extends('online-frontend.layouts.app')
@section('title', 'Home')
@section('content')

<div class="container py-5">
    <div class="row">
        <!-- Cart Item Section -->
        <div class="col-md-8">
            <div class="cart-item">
                <div class="row">
                    <div class="col-md-3">
                        <img src="{{ asset('assets/product_images/' . $products->product_image) }}" alt="Product Image"
                            class="img-fluid rounded">
                    </div>
                    <div class="col-md-9">
                        <h4 class="product-name">{{ $products->product_name }}</h4>
                        <p>{{ $products->description }}</p>
                        <p><strong>Ring Size:</strong> {{ $orders->ring_size }}</p>
                        <p><strong>Quantity:</strong> 1</p>
                        <p><strong>Price:</strong> {{ $orders->product_price }}</p>
                        <p>Free shipping on this order.</p>

                        <!-- Remove Button -->
                        <form action="{{ route('cart.remove', $orders->online_order_id) }}" method="POST"
                            class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        <!-- Order Summary Section -->
        <div class="col-md-4">
            <form action="{{ route('checkout', $orders->online_order_id) }}" method="POST">
                @csrf
                <div class="order-summary">
                    <h4 class="mb-4">Order Summary</h4>

                    <div class="summary-details">
                        <p><strong>Order Total:</strong> ${{ $orders->product_price }}</p>

                        <p><strong>Discount:</strong>
                            @if ($discount)
                            {{ $discount->percentage_discount_value }}%
                            @else
                            $0.00
                            @endif
                        </p>

                        <p name="subtotal"><strong>Subtotal:</strong>
                            @php
                            // Calculate discount value based on product price
                            $discountAmount = $discount ? ($orders->product_price *
                            ($discount->percentage_discount_value / 100)) : 0;
                            $subtotal = $orders->product_price - $discountAmount;
                            @endphp
                            ${{ number_format($subtotal, 2) }}
                            <input type="hidden" name="subtotal" value="{{ $subtotal }}">
                        </p>

                        <p><strong>Tax:</strong>
                            @foreach ($taxes as $tax)
                            {{ $tax->percentage }}%
                            @if (!$loop->last), @endif
                            @endforeach
                        </p>

                        <p name="grand_total"><strong>Grand Total:</strong>
                            @php
                            $totalTax = 0;
                            foreach ($taxes as $tax) {
                            $totalTax += ($subtotal * ($tax->percentage / 100));
                            }
                            $grandTotal = $subtotal + $totalTax;
                            @endphp
                            ${{ number_format($grandTotal, 2) }}
                            <input type="hidden" name="grand_total" value="{{ $grandTotal }}">
                        </p>

                    </div>

                    <button type="submit" class="btn btn-success btn-block mt-3">Checkout</button>
                </div>
            </form>
        </div>

    </div>
</div>

@endsection
@extends('online-frontend.layouts.app')
@section('title', 'Home')
@section('content')

<style>
    .product-image {
    height: 200px; /* Set the fixed height you want */
    object-fit: cover; /* Ensures the images cover the given height and width while maintaining their aspect ratio */
    width: 100%; /* Make the image take the full width of the container */
}

</style>
<div class="container py-5">
    <h4 class="text-center mb-5">Categories</h4>
    <div class="row text-center">
    @foreach($products as $product)
    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
        <div class="product-item">
            <a href="{{ url('productList?category=' . $product->id) }}">
                <img src="{{ asset($product->category_image ? 'assets/product_category_images/' . $product->category_image : 'assets/product_category_images/default.jpg') }}"
                    alt="{{ $product->name }}" class="img-fluid rounded shadow-sm">
            </a>
            <h1 class="mt-3">{{ $product->name }}</h1>
        </div>
    </div>
@endforeach

    </div>
</div>

@endsection
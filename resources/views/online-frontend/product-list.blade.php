@extends('online-frontend.layouts.app')
@section('title', 'Product List')
@section('content')

<div class="">
    <div class="container-fluid">
        <div class="row">

            <!-- Carousel Section -->
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="RightDivProduct py-3">
                    <div class="row g-2">
                        <!-- Product 1 -->
                        @if(isset($errorMessage))
                        <p class="text-center text-danger">{{ $errorMessage }}</p>
                        @else
                        @foreach($products as $index => $product)
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-5">
                            <!-- Adjusted column classes -->
                            <a class="text-decoration-none text-dark"
                                href="{{ url('/product' .'/' . $product->sku . '/' . $product->product_id ) }}"
                                data-product-id="{{ $product->product_id }}">
                                <div class="card border-0 text-center p-2">
                                    <div class="tab-content mt-4">
                                        <div class="tab-pane tabPane fade show active" id="product{{$index}}-tab1"
                                            role="tabpanel">
                                            <img src="{{ asset('assets/product_images/' . $product->product_image) }}"
                                                class="img-fluid main-product-image" alt="Tab 1 Image">
                                        </div>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="productListTab py-3">
                                            <div class="owl-carousel owl-theme" id="productlist{{$index}}">
                                                @foreach($metalTypesValues as $metalTypesValue)
                                                <div class="item" data-bs-target="#product{{$index}}-tab1">
                                                    <input type="radio" name="metalType{{$index}}"
                                                        value="{{$metalTypesValue->title}}">
                                                    <img src="{{ asset($metalTypesValue->attribute_image) }}"
                                                        alt="{{ $metalTypesValue->title }}">
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <p class="card-text">{{$product->product_name}}</p>
                                        <span class="ProductCard-Price">${{$product->price}}</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script>
// Update price and image dynamically on metal type hover
$('.owl-carousel .item').on('mouseenter', function() {
    const metalType = $(this).find('input').val();
    const productId = $(this).closest('a').data('product-id');
    const productCard = $(this).closest('.card');

    // Make an AJAX request to get the updated image and price
    $.ajax({
        url: `/get-metal-image/${productId}/${metalType}`,
        method: 'GET',
        success: function(response) {
            if (response && response.length > 0) {
                const updatedProduct = response[0]; // Get the first product from the response

                // Update the product image if available
                if (updatedProduct.image) {
                    productCard.find('.main-product-image').attr('src', updatedProduct.image);
                }

                // Update the product price if available
                if (updatedProduct.price) {
                    productCard.find('.ProductCard-Price').text(`$${updatedProduct.price}`);
                }
            }
        },
        error: function() {
            console.error('Failed to fetch metal image or price.');
        }
    });
});
</script>

<!-- Owl Carousel Initializations -->
<script>
$(document).ready(function() {
    // Initialize Owl Carousel for Metal Type
    $("#SingleProductOne").owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 5
            }
        }
    });

    // Initialize Owl Carousel for Shape
    $("#SingleProductThree").owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 5
            }
        }
    });

    // Initialize Owl Carousel for Product List
    $(".owl-carousel").owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 3
            }
        }
    });
});
</script>
@endsection
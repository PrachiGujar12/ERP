<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{asset('asset/css/frontend/style.css')}}">
    <link rel="stylesheet" href="{{asset('asset/css/frontend/main.css')}}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

  
</head>
	
<body>
	
	    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <!-- Left Section: Icons -->
            <div class="d-flex align-items-center me-auto">
                <a href="tel:+1234567890" class="me-4 text-dark fw-medium list-unstyled">
                    <i class="bi bi-telephone-fill me-2"></i>+123 456 7890
                </a>
                <a class="fw-medium list-unstyled text-dark" href="#">Book Appointment</a>
            </div>

            <!-- Center Section: Logo -->
            <a href="#" class="navbar-brand mx-auto">
                <img src="{{asset('asset/images/logo/Raman-Jewellers-Logo-A.png')}}" alt="Logo">
            </a>

            <!-- Right Section: Mobile Number & Book Appointment -->
            <div class="d-flex align-items-center ms-auto">
                <a href="#" class="me-3 text-dark">
                    <i class="bi bi-search" style="font-size: 1.5rem;"></i>
                </a>
                <a href="#" class="me-3 text-dark">
                    <i class="bi bi-person" style="font-size: 1.5rem;"></i>
                </a>
                <a href="#" class="me-3 text-dark">
                    <i class="bi bi-heart" style="font-size: 1.5rem;"></i>
                </a>
                <a href="#" class="text-dark">
                    <i class="bi bi-bag" style="font-size: 1.5rem;"></i>
                </a>
            </div>
        </div>
    </nav>

<div class="container my-5">
    <div class="row">
        <div class="col-md-6">
            <!-- Product Image -->
            <img src="{{ asset('assets/product_images/' . $product->product_image) }}" alt="{{ $product->name }}" class="img-fluid">
        </div>
        <div class="col-md-6">
            <!-- Product Details -->
            <h1>{{ $product->product_name }}</h1>
            <p class="text-muted">Sku: {{ $product->sku }}</p>
            <p>{{ $product->description }}</p>
            <h3>${{ number_format($product->price, 2) }}</h3>

            <!-- Add to Cart Button -->
            <button class="btn btn-primary">Add to Cart</button>
        </div>
    </div>
</div>
	
</body>
</html>
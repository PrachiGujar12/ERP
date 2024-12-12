<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raman Jewelry</title>
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

    <style>
    .carousel-control-prev-icon {
        background-color: gray;
        width: 30px;
        height: 30px;
    }

    .carousel-control-next-icon {
        background-color: gray;
        width: 30px;
        height: 30px;
    }

    .form-range {
        width: 100%;
        /* Ensures the slider takes up full width */
    }
    </style>
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
                @if (Auth::guard('online-customer')->check())
                <div class="dropdown">
                    <a class="btn nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="login__icon"><i class="fa-solid fa-user"></i></span>
                        Welcome, {{ Auth::guard('online-customer')->user()->first_name }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <li><a class="dropdown-item" href="{{ url('customer-profile') }}">Profile</a></li>
                        <li>
                            <form method="POST" action="{{ route('customer.logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
                @else
                <a href="{{ route('customer.login') }}" class="btn nav-link">
                    <span class="login__icon"><i class="fa-solid fa-user"></i></span>
                    Sign In
                </a>
                @endif
            </div>


        </div>
    </nav>



    <!-- Filter Section -->
    <div class="container py-4">
        <h1 class="text-center">Engagement Ring Settings</h1>
        <div class="row col-md-12 p-4 mt-4">
            <div class="col-md-4">
                <h5>Shape</h5>
                <!-- Carousel -->
                <div id="shapeCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="row">
                                <div class="col shape-filter-content text-center" tabindex="-1" style="width: 100%;">
                                    <div class="shape-filter-icon-content mb-2">
                                        <img src="{{ asset('assets/shapes/emerald_3.png') }}" alt="Emerald Shape"
                                            class="img-fluid rounded-circle shadow"
                                            style="width: 50px; height: 50px; object-fit: cover;">
                                    </div>
                                    <span class="shape-title fw-semibold">Emerald</span>
                                </div>

                                <div class="col shape-filter-content text-center" tabindex="-1" style="width: 100%;">
                                    <div class="shape-filter-icon-content mb-2">
                                        <img src="{{ asset('assets/shapes/heart_3.png') }}" alt="Heart Shape"
                                            class="img-fluid rounded-circle shadow"
                                            style="width: 50px; height: 50px; object-fit: cover;">
                                    </div>
                                    <span class="shape-title fw-semibold">Heart</span>
                                </div>

                                <div class="col shape-filter-content text-center" tabindex="-1" style="width: 100%;">
                                    <div class="shape-filter-icon-content mb-2">
                                        <img src="{{ asset('assets/shapes/marquise_3.png') }}" alt="Marquise Shape"
                                            class="img-fluid rounded-circle shadow"
                                            style="width: 50px; height: 50px; object-fit: cover;">
                                    </div>
                                    <span class="shape-title fw-semibold">Marquise</span>
                                </div>
                                <div class="col shape-filter-content text-center" tabindex="-1" style="width: 100%;">
                                    <div class="shape-filter-icon-content mb-2">
                                        <img src="{{ asset('assets/shapes/oval_3.png') }}" alt="Oval Shape"
                                            class="img-fluid rounded-circle shadow"
                                            style="width: 50px; height: 50px; object-fit: cover;">
                                    </div>
                                    <span class="shape-title fw-semibold">Oval</span>
                                </div>

                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="row">
                                <div class="col shape-filter-content text-center" tabindex="-1" style="width: 100%;">
                                    <div class="shape-filter-icon-content mb-2">
                                        <img src="{{ asset('assets/shapes/pear_3.png') }}" alt="Pear Shape"
                                            class="img-fluid rounded-circle shadow"
                                            style="width: 50px; height: 50px; object-fit: cover;">
                                    </div>
                                    <span class="shape-title fw-semibold">Pear</span>
                                </div>
                                <div class="col shape-filter-content text-center" tabindex="-1" style="width: 100%;">
                                    <div class="shape-filter-icon-content mb-2">
                                        <img src="{{ asset('assets/shapes/princess_3.png') }}" alt="Princess Shape"
                                            class="img-fluid rounded-circle shadow"
                                            style="width: 50px; height: 50px; object-fit: cover;">
                                    </div>
                                    <span class="shape-title fw-semibold">Princess</span>
                                </div>
                                <div class="col shape-filter-content text-center" tabindex="-1" style="width: 100%;">
                                    <div class="shape-filter-icon-content mb-2">
                                        <img src="{{ asset('assets/shapes/round_3.png') }}" alt="Round Shape"
                                            class="img-fluid rounded-circle shadow"
                                            style="width: 50px; height: 50px; object-fit: cover;">
                                    </div>
                                    <span class="shape-title fw-semibold">Round</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Controls -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#shapeCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"
                            style="background-color: gray; margin-left: -57px"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#shapeCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

            <div class="col-md-4">
                <h5>Price</h5>
                <div class="range-slider">
                    <div class="slider-track"></div>
                    <div class="slider-range" id="slider-range"></div>
                    <input type="range" id="min-range" min="0" max="100" step="1" value="20">
                    <input type="range" id="max-range" min="0" max="100" step="1" value="80">
                </div>
                <div class="d-flex justify-content-between mt-3">
                    <span>Min: <span id="min-value">20</span></span>
                    <span>Max: <span id="max-value">80</span></span>
                </div>
            </div>



            <div class="col-md-4">
                <h5>Metal Type</h5> <!-- Carousel -->
                <div id="metalCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="row">
                                <div class="col shape-filter-content text-center" tabindex="-1" style="width: 100%;">
                                    <div class="shape-filter-icon-content mb-2">
                                        <img src="{{ asset('assets/metaltype/14k-rg-1_4.png') }}" alt="Marquise Shape"
                                            class="img-fluid rounded-circle shadow"
                                            style="width: 50px; height: 50px; object-fit: cover;">
                                    </div>
                                </div>
                                <div class="col shape-filter-content text-center" tabindex="-1" style="width: 100%;">
                                    <div class="shape-filter-icon-content mb-2">
                                        <img src="{{ asset('assets/metaltype/14k-wg-1_1.png') }}" alt="Marquise Shape"
                                            class="img-fluid rounded-circle shadow"
                                            style="width: 50px; height: 50px; object-fit: cover;">
                                    </div>
                                </div>
                                <div class="col shape-filter-content text-center" tabindex="-1" style="width: 100%;">
                                    <div class="shape-filter-icon-content mb-2">
                                        <img src="{{ asset('assets/metaltype/14k-yg-1_2.png') }}" alt="Marquise Shape"
                                            class="img-fluid rounded-circle shadow"
                                            style="width: 50px; height: 50px; object-fit: cover;">
                                    </div>
                                </div>
                                <div class="col shape-filter-content text-center" tabindex="-1" style="width: 100%;">
                                    <div class="shape-filter-icon-content mb-2">
                                        <img src="{{ asset('assets/metaltype/18k-rg-1_3.png') }}" alt="Marquise Shape"
                                            class="img-fluid rounded-circle shadow"
                                            style="width: 50px; height: 50px; object-fit: cover;">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="row">
                                <div class="col shape-filter-content text-center" tabindex="-1" style="width: 100%;">
                                    <div class="shape-filter-icon-content mb-2">
                                        <img src="{{ asset('assets/metaltype/18k-wg-1_1.png') }}" alt="Marquise Shape"
                                            class="img-fluid rounded-circle shadow"
                                            style="width: 50px; height: 50px; object-fit: cover;">
                                    </div>
                                </div>

                                <div class="col shape-filter-content text-center" tabindex="-1" style="width: 100%;">
                                    <div class="shape-filter-icon-content mb-2">
                                        <img src="{{ asset('assets/metaltype/18k-yg-1_1.png') }}" alt="Marquise Shape"
                                            class="img-fluid rounded-circle shadow"
                                            style="width: 50px; height: 50px; object-fit: cover;">
                                    </div>
                                </div>

                                <div class="col shape-filter-content text-center" tabindex="-1" style="width: 100%;">
                                    <div class="shape-filter-icon-content mb-2">
                                        <img src="{{ asset('assets/metaltype/pt-1.png') }}" alt="Marquise Shape"
                                            class="img-fluid rounded-circle shadow"
                                            style="width: 50px; height: 50px; object-fit: cover;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Controls -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#metalCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"
                            style="background-color: gray; margin-left: -57px"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#metalCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>



</body>

</html>
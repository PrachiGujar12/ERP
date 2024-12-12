<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Raman Jewellers</title>
    <link rel="stylesheet" href="style.css">
	    <meta name="description" content="@yield('meta_description', '')">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <link rel="icon" href="{{asset('/asset/images/logo/fav.png')}}" sizes="32x32">

    <!-- bootstrap icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Custom fonts for this template-->
    <link href="{{asset('/asset/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">

    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('/asset/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('asset/css/custom-style.css')}}" />

    <!-- Table css -->
    <link href="{{asset('/asset/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
	<style>
		/* Basic Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Arial', sans-serif;
    line-height: 1.6;
    color: #333;
}

/* Header */
header {
    background: #000;
    color: #fff;
    padding: 1rem 0;
}

header .container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 2rem;
}

.logo h1 {
    font-size: 1.8rem;
    font-weight: bold;
}

nav ul {
    list-style: none;
    display: flex;
    gap: 1rem;
}

nav ul li {
    display: inline;
}

nav ul li a {
    color: #fff;
    text-decoration: none;
    font-weight: bold;
}

nav ul li a:hover {
    text-decoration: underline;
}

/* Hero Section */
.hero-section {
    background: url('https://demo.webwideit.solutions/raman-jeweller-erp/public/asset/images/background/back.webp') no-repeat center center/cover;
    height: 75vh;
    display: flex;
    justify-content: center;
    align-items: center;
    color: #fff;
    text-align: center;
}

.hero-section h2 {
    font-size: 3rem;
    margin-bottom: 1rem;
}

.hero-section p {
    font-size: 1.5rem;
    margin-bottom: 2rem;
}

.hero-section .btn {
    padding: 0.8rem 2rem;
    background: #ff6600;
    color: #fff;
    text-decoration: none;
    border-radius: 4px;
    font-weight: bold;
}

.hero-section .btn:hover {
    background: #e65c00;
}

/* About Section */
.about-section {
    padding: 4rem 2rem;
    background: #f4f4f4;
}

.about-section h2 {
    text-align: center;
    margin-bottom: 2rem;
    font-size: 2rem;
}

/* Footer */
footer {
    background: #333;
    color: #fff;
    text-align: center;
    padding: 1rem 0;
}

footer .container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 2rem;
}

footer p {
    margin: 0;
}

footer ul {
    list-style: none;
    display: flex;
    gap: 1rem;
}

footer ul li a {
    color: #fff;
    text-decoration: none;
    font-weight: bold;
}

footer ul li a:hover {
    text-decoration: underline;
}

/* Responsive Design */
@media (max-width: 768px) {
    header .container {
        flex-direction: column;
    }

    nav ul {
        flex-direction: column;
        gap: 0.5rem;
    }

    footer .container {
        flex-direction: column;
    }
}

	</style>
</head>
<body>
    <!-- Header Section -->
    <header>
        <div class="container">
            <div class="logo">
                <img src="https://demo.webwideit.solutions/raman-jeweller-erp/public/asset/images/logo/logo.png" width="150px">
            </div>
            <nav>
                <ul>
                    <li><a class="JewelleryPrimaryButton" href="{{ route('customer.login') }}" style="background:#df9700">Customer Login</a></li>

                    <li><a class="JewelleryPrimaryButton" href="{{ route('login') }}" style="background:#df9700">Admin Login</a></li>
                    <li><a  class="JewelleryPrimaryButton" href="{{ route('register') }}">Register</a></li>
                    
            </nav>
        </div>
    </header>

    <!-- Main Content Section -->
    <main>
        <section id="home" class="hero-section">
            <div class="hero-text">
                <h2 class=" p-4" style="    background: #000000ba;
    border-radius: 15px; color:#fff">Coming Soon...</h2>
            </div>
        </section>
        <!-- Add more sections as needed -->
    </main>

    <!-- Footer Section -->
    <footer class="sticky-footer p-3 " style="background-color:#000" >
                <div class="container my-auto d-flex align-items-center justify-content-center">
                    <div class="copyright text-center my-auto text-light">
                        <p>Copyright &copy; Designed & Developed by <a class="text-decoration-none text-light" target="_blank"
                                href="https://webwideit.solutions">webwideit.solutions</a> 2024</p>
                    </div>
                </div>
	</footer>
</body>
</html>

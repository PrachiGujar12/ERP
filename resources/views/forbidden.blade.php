<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title', 'ERP System')</title>
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

    <!-- Table css -->
    <link href="{{asset('/asset/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body id="page-top">
    <div class="d-flex justify-content-center align-items-center" style="height:100vh">
    <div class="container">
        <h1 class="h1">403 Forbidden</h1>
        <p>You do not have permission to access this page.</p>
        <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3"><i class="bi bi-arrow-left"></i> Back</a>

    </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('/asset/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('/asset/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('/asset/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('/asset/js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{asset('/asset/vendor/chart.js/Chart.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('/asset/js/demo/chart-area-demo.js')}}"></script>



    <!-- table js -->
    <script src="{{asset('/asset/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('/asset/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('/asset/js/demo/datatables-demo.js')}}"></script>

</body>

</html>

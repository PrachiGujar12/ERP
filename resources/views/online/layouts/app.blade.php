<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Blog</title>
    <!-- base:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/base/vendor.bundle.base.css')}}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png')}}" />
  </head>
  <body>
    <div class="container-scroller">
				
		<!-- partial:partials/_horizontal-navbar.html -->
    <div class="horizontal-menu">
    @include('online.layouts.header')
    </div>
    <!-- partial -->
    @yield('content') 
		
		<!-- page-body-wrapper ends -->
    </div>
		<!-- container-scroller -->
    <!-- base:js -->
    <script src="{{ asset('assets/vendors/base/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="{{ asset('assets/js/template.js')}}"></script>
    <!-- endinject -->
    <!-- plugin js for this page -->
    <!-- End plugin js for this page -->
    <script src="{{ asset('assets/vendors/chart.js/Chart.min.js')}}"></script>
    <script src="{{ asset('assets/vendors/progressbar.js/progressbar.min.js')}}"></script>
		<script src="{{ asset('assets/vendors/chartjs-plugin-datalabels/chartjs-plugin-datalabels.js')}}"></script>
		<script src="{{ asset('assets/vendors/justgage/raphael-2.1.4.min.js')}}"></script>
		<script src="{{ asset('assets/vendors/justgage/justgage.js')}}"></script>
    <script src="{{ asset('assets/js/jquery.cookie.js" type="text/javascript')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    
    <script src="{{ URL::asset('/ckeditor/ckeditor.js') }}"></script>        
    <script>
        if ($('#my-editor').length > 0) {
            var options = {
                filebrowserImageBrowseUrl: '{{url("/")}}/laravel-filemanager?type=Images',
                filebrowserImageUploadUrl: '{{url("/")}}/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
                filebrowserBrowseUrl: '{{url("/")}}/laravel-filemanager?type=Files',
                filebrowserUploadUrl: '{{url("/")}}/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}',

            };
            CKEDITOR.replace('my-editor', options);
        }
    </script>
    <script>
        if ($('#my-editor-seo').length > 0) {
            var options = {
                filebrowserImageBrowseUrl: '{{url("/")}}/laravel-filemanager?type=Images',
                filebrowserImageUploadUrl: '{{url("/")}}/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
                filebrowserBrowseUrl: '{{url("/")}}/laravel-filemanager?type=Files',
                filebrowserUploadUrl: '{{url("/")}}/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}',

            };
            CKEDITOR.replace('my-editor-seo', options);
        }
    </script>
    <script>
        if ($('#my-editor-social').length > 0) {
            var options = {
                filebrowserImageBrowseUrl: '{{url("/")}}/laravel-filemanager?type=Images',
                filebrowserImageUploadUrl: '{{url("/")}}/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
                filebrowserBrowseUrl: '{{url("/")}}/laravel-filemanager?type=Files',
                filebrowserUploadUrl: '{{url("/")}}/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}',

            };
            CKEDITOR.replace('my-editor-social', options);
        }
    </script>
    <script>
        if ($('#my-editor-x').length > 0) {
            var options = {
                filebrowserImageBrowseUrl: '{{url("/")}}/laravel-filemanager?type=Images',
                filebrowserImageUploadUrl: '{{url("/")}}/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
                filebrowserBrowseUrl: '{{url("/")}}/laravel-filemanager?type=Files',
                filebrowserUploadUrl: '{{url("/")}}/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}',

            };
            CKEDITOR.replace('my-editor-x', options);
        }
    </script>
    <!-- Custom js for this page-->
    <script src="{{ asset('assets/js/dashboard.js')}}"></script>
    <!-- End custom js for this page-->
  </body>
</html>
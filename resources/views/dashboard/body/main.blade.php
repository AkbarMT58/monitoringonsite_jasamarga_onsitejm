<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Monitoring Security JM </title>

        <!-- Favicon -->
        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}"/>
        <link rel="stylesheet" href="{{ asset('assets/css/backend-plugin.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/backend.css?v=1.0.0') }}">

        <link rel="stylesheet" href="{{ asset('assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendor/remixicon/fonts/remixicon.css') }}">

        <link rel="stylesheet" href="{{ asset('assets/css/notify.css') }}">
       
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.3.7/jquery.datetimepicker.min.css"/>
            
        <link rel="stylesheet" href="{{ asset('assets/css/web.css') }}">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/AngeloFaella/CircularProgressBar@1.0/circularProgressBar.css">

        
        
         <!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
        <!-- <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>  -->
        
       

        @yield('specificpagestyles')
    </head>
<body>
    <!-- loader Start -->
    {{-- <div id="loading">
        <div id="loading-center"></div>
    </div> --}}
    <!-- loader END -->

    <!-- Wrapper Start -->
    <div class="wrapper">
        @include('dashboard.body.sidebar')

        @include('dashboard.body.navbar')

        <div class="content-page">
            @yield('container')
        </div>
    </div>
    <!-- Wrapper End-->

    @include('dashboard.body.footer')

    <!-- Backend Bundle JavaScript -->
    <script src="{{ asset('assets/js/backend-bundle.min.js') }}"></script>
    <!-- <script src="https://kit.fontawesome.com/4c897dc313.js" crossorigin="anonymous"></script> -->

    @yield('specificpagescripts')

    <!-- App JavaScript -->
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/js/notify.js') }}"></script>
    <script src="{{  asset('assets/js/jquery-3.5.1.min.js') }}"></script>

    
	{{-- message toastr --}}
	<link rel="stylesheet" href="{{  asset('assets/css/toastr.min.css') }}">


	<script src="{{  asset('assets/js/toastr_jquery.min.js') }}"></script>
	<script src="{{  asset('assets/js/toastr.min.js') }}"></script>
	<script src="{{  asset('assets/js/toastr.min.js') }}"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js" integrity="sha512-AIOTidJAcHBH2G/oZv9viEGXRqDNmfdPVPYOYKGy3fti0xIplnlgMHUGfuNRzC6FkzIo0iIxgFnr9RikFxK+sw==" 
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.js" integrity="sha512-9yoLVdmrMyzsX6TyGOawljEm8rPoM5oNmdUiQvhJuJPTk1qoycCK7HdRWZ10vRRlDlUVhCA/ytqCy78+UujHng==" 
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>


     
    <script type="text/javascript" src="{{  asset('assets/js/gridviewscroll.js') }}"></script>

      <script src="https://cdn.jsdelivr.net/gh/AngeloFaella/CircularProgressBar@1.0/circularProgressBar.min.js"></script>

<script src=" https://cdn.jsdelivr.net/npm/rich-text-editor-vj@3.0.6/js/froala_editor.min.js "></script>
<link href=" https://cdn.jsdelivr.net/npm/rich-text-editor-vj@3.0.6/css/froala_editor.min.css " rel="stylesheet">

    
    
</body>
</html>

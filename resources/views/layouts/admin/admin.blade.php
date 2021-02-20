<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <!-- ========== COMMON STYLES ========== -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}" media="screen" >
    <link rel="stylesheet" href="{{asset('assets/css/font-awesome.min.css')}}" media="screen" >
    <link rel="stylesheet" href="{{asset('assets/css/animate-css/animate.min.css')}}" media="screen" >
    <link rel="stylesheet" href="{{asset('assets/css/lobipanel/lobipanel.min.css')}}" media="screen" >

    <!-- ========== PAGE STYLES ========== -->
    <link rel="stylesheet" href="{{asset('assets/css/prism/prism.css')}}" media="screen" > <!-- USED FOR DEMO HELP - YOU CAN REMOVE IT -->
    <link rel="stylesheet" href="{{asset('assets/css/toastr/toastr.min.css')}}" media="screen" >
    <link rel="stylesheet" href="{{asset('assets/css/icheck/skins/line/blue.css')}}" >
    <link rel="stylesheet" href="{{asset('assets/css/icheck/skins/line/red.css')}}" >
    <link rel="stylesheet" href="{{asset('assets/css/icheck/skins/line/green.css')}}" >
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap-tour/bootstrap-tour.css')}}" >
    <link rel="stylesheet" href="{{asset('assets/css/icheck/skins/square/blue.css')}}" >
    <link rel="stylesheet" href="{{asset('assets/sweetalert2/dist/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/select2/select2.min.css')}}">

    <!-- ========== THEME CSS ========== -->
    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}" media="screen" >


    <!-- ========== MODERNIZR ========== -->
    <script src="{{asset('assets/js/modernizr/modernizr.min.js')}}"></script>
    @yield('css')
</head>
<body class="top-navbar-fixed">
<div class="main-wrapper">

    <!-- ========== TOP NAVBAR ========== -->
    <nav class="navbar top-navbar bg-white box-shadow">
        <div class="container-fluid">
            <div class="row">
                <div class="navbar-header no-padding">
                    <a class="navbar-brand" href="index.html">
                        <img src="{{asset('assets/images/footer-logo.png')}}" alt="Doğaçiftlik" class="logo">
                    </a>
                    <span class="small-nav-handle hidden-sm hidden-xs"><i class="fa fa-outdent"></i></span>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <i class="fa fa-ellipsis-v"></i>
                    </button>
                    <button type="button" class="navbar-toggle mobile-nav-toggle" >
                        <i class="fa fa-bars"></i>
                    </button>
                </div>

                <div class="collapse navbar-collapse" id="navbar-collapse-1">
                    <ul class="nav navbar-nav" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                        <li class="hidden-xs hidden-xs"><!-- <a href="#">My Tasks</a> --></li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
j                        <li class="dropdown tour-two">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{\Illuminate\Support\Facades\Auth::user()->name}}<span class="caret"></span></a>
                            <ul class="dropdown-menu profile-dropdown">
                                <li class="profile-menu bg-gray">
                                    <div class="">
                                        <img src="http://placehold.it/60/c2c2c2?text=User" alt="user-image" class="img-circle profile-img">
                                        <div class="profile-name">
                                            <h6>{{\Illuminate\Support\Facades\Auth::user()->name}}</h6>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </li>
                                <li><a href="javascript:void(0)" onclick="document.getElementById('frmLogout').submit()" class="color-danger text-center"><i class="fa fa-sign-out"></i> Çıkış Yap</a></li>
                            </ul>
                        </li>
                        <!-- /.dropdown -->
                    </ul>
                    <!-- /.nav navbar-nav navbar-right -->
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
    <div class="content-wrapper">
        <div class="content-container">

           @include('layouts.admin.sidebar')

            <div class="main-page">
{{--                <div class="container-fluid">--}}
{{--                    <div class="row breadcrumb-div">--}}
{{--                        <div class="col-sm-12">--}}
{{--                            <ul class="breadcrumb">--}}
{{--                                <li><a href="index.html"><i class="fa fa-home"></i> Home</a></li>--}}
{{--                                <li class="active">Dashboard</li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

                <section class="section">
                    <div class="container-fluid">
                @yield('content')
                    </div>
                </section>

            </div>

        </div>
        <!-- /.content-container -->
    </div>
    <!-- /.content-wrapper -->

</div>
<!-- /.main-wrapper -->

<!-- ========== COMMON JS FILES ========== -->
<script src="{{asset('assets/js/jquery/jquery-2.2.4.min.js')}}"></script>
<script src="{{asset('assets/js/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/pace/pace.min.js')}}"></script>
<script src="{{asset('assets/js/lobipanel/lobipanel.min.js')}}"></script>
<script src="{{asset('assets/js/iscroll/iscroll.js')}}"></script>

<!-- ========== PAGE JS FILES ========== -->
<script src="{{asset('assets/js/prism/prism.js')}}"></script>
<script src="{{asset('assets/js/waypoint/waypoints.min.js')}}"></script>
<script src="{{asset('assets/js/counterUp/jquery.counterup.min.js')}}"></script>
<script src="{{asset('assets/js/amcharts/amcharts.js')}}"></script>
<script src="{{asset('assets/js/amcharts/serial.js')}}"></script>
<script src="{{asset('assets/js/amcharts/plugins/export/export.min.js')}}"></script>
<link rel="stylesheet" href="{{asset('assets/js/amcharts/plugins/export/export.css')}}" type="text/css" media="all" />
<script src="{{asset('assets/js/amcharts/themes/light.js')}}"></script>
<script src="{{asset('assets/js/toastr/toastr.min.js')}}"></script>
<script src="{{asset('assets/js/icheck/icheck.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap-tour/bootstrap-tour.js')}}"></script>

<!-- ========== THEME JS ========== -->
<script src="{{asset('assets/js/main.js')}}"></script>
<script src="{{asset('assets/js/production-chart.js')}}"></script>
<script src="{{asset('assets/js/traffic-chart.js')}}"></script>
<script src="{{asset('assets/js/task-list.js')}}"></script>
<script src="{{asset('assets/js/icheck/icheck.min.js')}}"></script>
<script src="{{asset('assets/sweetalert2/dist/sweetalert2.min.js')}}"></script>
<script src="{{asset('assets/js/select2/select2.min.js')}}"></script>

@include('sweetalert::alert')

@yield('js'))
<script>
    $(function(){
    $('input.blue-style').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue'
            });

            $('input.line-style').each(function(){
                var self = $(this),
                    label = self.next(),
                    label_text = label.text();

                label.remove();
                self.iCheck({
                    checkboxClass: 'icheckbox_line-blue',
                    radioClass: 'iradio_line-blue',
                    insert: '<div class="icheck_line-icon"></div>' + label_text
                });
            });




        // Counter for dashboard stats
        $('.counter').counterUp({
            delay: 10,
            time: 1000
        });

        // Welcome notification
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "3500",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        // toastr["success"]("One stop solution to your website admin panel!", "Welcome to Options!");

    });

</script>

<!-- ========== ADD custom.js FILE BELOW WITH YOUR CHANGES ========== -->
</body>
</html>

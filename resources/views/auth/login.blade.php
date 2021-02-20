<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Panel</title>

    <!-- ========== COMMON STYLES ========== -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}" media="screen" >
    <link rel="stylesheet" href="{{asset('assets/css/font-awesome.min.css')}}" media="screen" >
    <link rel="stylesheet" href="{{asset('assets/css/animate-css/animate.min.css')}}" media="screen" >
    <link rel="stylesheet" href="{{asset('assets/sweetalert2/dist/sweetalert2.min.css')}}">

    <!-- ========== PAGE STYLES ========== -->
    <link rel="stylesheet" href="{{asset('assets/css/prism/prism.css')}}" media="screen" >

    <!-- ========== THEME CSS ========== -->
    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}" media="screen" >

    <!-- ========== MODERNIZR ========== -->
    <script src="{{asset('assets/js/modernizr/modernizr.min.js')}}"></script>
</head>
<body class="">
<div class="main-wrapper">

    <div class="login-bg">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-box">
                    <h4 class="text-center mt-10 mb-20">Login Panel</h4>

                    <form action="{{route('login')}}" id="frmLogin" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="email" class="form-control input-lg" id="email" name="email" placeholder="E-Mail" autocomplete="off" >
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control input-lg" name="password" id="password" placeholder="Şifre">
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox"> Beni hatırla
                            </label>
                        </div>
                        <div class="form-group mt-20">
                            <div>
                                <button type="button" id="btnLogin" class="btn btn-success btn-block pull-right">Giriş Yap</button>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="form-group mt-20">
                            <div>
                                <a href="{{route('register')}}" class="btn btn-primary btn-block pull-right">Kayıt Ol</a>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </form>

                    <hr>


                    <p class="text-muted text-center mb-n"><img src="{{asset('assets/front-assets/img/footer-logo.png')}}" alt=""></p>
                </div>
                <!-- /.login-box -->
            </div>
            <!-- /.col-md-6 col-md-offset-3 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /. -->

</div>
<!-- /.main-wrapper -->

<!-- ========== COMMON JS FILES ========== -->
<script src="{{asset('assets/js/jquery/jquery-2.2.4.min.js')}}"></script>
<script src="{{asset('assets/js/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/pace/pace.min.js')}}"></script>
<script src="{{asset('assets/js/lobipanel/lobipanel.min.js')}}"></script>
<script src="{{asset('assets/js/iscroll/iscroll.js')}}"></script>
<script src="{{asset('assets/sweetalert2/dist/sweetalert2.min.js')}}"></script>

<!-- ========== PAGE JS FILES ========== -->

<!-- ========== THEME JS ========== -->
<script src="{{asset('assets/js/main.js')}}"></script>

<script>
    $(document).ready(function(){
        $('#btnLogin').click(function ()
        {
            let email = $('#email').val();
            let pass = $('#password').val();
            if (email == '')
            {
                Swal.fire({
                    title: 'Hata!',
                    text: 'Lütfen e-mail giriniz.',
                    icon: 'error',
                    confirmButtonText: 'Tamam'
                });
            }
            else if (pass == '')
            {
                Swal.fire({
                    title: 'Hata!',
                    text: 'Lütfen parola giriniz.',
                    icon: 'error',
                    confirmButtonText: 'Tamam'
                });
            }
            else
            {
                $('#frmLogin').submit();
            }

        });
    });

</script>
<!-- ========== ADD custom.js FILE BELOW WITH YOUR CHANGES ========== -->
</body>
</html>

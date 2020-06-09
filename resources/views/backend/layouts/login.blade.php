<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <!-- Viewport metatags -->
    <meta name="HandheldFriendly" content="true" />
    <meta name="MobileOptimized" content="320" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <link rel="shortcut icon" href="assets/images/ico/fab.ico">

    <title> تسجيل الدخول مكتب جون</title>

    <link href="{{ url('elixir/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ url('elixir/css/bootstrap-rtl.css') }}" rel="stylesheet">

    <link href="{{ url('elixir/css/rtl-css/style-rtl.css') }}" rel="stylesheet">
    <link href="{{ url('elixir/css/rtl-css/responsive-rtl.css') }}" rel="stylesheet">
</head>
<body class="login-screen">
<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="login-box">
                    <div class="login-content">
                        <div class="login-user-icon">
                            <i class="glyphicon glyphicon-user"></i>

                        </div>
                        <h3>مكتب جون للعبايات</h3>
                    </div>

                    <div class="login-form">
                      
                      <form id="form-login" class="form-horizontal ls_form" method="post" action="{{url('login')}}">
                             <input type="hidden" name="_token" value="{{ csrf_token() }}">

                             @if(Session::has('login_error'))  
                              <p style="font-size:13px;color:white">أسم المستخدم او كلمة المرور غير صحيحة</p>
                             @endif

                            <div class="input-group ls-group-input">
                                <input class="form-control" name="username" type="text" placeholder="أسم الستخدم" requried>
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            </div>


                            <div class="input-group ls-group-input">

                                <input type="password" placeholder="كلمة المرور" name="password"
                                       class="form-control" requried>
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            </div>

                            <div class="remember-me">
                                <input class="switchCheckBox" type="checkbox"   name="remember" >
                                <span>Remember me</span>
                            </div>
                            <div class="input-group ls-group-input login-btn-box">
                                <button class="btn ls-dark-btn ladda-button col-md-12 col-sm-12 col-xs-12" data-style="slide-down">
                                    <span class="ladda-label"><i class="fa fa-key"></i> تسجيل دخول</span>
                                </button>
                            </div>
                        
                    </form>

                    </div>


                </div>
            </div>
        </div>
    </div>
    <p class="copy-right big-screen hidden-xs hidden-sm">
        <span>&#169;</span><a href="#" >Eng : Mark michil</a> 01211288688  <span class="footer-year">2020</span>
    </p>
</section>

</body>
<script src="{{ url('elixir/js/lib/jquery-2.1.1.min.js') }}"></script>
<script src="{{ url('elixir/js/lib/jquery.easing.js') }}"></script>
</html>
<!DOCTYPE html>
<html lang="en" class="coming-soon">
<head>
    <meta charset="utf-8">
    <title>Login Form</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="author" content="KaijuThemes">

    <link type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,400italic,600'
          rel='stylesheet'>

    <link type="text/css" href="{{ asset('/assets/fonts/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link type="text/css" href="{{ asset('/assets/fonts/themify-icons/themify-icons.css')}}" rel="stylesheet">
    <!-- Themify Icons -->
    <link type="text/css" href="{{ asset('/assets/fonts/weather-icons/css/weather-icons.min.css')}}" rel="stylesheet">
    <!-- Weather Icons -->

    <link rel="stylesheet" href="{{ asset('/assets/css/styles-alternative.css')}}" id="theme">
    <!-- Default CSS: Altenate Style -->
    <link rel="prefetch alternate stylesheet" href="{{ asset('/assets/css/styles.css')}}">
    <!-- Prefetched Secondary Style -->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries. Placeholdr.js enables the placeholder attribute -->
    <!--[if lt IE 9]>
    <link type="text/css" href="{{ asset('/assets/css/ie8.css')}}" rel="stylesheet">
    <script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- The following CSS are included as plugins and can be removed if unused-->

</head>

<body class="focused-form">


<div class="container" id="login-form">
    <a href="index.html" class="login-logo"><img src="{{ asset('/assets/img/logo-big.png')}}"></a>
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>Login Form</h2>
                </div>
                <div class="panel-body">

                    {!! Form::open(['url'=>'auth/login', 'method' => "POST", 'class' => 'form-horizontal', 'id' => 'validate-form']) !!}
                    {!! csrf_field() !!}
                    <div class="form-group mb-md">
                        <div class="col-xs-12">
                            <div class="input-group">
										<span class="input-group-addon">
											<i class="ti ti-user"></i>
										</span>
                                <input type="text" class="form-control" name="email" placeholder="Username"
                                       value="{{ old('email') }}" data-parsley-minlength="6" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-md">
                        <div class="col-xs-12">
                            <div class="input-group">
										<span class="input-group-addon">
											<i class="ti ti-key"></i>
										</span>
                                <input type="password" name="password" class="form-control"
                                       id="exampleInputPassword1" placeholder="Password">
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-n">
                        <div class="col-xs-12">
                            @if(Session::has('message'))
                                <div class="alert alert-danger">
                                    @lang('messages.login_and_password_invalids')<br>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
                <div class="panel-footer">
                    <div class="clearfix">
                        <button type="submit" class="btn btn-primary pull-right">Logar</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>


<!-- Load site level scripts -->

<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script> -->

<script type="text/javascript" src="{{ asset('/assets/js/jquery-1.10.2.min.js')}}"></script>
<!-- Load jQuery -->
<script type="text/javascript" src="{{ asset('/assets/js/jqueryui-1.10.3.min.js')}}"></script>
<!-- Load jQueryUI -->
<script type="text/javascript" src="{{ asset('/assets/js/bootstrap.min.js')}}"></script>
<!-- Load Bootstrap -->
<script type="text/javascript" src="{{ asset('/assets/js/enquire.min.js')}}"></script>
<!-- Load Enquire -->

<script type="text/javascript" src="{{ asset('/assets/plugins/velocityjs/velocity.min.js')}}"></script>
<!-- Load Velocity for Animated Content -->
<script type="text/javascript" src="{{ asset('/assets/plugins/velocityjs/velocity.ui.min.js')}}"></script>

<script type="text/javascript" src="{{ asset('/assets/plugins/wijets/wijets.js')}}"></script>
<!-- Wijet -->

<script type="text/javascript" src="{{ asset('/assets/plugins/codeprettifier/prettify.js')}}"></script>
<!-- Code Prettifier  -->
<script type="text/javascript" src="{{ asset('/assets/plugins/bootstrap-switch/bootstrap-switch.js')}}"></script>
<!-- Swith/Toggle Button -->

<script type="text/javascript" src="{{ asset('/assets/plugins/bootstrap-tabdrop/js/bootstrap-tabdrop.js')}}"></script>
<!-- Bootstrap Tabdrop -->

<script type="text/javascript" src="{{ asset('/assets/plugins/iCheck/icheck.min.js')}}"></script>
<!-- iCheck -->

<script type="text/javascript" src="{{ asset('/assets/plugins/nanoScroller/js/jquery.nanoscroller.min.js')}}"></script>
<!-- nano scroller -->
<script type="text/javascript" src="{{ asset('/assets/plugins/jquery-mousewheel/jquery.mousewheel.min.js')}}"></script>
<!-- Mousewheel support needed for Mapael -->

<script type="text/javascript" src="{{ asset('/assets/plugins/sparklines/jquery.sparklines.min.js')}}"></script>
<!-- Sparkline -->

<script type="text/javascript" src="{{ asset('/assets/js/application.js')}}"></script>
<script type="text/javascript" src="{{ asset('/assets/demo/demo.js')}}"></script>
<script type="text/javascript" src="{{ asset('/assets/demo/demo-switcher.js')}}"></script>

<!-- End loading site level scripts -->
<!-- Load page level scripts-->


<!-- End loading page level scripts-->
</body>
</html>
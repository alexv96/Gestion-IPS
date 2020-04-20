<!DOCTYPE html>
<html>

<head>
    <title>Instituto de Salud Pública | Contacto</title>
    <link href="{{ asset('front/css/bootstrap.css') }}" rel="stylesheet" type="text/css" media="all" />
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="{{ asset('front/js/jquery.min.js') }}"></script>
    <!-- Custom Theme files -->
    <!--theme-style-->
    <link href="{{ asset('front/css/style.css') }}" rel="stylesheet" type="text/css" media="all" />
    <script src="https://kit.fontawesome.com/837ecb9d5c.js" crossorigin="anonymous"></script>
    <!--//theme-style-->
    <link rel="stylesheet" href="{{ asset('slick-1.8.1/slick.css')}}">
	<link rel="stylesheet" href="{{ asset('slick-1.8.1/slick-theme.css')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Examen universitario DAI" />
    <script type="application/x-javascript">
        addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } 
    </script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" />
    <link rel="stylesheet" href="{{ asset('front/css/whatsapp.css')}}">
    @notify_css
</head>

<body>
    <a href="https://wa.me/56975966737" target="_blank"><div class="plus-button"></div></a>
    <!--header-->
    <div class="header header-top">
        <div class="container">
            <div class="logo">
                <h1><a href="{{ url('/')}}">
                        I<small>nstituto de</small> S<small>alud</small> P<small>ública</small>
                    </a></h1>
            </div>
            <div class="top-nav">
                <span class="menu"><img src="images/menu.png" alt=""> </span>
                <ul>
                    <li><a href="{{ url('/')}}" class="hvr-sweep-to-bottom">Inicio</a></li>
                    <li><a href="{{ url('/contacto') }}" class="hvr-sweep-to-bottom">Contacto </a></li>
                    <li><a href="{{ url('/registro')}}" class="hvr-sweep-to-bottom">Registrar </a></li>
                    <li><a href="{{ url('/cliente/login')}}" class="hvr-sweep-to-bottom">Ingresar </a></li>
                </ul>
                <div class="clearfix"> </div>
                <!--script-->
                <script>
                    $("span.menu").click(function(){
							$(".top-nav ul").slideToggle(500, function(){
							});
						});
                </script>
            </div>
            <div class="clearfix"> </div>
        </div>
        <!---->
    </div>
    
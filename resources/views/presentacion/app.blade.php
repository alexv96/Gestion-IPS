<!DOCTYPE html>
<html>

<head>
	<title>Instituto de Salud Pública | Inicio</title>
	<link href="{{ asset('front/css/bootstrap.css')}}" rel="stylesheet" type="text/css" media="all" />
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="{{ asset('front/js/jquery.min.js') }}"></script>
	<!-- Custom Theme files -->
	<!--theme-style-->
	<link href="{{ asset('front/css/style.css') }}" rel="stylesheet" type="text/css" media="all" />
	<!--//theme-style-->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Examen Universitario DAI" />

	<script src="https://kit.fontawesome.com/837ecb9d5c.js" crossorigin="anonymous"></script>
	
	<script type="application/x-javascript">
		addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } 
	</script>

	<link rel="stylesheet" href="{{ asset('front/css/whatsapp.css')}}">

	@notify_css
</head>

<body>
	<a href="https://wa.me/56975966737" target="_blank"><div class="plus-button"></div></a>

	<!--header-->
	<div class="header">
		<div class="container">
			<div class="logo">
				<h1><a href="{{ url('/')}}">
						I<small>nstituto de</small> S<small>alud</small> P<small>ública</small>
					</a></h1>
			</div>
			<div class="top-nav">
				<span class="menu"><img src="{{ asset('front/images/menu.png') }}" alt=""> </span>
				<ul>
					<li class="active"><a href="{{ url('/')}}">Inicio</a></li>
					<li><a href="{{ url('/contacto') }}" class="hvr-sweep-to-bottom">Contacto </a></li>
					<li><a href="{{ url('/registro') }}" class="hvr-sweep-to-bottom">Registrar</a></li>
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

	<div class="content">
		<div class="container">
			<!--content-top-->
			<div class="content-top">
				<div class="content-top1">
					<div class=" col-md-4 grid-top">
						<div class="top-grid">
							<i class="glyphicon glyphicon-book"></i>
							<div class="caption">
								<h3>Excelente tención 24/7</h3>
								<p>Personal apto y capacitado en la atención al público.</p>
							</div>
						</div>
					</div>
					<div class=" col-md-4 grid-top">
						<div class="top-grid top">
							<i class="glyphicon glyphicon-time home1 "></i>
							<div class="caption">
								<h3>Resultados en 48 horas</h3>
								<p>Eficaz - Ágil - Moderno</p>
							</div>
						</div>
					</div>
					<div class=" col-md-4 grid-top">
						<div class="top-grid">
							<i class="glyphicon glyphicon-edit "></i>
							<div class="caption">
								<h3>Examenes digitalizado</h3>
								<p>Ayuda al medioambiente.</p>
							</div>
						</div>
					</div>
					<div class="clearfix"> </div>
				</div>
			</div>
			<!--//content-top-->
			
			<!--content-left-->
			<div class="content-left">
				@foreach($noticias as $noticia)
				<div class="col-md-4 content-left-top">
					<a href="/noticia/{{$noticia->id_noticia}}"><img class="img-responsive" src="{{ asset('back/img/noticias/'.$noticia->ruta)}}"
							alt=""></a>
					<div class=" content-left-bottom">
						<h4><i class="glyphicon glyphicon-ok"></i><a href="/noticia/{{$noticia->id_noticia}}">{{$noticia->titulo}}</a>
						</h4>
						<a href="/noticia/{{$noticia->id_noticia}}" class="hvr-icon-wobble-horizontal">Leer noticia</a>
					</div>
				</div>
				@endforeach
				<div class="clearfix"> </div>
			</div>
			<!--//content-left-->
		</div>


		@include('presentacion.footer')
<!DOCTYPE html>

<head>
    <title>Instituto de Salud Pública | Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript">
        addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } 
    </script>
    <!-- bootstrap-css -->
    <link rel="stylesheet" href="{{ asset ('back/css/bootstrap.min.css') }}">
    <!-- //bootstrap-css -->
    <!-- Custom CSS -->
    <link href="{{ asset ('back/css/style.css') }}" rel='stylesheet' type='text/css' />
    <link href="{{ asset ('back/css/style-responsive.css') }}" rel="stylesheet" />
    <!-- font CSS -->
    <link
        href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic'
        rel='stylesheet' type='text/css'>
    <!-- font-awesome icons -->
    <link rel="stylesheet" href="{{ asset ('back/css/font.css') }}" type="text/css" />
    <link href="{{ asset ('back/css/font-awesome.css') }}" rel="stylesheet">
    <!-- //font-awesome icons -->
    <script src="{{ asset ('back/js/jquery2.0.3.min.js') }}"></script>
    @notify_css
</head>

<body>
    <div class="log-w3">
        <div class="w3layouts-main">
            <h2>Iniciar Sesión</h2>
            <form action="login" method="post">
                @csrf
                <input type="email" class="ggg" name="correo" placeholder="E-MAIL" required="">
                <input type="password" class="ggg" name="contrasena" placeholder="PASSWORD" required="">
                <h6><a href="#" data-toggle="modal" data-target="#recuperarClave">¿Olvidaste tu contraseña?</a></h6>
                <div class="clearfix"></div>
                <input type="submit" value="Ingresar" name="login">
            </form>
            @include('alerts.error')
            
        </div>
    </div>
  <!-- Modal -->
  <div class="modal fade" id="recuperarClave" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        {!! Form::open(['url' => 'recuperarClave', 'method' => 'POST']) !!}
        @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Recuperar Contraseña</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <input type="hidden" name="tipo" value="empleado"/>
          <div class="form-group">
              <label>Correo Electronico</label>
              <input type="email" name="correo" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Recuperar</button>
        </div>
        
      </div>
      {!! Form::close() !!}
    </div>
  </div>


    <script src="{{ asset ('back/js/bootstrap.js') }}"></script>
    <script src="{{ asset ('back/js/jquery.dcjqaccordion.2.7.js') }}"></script>
    <script src="{{ asset ('back/js/scripts.js') }}"></script>
    <script src="{{ asset ('back/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset ('back/js/jquery.nicescroll.js') }}"></script>
    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
    <script src="{{ asset ('back/js/jquery.scrollTo.js') }}"></script>
    @notify_js
    @notify_render
</body>

</html>
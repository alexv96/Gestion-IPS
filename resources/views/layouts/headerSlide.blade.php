<!--header start-->
<header class="header fixed-top clearfix">
    <!--logo start-->
    <div class="brand">
      <a href="index.html" class="logo">
        <h3>I<small>nstituto de</small> S<small>alud</small> P<small>ública</small></h3>
      </a>
      <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
      </div>
    </div>
    <!--logo end-->
    
    <div class="top-nav clearfix">
      <!--search & user info start-->
      <ul class="nav pull-right top-menu">
        <!-- user login dropdown start-->
        <li class="dropdown">
          <a data-toggle="dropdown" class="dropdown-toggle" href="#">
            <span class="username">  {{ session('nombre') }} {{ session('apPaterno') }}</span>
            <b class="caret"></b>
          </a>
          <ul class="dropdown-menu extended logout">
            <li><a href="{{ url('/perfil/'.session('idEmpleado').'/edit') }}"><i class=" fa fa-suitcase"></i>Perfil</a></li>
            <li><a href="{{ url('/logout') }}"><i class="fa fa-key"></i> Cerrar Sesion</a></li>
          </ul>
        </li>
        <!-- user login dropdown end -->

      </ul>
      <!--search & user info end-->
    </div>
  </header>
  <!--header end-->
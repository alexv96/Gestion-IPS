<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a class="active" href="{{url('dashboard')}}">
                        <i class="fa fa-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                @if(Session('tipoUsuario') == 1)
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fas fa-chart-bar"></i>
                        <span>Administración de Personal</span>
                    </a>
                    <ul class="sub">
                        <li>
                            <a href="{{ url('empleados') }}">
                                <i class="fas fa-users"></i> Empleados</a>
                        </li>
                        <li>
                            <a href="{{ url('roles')}}">
                                <i class="fas fa-user-tag"></i> Roles</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ url('noticias') }}">
                        <i class="far fa-newspaper"></i>
                        <span>Administrar Noticias</span>
                    </a>
                </li>
                @endif

                @if (Session('tipoUsuario') == 2)
                    <li>
                        <a href="{{ url('recepcion/create') }}">
                            <i class="far fa-check-square"></i>Recepcion de Muestras</a>
                    </li>
                @endif

            </ul>
        </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
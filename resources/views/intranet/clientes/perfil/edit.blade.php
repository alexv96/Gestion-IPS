@extends('layouts.appUsuario')

@section('content')
<div class="form-w3layouts">
    <!-- Navegacion -->
    <div class=" agileinfo">
        <ol class="breadcrumb">
            <li><a href="{{ url('/intranet/clientes') }}">Dashboard</a></li>
            <li class="active">Modificar Perfil</li>
        </ol>
    </div>
    <!-- Fin Navegacion -->

    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                Modificar <strong>Perfil</strong>
                </header>
                <div class="panel-body">
                    @if(session('tipoUsuario') == '1B')
                    {!! Form::model($particular, ['route' => ['particular.update', Crypt::encrypt($particular->id_particular)], 'method'=> 'put' ]) !!}
                    <!-- MENSAJE DE ERROR-->
                    @include('alerts.error')
                    <!-- FIN MENSAJES DE ERRO -->
                    @include('intranet.clientes.perfil.form')
                    {!! Form::close() !!}
                    @endif
                </div>
                 
            </section>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script src="{{ asset('back/js/validarContrasena.js') }}"></script>
    <script>
        var contadorTelefono = 0;
        var contadorDireccion = 0;
        
        function agregarTelefonos(){
            if (contadorTelefono < 1) {
                contadorTelefono+=1;
                var elemento = document.getElementById('clonarTelefono');
                var clon = elemento.cloneNode(true);
                var añadir = document.getElementById('telefono');
                añadir.appendChild(clon);
            }
        }

        function agregarDireccion(){
            if (contadorDireccion < 1) {
                contadorDireccion+=1;
                var elementoD = document.getElementById('clonarDireccion');
                var clonD = elementoD.cloneNode(true);

                var añadirD = document.getElementById('direccionClon');
                añadirD.appendChild(clonD);
            }
        }
    </script>
@endsection
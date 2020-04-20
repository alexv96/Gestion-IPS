@extends('layouts.app')

@section('css')

@endsection

@section('content')
<div class="form-w3layouts">
    <!-- Navegacion -->
    <div class=" agileinfo">
        <ol class="breadcrumb">
            <li><a href="{{ url('dashboard') }}">Dashboard</a></li>
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
                    {!! Form::model($empleado, ['route' => ['perfil.update', Crypt::encrypt($empleado->id_empleado)], 'method'=> 'put' ]) !!}
                    <!-- MENSAJE DE ERROR-->
                    @include('alerts.error')
                    <!-- FIN MENSAJES DE ERRO -->
                    @include('empleados.perfil.form')
                </div>
                {!! Form::close() !!}
            </section>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script src="{{ asset('back/js/validarContrasena.js') }}"></script>
@endsection
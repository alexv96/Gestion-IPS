@extends('layouts.app')

@section('css')

@endsection

@section('content')
<div class="form-w3layouts">
    <!-- Navegacion -->
    <div class=" agileinfo">
        <ol class="breadcrumb">
            <li><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li><a href="{{ url('empleados') }}">Administración de Empleados</a></li>
            <li class="active">Nuevo Empleado</li>
        </ol>
    </div>
    <!-- Fin Navegacion -->

    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Registrar nuevo <strong>Empleado</strong>
                </header>

                {!! Form::open(['url' => 'empleados', 'method'=>'POST']) !!}
                <div class="panel-body">
                    <!-- MENSAJE DE ERROR-->
                    @include('alerts.error')
                    <!-- FIN MENSAJES DE ERRO -->

                    @include('empleados.form')
                </div>
                
                <div class="position-center">
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-dot-circle-o"></i> Guardar
                        </button>
                        <button type="reset" class="btn btn-danger">
                            <i class="fa fa-ban"></i> Limpiar
                        </button>
                    </div>
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
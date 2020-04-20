@extends('layouts.appUsuario')

@section('content')
<div class="form-w3layouts">
    <!-- Navegacion -->
    <div class=" agileinfo">
        <ol class="breadcrumb">
            <li><a href="{{ url('/intranet/clientes') }}">Inicio</a></li>
            <li class="active">Registrar Muestra</li>
        </ol>
    </div>
    <!-- Fin Navegacion -->

    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Registrar <strong>Muestra</strong>
                </header>

                <!-- Boton agregar -->
                <div class="panel-body">
                   {!! Form::open(['url'=>'muestras', 'method'=>'POST']) !!}
                    @include('alerts.error')

                    @include('intranet.clientes.form')
                    {!! Form::close() !!}
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
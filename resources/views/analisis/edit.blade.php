@extends('layouts.app')

@section('css')
@endsection

@section('content')
<div class="form-w3layouts">
    <!-- Navegacion -->
    <div class=" agileinfo">
        <ol class="breadcrumb">
            <li><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="active">Resultado de Analisis</li>
        </ol>
    </div>
    <!-- Fin Navegacion -->

    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Resultado de <strong>Analisis</strong>
                </header>

                {!! Form::model($muestraCliente, ['route' => ['analisis.update', Crypt::encrypt($muestraCliente->muestra_id)], 'method'=> 'put' ]) !!}
                <!-- Contenido -->
                <div class="panel-body">
                    @method('PUT')
                    @include('analisis.form')

                {!! Form::close() !!}
                </div>
                <!-- Fin contenido -->

            </section>
        </div>
    </div>
</div>
@endsection

@section('js')
@endsection
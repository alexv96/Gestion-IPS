@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('back/css/select2.min.css') }}">
@endsection

@section('content')
<div class="form-w3layouts">
    <!-- Navegacion -->
    <div class=" agileinfo">
        <ol class="breadcrumb">
            <li><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="active">Visualizar muestra</li>
        </ol>
    </div>
    <!-- Fin Navegacion -->

    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Visualizar muestras cliente:<strong> {{$muestra->id_analisisMuestra}}</strong>
                </header>

                    <div class="panel-body">

                    {!! Form::model($muestra,['route' => ['recepcion.show', Crypt::encrypt($muestra->id_analisisMuestra)], 'method'=> 'get' ]) !!}
                        @include('recepcion.form')
                    {!! Form::close() !!}
                    </div>
                
                    <div class="position-center">
                        <div class="text-center">
                            <a href="{{ url('dashboard') }}" class="btn btn-primary">
                                <i class="fas fa-arrow-left"></i> Regresar
                            </a>
                        </div>
                    </div>
            </section>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('back/js/select2.min.js') }}"></script>
<script>
    $(document).ready(function(){
    $.fn.select2.defaults.set('language', 'es');
    $ ( ".js-example-basic-multiple-limit" ). select2 ({ 
      minimumSelectionLength : 1,
      placeholder: "Seleccione un analisis"
    }); 
});
</script>
@endsection
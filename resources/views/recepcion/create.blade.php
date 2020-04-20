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
            <li class="active">Recepción de Muestras</li>
        </ol>
    </div>
    <!-- Fin Navegacion -->

    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Recepción de <strong>Muestras</strong>
                </header>

                <!-- Contenido -->
                <div class="panel-body">
                    {!! Form::open(['url'=>'recepcion', 'method'=>'POST']) !!}
                    @include('recepcion.form')
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

                </div>
                <!-- Fin contenido -->

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
  
    $('#buscarCliente').click(function(){
        var codigoCliente = document.getElementById('codigoCliente');

        $.get('/buscar/'+codigoCliente.value, function(data){

            for (var i = 0; i < data.length; i++) {
                //Validar que no sea nulo y asignar si es empresa o particular                 
                var isEmpresaRun = (data[i].rut_empresa == null)? data[i].rut_particular : data[i].rut_empresa;
                var isEmptyMaterno = (data[i].apellido_materno == null)?'':data[i].apellido_materno;
                var isEmpresaName = (data[i].nombre_empresa == null)? data[i].nombre_particular +' '+data[i].apellido_paterno + ' ' + isEmptyMaterno : data[i].nombre_empresa;
                $('#run').val(isEmpresaRun);
                $('#nombre').val(isEmpresaName);
            }
        });
    });
});

  
</script>
@endsection
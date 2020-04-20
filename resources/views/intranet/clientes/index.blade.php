@extends('layouts.appUsuario')

@section('css')
    <link rel="stylesheet" href="{{ asset('easyAutocomplete-1.3.5/easy-autocomplete.min.css')}}">
@endsection
@section('content')
<div class="form-w3layouts">
    <!-- Navegacion -->
    <div class=" agileinfo">
        <ol class="breadcrumb">
            <li class="active"><a href="{{ url('/intranet/clientes') }}">Inicio</a></li>
        </ol>
    </div>
    <!-- Fin Navegacion -->

    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Buscar <strong>Muestras</strong>
                </header>

                <!-- Boton agregar -->
                <div class="panel-body">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-8">
                        <div class="form-group row">
                            <label for="buscar" class="col-sm-3 col-form-label">Código Muestra</label>
                            <div class="col-sm-6">
                              <input type="text" class="form-control" id="buscar-muestra" name="buscador"/>
                            </div>
                            <div class="col-sm-2">
                                <button type="submit" class="btn btn-outline-info" id="buscar">Buscar</button>
                            </div>
                        </div>

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Código de la Muestra</th>
                                    <th>Estado</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody id="datos">
                                @foreach($buscadorMuestra as $muestra)
                                    <tr>
                                        <td>{{$muestra->muestra_id}}</td>
                                        <td>{{$muestra->tipo_estado}}</td>
                                        <td><a href="/muestras/{{$muestra->muestra_id}} " data-toggle="tooltip" data-placement="top" title="Ver resultados">
                                            <i class="fas fa-eye"></i> Visualizar Resultados
                                        </a></td>
                                    </tr>
                                @endforeach                            
                            </tbody>
                        </table>
                        <div class="text-center">
                            {!! $buscadorMuestra->links() !!}
                        </div>
                    </div>
                    <div class="col-sm-2"></div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('easyAutocomplete-1.3.5/jquery.easy-autocomplete.min.js')}}"></script>
<script>
    $("#buscar-muestra").easyAutocomplete({
        url: function(buscarMuestra) {
        return "{{route('muestras.search')}}?search=" + buscarMuestra;
    },
 
    getValue: "id_analisisMuestra"
});
</script>
<script>
$('#buscar').on('click',function(e){
    console.log('Funciona boton');

    var id = $('#buscar-muestra').val();
    console.log(id);

    $.get('/resultadosCliente/'+ id, function(data){
        
        $('#datos').empty();
        
        $.each(data, function(index, muestra){
            console.log(muestra.muestra_id);
            $('#datos').append('<tr><td>'+ muestra.muestra_id +'</td><td>'+ muestra.tipo_estado +'</td><td><a href="/muestras/'+muestra.muestra_id+'" data-toggle="tooltip" data-placement="top" title="Ver resultados"><i class="fas fa-eye"></i> Visualizar Resultados</a></td></tr>');
        });
    });
});
</script>
@endsection
@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('DataTables-1.10.20/css/jquery.dataTables.min.css') }}">
@endsection

@section('content')
<div class="row">

<!-- USUARIO ADMINISTRADOR -->
@if(Session('tipoUsuario') == 1)
        <div class="col-md-4 market-update-gd">
          <div class="market-update-block clr-block-2">
            <div class="col-md-4 market-update-right">
              <i class="fa fa-eye"> </i>
            </div>
            <div class="col-md-8 market-update-left contadorTotal">
              <h4>Empleados</h4>
              <h3 class="contadorTotalEmp"></h3>
              <p></p>
            </div>
            <div class="clearfix"> </div>
          </div>
        </div>
        <div class="col-md-4 market-update-gd">
          <div class="market-update-block clr-block-1">
            <div class="col-md-4 market-update-right">
              <i class="fa fa-users"></i>
            </div>
            <div class="col-md-8 market-update-left">
              <h4>Clientes Registrados</h4>
              <h3 class="contadorTotalCli"></h3>
              <p></p>
            </div>
            <div class="clearfix"> </div>
          </div>
        </div>
        <div class="col-md-4 market-update-gd">
          <div class="market-update-block clr-block-3">
            <div class="col-md-4 market-update-right">
              <i class="fa fa-chart-bar"></i>
            </div>
            <div class="col-md-8 market-update-left contadorTotal">
              <h4>Muestras realizadas</h4>
              <h3 class="contadorTotalMue"></h3>
              <p>Incluye las ingresadas y procesadas</p>
            </div>
            <div class="clearfix"> </div>
          </div>
        </div>
@endif
<!-- FIN USUARIO ADMINISTRADOR -->
    <!-- USUARIO RECEPTOR -->
    @if(Session('tipoUsuario') == 2)    
    <div class="panel-body">
      <div class="col-md-12 ">
        <!--agileinfo-grap-->
        <div class="agileinfo-grap">
          <div class="agileits-box">
            <header class="agileits-box-header clearfix">
              <h3>Muestras Recibidas</h3>
            </header>
            
            <table id="tabla-dtbl" class="table table-striped">
                <thead>
                    <tr>
                        <th>Código Usuario</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($muestrasRecibidas as $recibido)
                        <tr>
                            <td>
                                @if($recibido->empresa_codigoEmpresa != null) 
                                    {{ $recibido->empresa_codigoEmpresa }}
                                @endif
                                @if ($recibido->cliente_codigoCliente != null)
                                    {{$recibido->cliente_codigoCliente}}
                                @endif
                            </td>
                            <td>
                                @if ($recibido->fechaRecepcion != null)
                                    Muestra ingresada
                                @else
                                    <a href="recepcion/{{Crypt::encrypt($recibido->id_analisisMuestra)}}/edit">Ingresar Muestra</a>
                                @endif
                            </td>
                            <td>
                                <a href="recepcion/{{Crypt::encrypt($recibido->id_analisisMuestra)}}" class="btn btn-info"> Visualizar </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
          </div>
        </div>
        <!--//agileinfo-grap-->
      </div>
    </div>
    @endif
    <!-- FIN USUARIO RECEPTOR -->

    <!-- USUARIO TECNICO -->
    @if(Session('tipoUsuario') == 3)    
    <div class="panel-body">
      <div class="col-md-12 ">
        <!--agileinfo-grap-->
        <div class="agileinfo-grap">
          <div class="agileits-box">
            <header class="agileits-box-header clearfix">
                <h3>Muestras por <strong>Analizar</strong></h3>
            </header>
            
            <table id="tabla-dtbl" class="table table-hover mt-3">
                <thead>
                    <tr>
                        <th>Código Cliente</th>
                        <th>Código Muestra</th>
                        <th>Estado</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($analisisRecibidos as $analisis)
                        <tr>
                            <td>
                                @if (isset($analisis->cliente_codigoCliente))
                                    {{$analisis->cliente_codigoCliente}}
                                @else
                                    {{$analisis->empresa_codigoEmpresa}}
                                @endif
                            </td>
                            <td>{{$analisis->muestra_id}}</td>
                            <td>
                                <a href="analisis/{{ Crypt::encrypt($analisis->muestra_id) }}/edit">{{$analisis->tipo_estado}}</a>
                            </td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>

          </div>
        </div>
        <!--//agileinfo-grap-->
      </div>
    </div>
    @endif
    <!-- FIN USUARIO TECNICO -->


</div>
@endsection

@section('js')
<script src="{{ asset('DataTables-1.10.20/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('back/js/main.js') }}"></script>
<script src="{{ asset('back/js/jquery.animateNumber.min.js') }}"></script>

<script>
$('.contadorTotalEmp').animateNumber({number: {{$totalEmpleados}} }, 1000);
$('.contadorTotalCli').animateNumber({number: {{$clientes}} }, 1000);
$('.contadorTotalMue').animateNumber({number: {{$totalMuestras}} }, 1000);
</script>
@endsection
@extends('layouts.appUsuario')

@section('css')
<!--<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Productos', 'mes'],
            @foreach ($resultadosAnalisis as $pastels)
              ['{{ $pastels->nombre_analisis}}', {{ $pastels->PPM}}],
            @endforeach
        ]);
        var options = {
          title: 'Reportes Mensual'
        };
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
          ['Analisis', 'Resultados'],
          @foreach ($resultadosAnalisis as $pastels)
              ['{{ $pastels->nombre_analisis}}', {{ $pastels->PPM}}],
            @endforeach
        ]);

        var options = {
          width: 800,
          height: 300,
          legend: { position: 'none' },

          bar: { groupWidth: "30%" }
        };

        var chart = new google.charts.Bar(document.getElementById('chart_div'));
        // Convert the Classic options to Material options.
        chart.draw(data, google.charts.Bar.convertOptions(options));
      };
    </script>
@endsection

@section('content')
<div class="form-w3layouts">
    <!-- Navegacion -->
    <div class=" agileinfo">
        <ol class="breadcrumb">
            <li><a href="{{ url('/intranet/clientes') }}">Inicio</a></li>
            <li class="active">Reporte de Muestra</li>
        </ol>
    </div>
    <!-- Fin Navegacion -->

    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Reporte de <strong>Muestra {{$mostrarID->id_analisisMuestra}}</strong>
                </header>

                <!-- Boton agregar -->
                <div class="panel-body">
                  <div class="row">
                  <div class="col-sm-2"></div>
                  <div class="col-sm-10">
                    <div id="chart_div" class="text-center"></div>
                  </div>
                </div> 

                    <table class="table table-hover mt-lg-n2">
                        <thead>
                            <tr>
                                <th>Tipo Analisis</th>
                                <th>Resultados</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($resultadosAnalisis as $resultado)
                                <tr>
                                    <td>{{$resultado->nombre_analisis}}</td>
                                    <td>{{$resultado->PPM}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
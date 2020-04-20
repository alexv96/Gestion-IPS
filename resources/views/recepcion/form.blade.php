@csrf
<div class="col-sm-6">
    <fieldset class="scheduler-border">
        <legend class="scheduler-border">Datos del Cliente</legend>
        <div class="form-group">
            <label for="codigo">Código Cliente</label>
            <div class="input-group">
                @if (isset($muestra->empresa_codigoEmpresa))
                {!! Form::text('empresa_codigoEmpresa', null, ['class' => 'form-control','readonly']) !!}                
                @endif
                
                @if (isset($muestra->cliente_codigoCliente))
                    {!! Form::text('cliente_codigoCliente', null, ['class' => 'form-control','readonly']) !!}
                @endif
                
                @if(!isset($muestra->cliente_codigoCliente) && !isset($muestra->empresa_codigoEmpresa))
                    {!! Form::number('codigoCliente', null, ['class'=> 'form-control','id'=>'codigoCliente','onkeypress'=>'return validarNumeros(event)']) !!}
                @endif

                <span class="input-group-addon">
                    <button id="buscarCliente" type="button" class='btnSearchClient'><i class="glyphicon glyphicon-search"  id="buscarCliente"></i></button>
                </span>
            </div>
        </div>
        <div class="form-group">
            <label for="rut">Rut Cliente</label>
            @if (isset($muestra->rut_empresa))
                {!! Form::text('rut_empresa', null, ['class' => 'form-control','readonly']) !!}                
            @endif
            @if (isset($muestra->rut_particular))
                {!! Form::text('rut_particular', null, ['class' => 'form-control','readonly']) !!}
            @endif
            @if(!isset($muestra->rut_particular) && !isset($muestra->rut_empresa))
                {!! Form::text('run', null, ['class' => 'form-control','id'=>'run']) !!}
            @endif
        </div>
        <div class="form-group">
            <label for="nombre">Nombre Cliente</label>
            @if (isset($muestra->nombre_empresa))
                {!! Form::text('nombre_empresa', null, ['class' => 'form-control','readonly']) !!}                
            @endif
            @if (isset($muestra->nombre_particular))
                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $muestra->nombre_particular }} {{$muestra->apellido_paterno}} {{$muestra->apellido_materno}}" readonly>
            @endif
            @if(!isset($muestra->nombre_particular) && !isset($muestra->nombre_empresa))
                {!! Form::text('nombre', null, ['class' => 'form-control','id'=>'nombre']) !!}
            @endif

        </div>
    </fieldset>
</div>
<div class="col-sm-6">
    <fieldset class="scheduler-border">
        <legend class="scheduler-border">Recepción de la Muestra</legend>
        <div class="form-group">
            <label for="fecha">Fecha de Recepción</label>
            <input type="text" name="fecha_recepcion" id="fecha_recepcion" class="form-control" min='{{ date('Y-m-d') }}' value='{{ date('d-m-Y') }}' readonly>
        </div>
        <div class="form-group">
            <label for="temperatura">Temperatura de Muestra</label>
            @if(!isset($muestra->temperatura_muestra))
                {!! Form::number("temperatura_muestra", null, ['class'=>'form-control','onkeypress'=>'return validarNumeros(event)']) !!}
            @else
                {!! Form::number("temperatura_muestra", null, ['class'=>'form-control','readonly']) !!}
            @endif
        </div>
        <div class="form-group">
            <label for="cantidad">Cantidad de Muestra</label>
            @if(!isset($muestra->cantidad_muestra))
                {!! Form::number("cantidad_muestra", null, ['class'=>'form-control','onkeypress'=>'return validarNumeros(event)']) !!}
            @else
                {!! Form::number("cantidad_muestra", null, ['class'=>'form-control','readonly']) !!}
            @endif
        </div>
    </fieldset>
</div>
<div class="col-sm-12">
    <fieldset class="scheduler-border">
        <legend class="scheduler-border">Análisis a realizar</legend>
        <small>Seleccione el o los analisis a realizar a la muestra.</small>
        <select class="js-example-basic-multiple-limit form-control" multiple="multiple" name="analisis[]">
            @if (isset($analisisHacer))
                @if ($analisisHacer->isEmpty())
                    @foreach ($tipoAnalisis as $analisis)
                        <option value="{{$analisis->id_tipoAnalisis}}">{{ $analisis->nombre_analisis }}</option>
                    @endforeach
                @else
                    @foreach ($tipoAnalisis as $analisis)
                        @php($encontrado = false)
                        @foreach ($analisisHacer as $porHacer)
                            @if ($analisis->id_tipoAnalisis == $porHacer->tipoAnalisis_id)
                                @php($encontrado = true)
                                <option value="{{ $analisis->id_tipoAnalisis }}" selected>{{ $analisis->nombre_analisis }}</option>
                                @break
                            @endif
                        @endforeach
                        @if($encontrado == false)
                            <option value="{{$analisis->id_tipoAnalisis}}">{{ $analisis->nombre_analisis }}</option>
                        @endif
                    @endforeach
                @endif
            @else
            @foreach ($tipoAnalisis as $analisis)
                        <option value="{{$analisis->id_tipoAnalisis}}">{{ $analisis->nombre_analisis }}</option>
                    @endforeach
            @endif          
        </select>
    </fieldset>
</div>
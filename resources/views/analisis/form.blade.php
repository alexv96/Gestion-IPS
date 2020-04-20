@csrf
<div class="col-sm-6">
    <fieldset class="scheduler-border">
        <legend class="scheduler-border">Código Cliente</legend>
        @if(isset($muestraCliente->cliente_codigoCliente))
            {!! Form::text('codigo',$muestraCliente->cliente_codigoCliente, ['class' => 'form-control text-center','readonly']) !!}
        @else
            {!! Form::text('codigo',$muestraCliente->empresa_codigoEmpresa, ['class' => 'form-control text-center','readonly']) !!}
        @endif    
    </fieldset>
</div>
<div class="col-sm-6">
<fieldset class="scheduler-border">
        <legend class="scheduler-border">Código de la Muestra</legend>
            {!! Form::text('muestra_id', $muestraCliente->muestra_id, ['class' => 'form-control text-center','readonly']) !!}
    </fieldset></div>
<div class="col-sm-12">
    <fieldset class="scheduler-border">
        <legend class="scheduler-border">Resultado Analisis</legend>
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th>Tipo de Analisis</th>
                        <th>PPM de la muestra</th>
                        <th>Estado examen</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($resultadoAnalisis as $analisis)
                        <tr>
                            <td>{{$analisis->nombre_analisis}}</td>
                            <td>
                                <div class="col-sm-4">
                                    @if(isset($analisis->PPM) )
                                        <input type="text" id="ppm" name="ppm[]" class="form-control text-center" value="{{$analisis->PPM}}" onkeypress="return validarNumeros(event)"/>
                                    @else
                                        <input type="text" id="ppm" name="ppm[]" class="form-control text-center"  onkeypress="return validarNumeros(event)"/>
                                    @endif
                                </div>
                            </td>
                            <td>
                                @foreach ($estados as $estado)
                                    @if($analisis->estado_id != 3)
                                        <div class="form-check form-check-inline">
                                            <input type="checkbox" class="form-check-input" id="estadoExamen" name="estadoExamen[]" value="{{$estado->id_estadoResultado}}">
                                            <label class="form-check-label" for="estadoExamen">{{$estado->tipo_estado}}</label>
                                        </div>
                                    @else
                                        <div class="form-check form-check-inline">
                                            <input type="checkbox" class="form-check-input" id="estadoExamen" name="estadoExamen[]" value="{{$estado->id_estadoResultado}}" checked>
                                            <label class="form-check-label" for="estadoExamen">{{$estado->tipo_estado}}</label>
                                        </div>
                                    @endif 
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </fieldset>
</div>
<div class="position-center">
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-dot-circle-o"></i> Registrar
                            </button>
                            <button type="reset" class="btn btn-danger">
                                <i class="fa fa-ban"></i> Limpiar
                            </button>
                        </div>
                    </div>
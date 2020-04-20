@csrf
<div class="col-sm-2"></div>
<div class="col-sm-8">
    <fieldset class="scheduler-border">
        <legend class="scheduler-border">Modificar Perfil</legend>
        <div class="form-group">
            <label for="rut">Rut</label>
            {!! Form::text('rut_particular', null, ['class'=>'form-control','readonly']) !!}
        </div>
        <div class="form-group">
            <label for="nombre_particular">Nombre</label>
            {!! Form::text('nombre_particular', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            <label for="apellido_paterno">Apellido Paterno</label>
            {!! Form::text('apellido_paterno', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            <label for="apellido_materno">Apellido Materno</label>
            {!! Form::text('apellido_materno', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            <label for="email">Correo</label>
            {!! Form::email('email', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            <label for="contrasena">Contraseña</label>
            <div class="input-group">
                    <input name="contrasena" id="contrasena" class="form-control" type="password" value="{{$particular->contraseña}}"/>
                <div class="input-group-addon">
                    <i class="fa fa-eye" id="mostrar"></i>
                </div>
            </div>
        </div>
    </fieldset>
    <fieldset class="scheduler-border">
        <legend class="scheduler-border">Contacto</legend>
        <div id="clonarTelefono">
            <div class="col col-md-5" >
                <label for="telefono">Telefono</label>
                @if(!isset($telefono->numero_telefono))
                    {!! Form::number('telefono[]', $telefono->numero_telefono, ['class'=>'form-control','onkeypress'=>'return validarNumeros(event)','id'=>'idTelefono']) !!}  
                @else
                    {!! Form::number('telefono[]', null, ['class'=>'form-control','onkeypress'=>'return validarNumeros(event)','id'=>'idTelefono']) !!}  
                
                @endif
            </div>
        </div>
        <div class="col col-md-2">
            <label></label>
            <button type="button" class="btn btn-outline-info form-control" onclick="agregarTelefonos()"><i class="fas fa-plus-circle"></i></button>
        </div>
        <div class="col-md-12" id="telefono" style="margin-left: -13px;">
        </div>
    </fieldset>
    <fieldset class="scheduler-border">
        <legend class="scheduler-border">Dirección</legend>
        <div id="clonarDireccion">
            <div class="col col-md-5">
                <label for="direccion">Calle</label>
                {!! Form::text('direccion[]', null, ['class'=>'form-control']) !!}
            </div>
            <div class="col col-md-2">
                <label for="numero">Número</label>
                {!! Form::text('numero[]', null, ['class'=>'form-control','onkeypress'=>'return validarNumeros(event)']) !!}
            </div>
            <div class="col col-md-3">
                <label for="depto">Depto</label>
                {!! Form::text('departamento[]', null, ['class'=>'form-control']) !!}
            </div>
        </div>
        <div class="col col-md-2">
            <label></label>
            <button type="button" class="btn btn-outline-info form-control" onclick="agregarDireccion()"><i class="fas fa-plus-circle"></i></button>
        </div>
        <div class="col-md-12" id="direccionClon"></div>
    </fieldset>

    <div class="position-center">
        <div class="text-center">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-dot-circle-o"></i> Guardar
            </button>
            <a href="{{ url('/intranet/cientes')}}" class="btn btn-danger">
                <i class="fa fa-ban"></i> Cancelar
            </a>
        </div>
    </div>
</div>
<div class="col-sm-2"></div>

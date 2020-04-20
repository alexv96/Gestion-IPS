@csrf
<div class="col-sm-4"></div>
<div class="col-sm-4">
    <div class="form-group">
        <label for="rut">Rut</label>
        {!! Form::text('rut_empleado', null, ['class'=>'form-control','readonly']) !!}
    </div>
    <div class="form-group">
        <label for="nombre">Nombre</label>
        {!! Form::text('nombre', null, ['class'=>'form-control','id'=>'nombre']) !!}
    </div>
    <div class="form-group">
        <label for="apellido_paterno">Apellido Paterno</label>
        {!! Form::text('apellido_paterno', null, ['class'=>'form-control','id'=>'apellido_paterno']) !!}
    </div>
    <div class="form-group">
        <label for="apMaterno">Apellido Materno</label>
        {!! Form::text('apellido_materno', null, ['class'=>'form-control','id'=>'apMaterno']) !!}
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        {!! Form::email('email', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        <label for="contrasena">Contraseña</label>
        <div class="input-group">
                <input name="contrasena" id="contrasena" class="form-control" type="password" value="{{$empleado->contrasena}}"/>
            <div class="input-group-addon">
                <i class="fa fa-eye" id="mostrar"></i>
            </div>
        </div>
    </div>

    <div class="position-center">
        <div class="text-center">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-dot-circle-o"></i> Guardar
            </button>

            <a href="{{ url('dashboard')}}" class="btn btn-danger"><i class="fa fa-ban"></i> Cancelar</a>
        </div>
    </div>
</div>
<div class="col-sm-4"></div>
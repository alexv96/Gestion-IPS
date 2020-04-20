@csrf
<div class="row form-group">
    <div class="col col-md-3">
        {!! Form::label('rut', 'Rut', ['class' => 'form-control-label']) !!}
        @if(!isset($empleado->rut_empleado))
            <input type="text" name="rut_empleado" id="rut_empleado" class="form-control">
        @else
            <input type="text" name="rut_empleado" id="rut_empleado" class="form-control" value="{{ $empleado->rut_empleado }}" readonly>
        @endif
    </div>
    <div class="col col-md-3">
        {!! Form::label('nombre', 'Nombres', ['class' => 'form-control-label']) !!}
        {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
        <small class="err"></small>
    </div>
    <div class="col col-md-3">
        {!! Form::label('apellido_paterno', 'Apellido Paterno', ['class' => 'form-control-label']) !!}
        {!! Form::text('apellido_paterno', null, ['class' => 'form-control']) !!}
        <small class="err"></small>
    </div>
    <div class="col col-md-3">
        {!! Form::label('apellido_materno', 'Apellido Materno', ['class' => 'form-control-label']) !!}
        {!! Form::text('apellido_materno', null, ['class' => 'form-control']) !!}
        <small class="err"></small>
    </div>
    <div class="col col-md-4">
        {!! Form::label('email', 'Correo', ['class' => 'form-control-label']) !!}
        {!! Form::email('email', null, ['class' => 'form-control']) !!}
        <small class="err"></small>
    </div>
    <div class="col col-md-4">
        {!! Form::label('contrasena', 'Contraseña', ['class' => 'form-control-label']) !!}
        <div class="input-group">
            @if(!isset($empleado->contrasena))
                {!! Form::password('contrasena', ['class' => 'form-control']) !!}
            @else
                <input name="contrasena" id="contrasena" class="form-control" type="password" value="{{ $empleado->contrasena}}"/>
            @endif
                       
            <div class="input-group-addon">
                <i class="fa fa-eye" id="mostrar"></i>
            </div>
        </div>
        <small class="err"></small>
    </div>
    <div class="col col-md-4">
        {!! Form::label('rol', 'Rol', ['class' => 'form-control-label']) !!}
        @if (!isset($empleado->rol_id))
            <select name="rol" id="rol" class="form-control">
                <option selected disabled>Seleccione rol</option>
                @foreach ($roles as $rol)
                    <option value="{{ $rol->id_rol}}">{{ $rol->descripcion_rol}}</option>
                @endforeach
            </select>
        @else
            <select name="rol" id="rol" class="form-control">
                <option selected disabled>Seleccione rol</option>
                @foreach ($roles as $rol)
                    <option value="{{ $rol->id_rol}}" {{ ($rol->id_rol == $empleado->rol_id) ? 'selected' : '' }}>{{ $rol->descripcion_rol}}</option>
                @endforeach
            </select>
        @endif
        
    </div>
</div>
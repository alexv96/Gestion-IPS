@csrf
<div class="col-sm-6">
    <fieldset class="scheduler-border">
        <legend class="scheduler-border">Datos del Cliente</legend>
        <div class="form-group">
            <label for="codigo">Código Cliente</label>
            <div>
                <input type="text" class="form-control" value="{{session('idUsuario')}}" readonly />
            </div>
        </div>
        <div class="form-group">
            <label for="rut">Rut Cliente</label>
            <input type="text" name="rut" id="rut" class="form-control" value="{{session('rut')}}" readonly>
        </div>
        <div class="form-group">
            <label for="nombre">Nombre Cliente</label>
            @if(session('tipoUsuario') == '1A')
                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ session('nombre') }}">
            @else
                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ session('nombre') }} {{ session('apPaterno') }}" readonly>
            @endif
        </div>
    </fieldset>
</div>
<div class="col-sm-6">
    <fieldset class="scheduler-border">
        <legend class="scheduler-border">Recepción de la Muestra</legend>
        <div class="form-group">
            <label for="temperatura">Temperatura de Muestra</label>
            <input type="tel" name="temperatura" id="temperatura" class="form-control">
        </div>
        <div class="form-group">
            <label for="cantidad">Cantidad de Muestra</label>
            <input type="tel" name="cantidad" id="cantidad" class="form-control">
        </div><div class="position-center">
            <div class="text-center">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-dot-circle-o"></i> Guardar
                </button>
                <button type="reset" class="btn btn-danger">
                    <i class="fa fa-ban"></i> Limpiar
                </button>
            </div>
        </div>
    </fieldset>
</div>

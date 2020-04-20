@include('presentacion.menu')

<div class="container mt-2">
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">

            <div id="alex">
                <h2>Registro de Cliente</h2><br />

                <!-- Seleccionar tipo usuario -->
                <div class="form-horizontal">

                    <label>Seleccione el tipo de cliente a registrar para llenar el formulario.</label>                
                    <table style="width: 80%; margin-top:10px;">
                        <tr>
                            <td class="col-sm-5">
                                <label>Tipo Cliente</label>
                            </td>
                            <td>
                                <div class="form-inline">
                                    <input type="radio" name="tipo" id="empresa" value="empresa" onclick="mostrarRegistro(this)"> Empresa
                                </div>
                            </td>
                            <td>
                                <div class="form-inline">
                                    <input type="radio" name="tipo" id="particular" value="particular" onclick="mostrarRegistro(this)"> Particular
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <!-- Fin tipo usuario -->

                <!-- Mensaje -->
                @if (isset($mensaje))
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <strong>{{ $mensaje }}</strong>
                            </div>
                @endif
                @if (isset($mensajeError))
                            <div class="alert alert-info alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <strong>{{ $mensajeError }}</strong>
                            </div>
                @endif
                <!-- Fin mensaje-->

                <!-- Datos de la Empresa -->
                <fieldset id="empresaForm">
                    <legend>Datos de la Empresa:</legend>

                    {!! Form::open(['url' => 'empresa','method' => 'POST']) !!}
                    @csrf
                    <div class="form-group row">
                        <label for="rut_empresa" class="col-sm-2 col-form-label">Rut:</label>
                        <div class="col-sm-4">
                            <input type="text" name="rut_empresa" id="rut_empresa" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nombre_empresa" class="col-sm-2 col-form-label">Nombre Empresa:</label>
                        <div class="col-sm-6">
                            <input type="text" name="nombre_empresa" id="nombre_empresa" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="direccion_empresa" class="col-sm-2 col-form-label">Direccion:</label>
                        <div class="col-sm-6">
                            <input type="text" name="direccion_empresa" id="direccion_empresa" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="contrasena_empresa" class="col-sm-2 col-form-label">Contraseña:</label>
                        <div class="col-sm-6">
                            <input type="password" name="contrasena_empresa" id="contrasena_empresa" class="form-control">
                        </div>
                    </div>


                    <div class="form-group">
                        <button type="reset" class="btn btn-danger">Limpiar</button>
                        <button type="submit" class="btn btn-primary">Registrar Empresa</button>
                    </div>
                    {!! Form::close() !!}
                </fieldset>
                <!-- Fin Datos de la Empresa -->

                <!-- Datos Particular -->
                <fieldset id="cliente">
                    <legend>Datos del Cliente</legend>
                    {!! Form::open(['url' => 'particular','method' => 'POST']) !!}
                    @csrf
                    <div class="form-group row">
                        <label for="rut_particular" class="col-sm-2 col-form-label">Rut:</label>
                        <div class="col-sm-4">
                            <input type="text" name="rut_particular" id="rut_particular" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nombre_particular" class="col-sm-2 col-form-label">Nombre Cliente:</label>
                        <div class="col-sm-6">
                            <input type="text" name="nombre_particular" id="nombre_particular" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="apellido_paterno" class="col-sm-2 col-form-label">Apellido Paterno:</label>
                        <div class="col-sm-6">
                            <input type="text" name="apellido_paterno" id="apellido_paterno" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="telefono" class="col-sm-2 col-form-label">Telefono:</label>
                        <div class="col-sm-6">
                            <input type="tel" name="telefono" id="telefono" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="correo" class="col-sm-2 col-form-label">Email:</label>
                        <div class="col-sm-6">
                            <input type="email" name="correo" id="correo" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="contrasena_particular" class="col-sm-2 col-form-label">Contraseña:</label>
                        <div class="col-sm-6">
                            <input type="password" name="contrasena_particular" id="contrasena_particular" class="form-control">
                            <small id="mostrar"> Visualizar Contraseña</small>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="reset" class="btn btn-danger">Limpiar</button>
                        <button type="submit" class="btn btn-primary">Registrar Particular</button>
                    </div>
                    {!! Form::close() !!}
                </fieldset>
                <!-- Fin Datos Particular -->
            </div>
        </div>
        <div class="col-sm-3"></div>
    </div>
</div>
<script>
    //document.getElementById("cliente").style.display = "none";
    document.getElementById("empresaForm").style.display = "none";
</script>
@include('presentacion.footer')
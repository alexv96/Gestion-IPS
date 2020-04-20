@include('presentacion.menu')

<!--contact-->
<div class="container">
	<div class="contact">
		<div class="contact-top">
			<h2>Iniciar Sesión</h2>
		</div>
		<div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                {!! Form::open(['url' => 'cliente/login', 'method' => 'POST']) !!}
                @csrf
                    <div class="form-horizontal">
                        <table style="width: 100%; margin-top:10px;">
                            <tr>
                                <td class="col-sm-5">
                                    <label>Tipo Cliente</label>
                                </td>
                                <td>
                                    <div class="form-inline col-auto">
                                        <input type="radio" name="tipo" id="empresa" value="empresa">
                                        <label id="empresa">Empresa</label>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-inline col-auto">
                                        <input type="radio" name="tipo" id="particular" value="particular">
                                        <label id="particular">Particular</label>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="form-group">
                        <label for="rut_particular">Run:</label>
                        <input type="text" name="rut_particular" id="rut_particular" class="form-control" placeholder="12345678-9">
                    </div>
                    <div class="form-group">
                        <label for="contrasena">Contraseña</label>
                        <div class="input-group">
                            <input name="contrasena" id="contrasena" class="form-control" type="password"/>
                            <div class="input-group-addon">
                                <i class="fa fa-eye" id="mostrar"></i>
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
                        <div class="right">
                            <a href={{ url('/recuperarContrasena')}}><small>¿Olvidaste tu contraseña?</small></a>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
            <div class="col-sm-4"></div>
        </div>
	</div>
</div>

@include('presentacion.footer')
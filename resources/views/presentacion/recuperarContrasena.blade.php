@include('presentacion.menu')

<!--contact-->
<div class="container">
	<div class="contact">
		<div class="contact-top">
			<h2>Recuperar Contraseña</h2>
		</div>
		<div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                {!! Form::open(['url' => 'recuperarClave', 'method' => 'POST']) !!}
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
                    </div><br>
                    <div class="form-group">
                        <label for="correo">Correo Electronico:</label>
                        <input type="text" name="correo" id="correo" class="form-control">
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-block">Recuperar</button>
                    </div>
                {!! Form::close() !!}
            </div>
            <div class="col-sm-4"></div>
        </div>
	</div>
</div>

@include('presentacion.footer')
@include('presentacion.menu')

<!--contact-->
<div class="container">
	<div class="contact">
		<div class="contact-top">
			<h2>Contactanos</h2>
		</div>
		<div class="mapa" id="mapa">
			<!--<iframe
				src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d25090.351787808224!2d-122.2569291!3d38.179845!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80850c726b66df5b%3A0xfaee3a3990d21c4c!2sAmerican+Canyon%2C+CA%2C+USA!5e0!3m2!1sen!2sin!4v1413272890200"></iframe>-->
		</div><br>
		@if ($envioExitoso ?? '' == true)
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Envio exitoso</strong> Nos contactaremos a la brevedad
            </div>
        @endif
		<div class="contact-bottom">
			{!! Form::open(['url' => 'contacto', 'method' => 'POST']) !!}
                @csrf
				<input type="text" value="Primer nombre" name="nombre" required placeholder="" onfocus="this.value='';"
					onblur="if (this.value == '') {this.value = 'Nombre';}">
				<input type="text" value="Apellido Paterno" name="apellido" placeholder="" onfocus="this.value='';"
					onblur="if (this.value == '') {this.value = 'Apellido';}">
				<input type="text" id="email"  value="Correo" name="correo" required  placeholder="" onfocus="this.value='';"
					onblur="if (this.value == '') {this.value = 'Email Address';}"> <span id="emailOK"></span>
				<textarea required placeholder="" name="mensaje" onfocus="this.value='';"
					onblur="if (this.value == '') {this.value = 'Message';}">Mensaje</textarea>
				<input type="submit" value="Enviar">
			{!! Form::close() !!}
		</div>
	</div>
</div>

@include('presentacion.footer')
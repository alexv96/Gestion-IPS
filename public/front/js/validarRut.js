(function () {
  //VALIDAR QUE EL CAMPO RUT TENGA 10 CARACTERES
  var rut = document.getElementById('rut_particular');
  if (rut != null) {
    rut.addEventListener('input', function () {
      if (this.value.length > 10) {
        this.value = this.value.slice(0, 10);
      }
    });
  }

  var rutE = document.getElementById('rut_empresa');
  if (rutE != null) {
    rutE.addEventListener('input', function () {
      if (this.value.length > 10) {
        this.value = this.value.slice(0, 10);
      }
    });
  }

  //Validar correo
    document.getElementById('email').addEventListener('input', function() {
      campo = event.target;
      valido = document.getElementById('emailOK');
          
      emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
      //Se muestra un texto a modo de ejemplo, luego va a ser un icono
      if (emailRegex.test(campo.value)) {
        valido.innerText = "válido";
      } else {
        valido.innerText = "incorrecto";
      }
  });

  //MOSTRAR Y OCULTAR CONTRASEÑA
  $('#mostrar').click(function () {
    if ($(this).hasClass('fa-eye')) {
      $('#contrasena').removeAttr('type');
      $('#mostrar').addClass('fa-eye-slash').removeClass('fa-eye');
    }

    else {
      //Establecemos el atributo y valor
      $('#contrasena').attr('type', 'password');
      $('#mostrar').addClass('fa-eye').removeClass('fa-eye-slash');
    }
  });
})()
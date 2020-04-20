(function () {
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

  //VALIDAR QUE EL CAMPO RUT TENGA 10 CARACTERES
  var rut = document.getElementById('rut_empleado');
  rut.addEventListener('input', function () {
    if (this.value.length > 10) {
      this.value = this.value.slice(0, 10);
    }
  });
})()
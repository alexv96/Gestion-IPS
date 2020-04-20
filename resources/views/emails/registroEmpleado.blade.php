<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bienvenido a IPS</title>
</head>
<body>
    <h4>Registro realizado exitosamente</h4>
    <p>Para acceder a la página debe ingresar su <strong>correo</strong> y <strong>contraseña</strong>.</p>
    <table>
        <tr>
            <td>Email</td>
            <td><strong>{{$data->correo}}</strong></td>
        </tr>
        <tr>
            <td>Contraseña</td>
            <td><strong>{{$data->contrasena}}</strong></td>
        </tr>
    </table>
</body>
</html>
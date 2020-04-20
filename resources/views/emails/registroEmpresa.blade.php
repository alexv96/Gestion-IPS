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
    <p>Recuerde mantener siempre a mano a la hora de realizar ingresos de muestras al Instituto de Salud Publica.</p>
    <p>Para acceder a la página debe ingresar su <strong>rut</strong> y <strong>contraseña</strong>.</p>
    <table>
        <tr>
            <td>Código usuario:</td>
            <td><strong>{{$data->codigo_empresa}}</strong></td>
        </tr>
        <tr>
            <td>RUT</td>
            <td><strong>{{$data->rut_empresa}}</strong></td>
        </tr>
        <tr>
            <td>Contraseña</td>
            <td><strong>{{$data->contrasena_empresa}}</strong></td>
        </tr>
    </table>
</body>
</html>
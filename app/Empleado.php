<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table = 'empleados';

    protected $primaryKey = 'id_empleado';

    protected $fillable = [
        'rut_empleado',
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'contrasena',
        'email',
        'rol_id',
        'estado_id',
        'created_at',
        'updated_at'
    ];
}

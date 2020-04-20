<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstadoEmpleado extends Model
{
    protected $table = 'estado_empleado';

    protected $primaryKey = 'id_estado';

    protected $fillable = [
        'descripcion_estado'
    ];
}

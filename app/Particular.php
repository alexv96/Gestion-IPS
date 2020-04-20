<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Particular extends Model
{
    protected $table = 'particular';

    protected $primaryKey = 'id_particular';

    protected $fillable = [
        'rut_particular',
        'nombre_particular',
        'apellido_paterno',
        'apellido_materno',
        'email',
        'contraseña',
        'created_at',
        'updated_at'
    ];
}

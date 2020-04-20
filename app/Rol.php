<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'roles';

    protected $primaryKey = 'id_rol';

    protected $fillable = [
        'descripcion_rol',
        'created_at',
        'updated_at'
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    protected $table = 'contactos';

    protected $primaryKey = 'rut_contacto';

    protected $fillable = [
        'nombre_contacto',
        'email_contacto',
        'telefono_contacto',
        'empresa_id',
        'created_at',
        'updated_at'
    ];
}

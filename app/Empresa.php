<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table = 'empresas';

    protected $primaryKey = 'codigo_empresa';

    protected $fillable = [
        
        'rut_empresa',
        'nombre_empresa',
        'contrasena_empresa',
        'direccion_empresa',
        'created_at',
        'updated_at'
    ];
}

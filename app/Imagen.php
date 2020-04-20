<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    protected $table = 'imagenes';

    protected $primaryKey = 'id_imagen';

    protected $fillable = [
        'ruta',
        'noticia_id',
        'created_at',
        'updated_at'
    ];
}

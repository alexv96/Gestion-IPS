<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    protected $table = 'noticias';

    protected $primaryKey = 'id_noticia';

    protected $fillable = [
        'titulo',
        'cuerpo',
        'empleado_id',
        'created_at',
        'updated_at'
    ];
}

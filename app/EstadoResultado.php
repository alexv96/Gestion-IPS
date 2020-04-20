<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstadoResultado extends Model
{
    protected $table = 'estado_resultado';

    protected $primaryKey = 'id_estadoResultado';

    protected $fillable = [
        'tipo_estado'
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoAnalisis extends Model
{
    protected $table = 'tipo_analisis';

    protected $primaryKey = 'id_tipoAnalisis';

    protected $fillable = [
        'nombre_analisis'
    ];
}

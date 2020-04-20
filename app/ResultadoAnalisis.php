<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResultadoAnalisis extends Model
{
    protected $table = 'resultado_analisis';

    protected $primaryKey = 'ID';
    protected $fillable = [
        'muestra_id',
        'fecha_registro',
        'PPM',
        'estado_id',
        'empleado_rut',
        'tipoAnalisis_id',
        'created_at',
        'updated_at'
    ];
}

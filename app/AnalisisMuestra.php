<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnalisisMuestra extends Model
{
    protected $table = 'analisis_muestra';

    protected $primaryKey = 'id_analisisMuestra';

    protected $fillable = [
        'fechaRecepcion',
        'temperatura_muestra',
        'cantidad_muestra',
        'empresa_codigoEmpresa',
        'cliente_codigoCliente',
        'empleado_id',
        'created_at',
        'updated_at'
    ];
}

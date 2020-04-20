<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    protected $table = 'direccion';

    protected $primaryKey = 'id_direccion';

    protected $fillable = [
        'calle',
        'numero',
        'depto',
        'particular_id',
        'created_at',
        'updated_at'
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Telefono extends Model
{
    protected $table = 'telefono';

    protected $primaryKey = 'id_telefono';

    protected $fillable = [
        'numero_telefono',
        'particular_id',
        'created_at',
        'updated_at'
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Renta extends Model
{
    protected $fillable = ['monto_desde', 'monto_hasta', 'fecha_desde', 'factor', 'cantidad_rebajar'];

    protected $table = 'rentas';

    public $timestamps = false;
}

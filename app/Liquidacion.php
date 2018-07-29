<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Liquidacion extends Model
{
    protected $table = 'liquidacions';
    public $timestamps = false;
    public function empleado()
    {
        return $this->belongsTo('App\Empleado');
    }
    public function contrato()
    {
        return $this->belongsTo('App\Contrato');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    protected $table = 'registros';
    protected $fillable = [ 'tipo',
    						'hora'
    					];
     public $timestamps = false;

     public function empleado()
    {
        return $this->belongsTo('App\Empleado');
    }
}

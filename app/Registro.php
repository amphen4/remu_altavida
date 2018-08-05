<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    protected $table = 'registros';
    protected $fillable = [ 'tipo',
    						'hora'
    					];
    protected $appends = ['empleado'];
     public $timestamps = false;

     public function empleado()
    {
        return $this->belongsTo('App\Empleado');
    }
    public function getEmpleadoAttribute(){
    	$empleado = $this->empleado()->first(); 
    	return $empleado->nombre.' '.$empleado->apellido_pat.' '.$empleado->apellido_mat;
    }
}

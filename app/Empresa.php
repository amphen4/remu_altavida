<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
	protected $table = 'empresas';
    protected $fillable = [ 'rut',
    						'nombre',
    						'direccion',
    						'comuna',
    						'ciudad',
    						'region',
    						'telefono',
    						'rubro',
    						'email',
    						'codigo',
    						'paginaweb',
                            'representante_nombre',
                            'representante_rut',
                            'contador_nombre',
                            'contador_rut'
    					];
     public $timestamps = false;

     public function empleados()
    {
        return $this->hasMany('App\Empleado');
    }
}

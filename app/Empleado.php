<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table = 'empleados';
    protected $fillable = [ 'rut',
    						'nombre',
    						'apellido_pat',
    						'apellido_mat',
    						'direccion',
    						'comuna',
    						'ciudad',
    						'telefono',
    						'celular',
    						'email',
    						'sexo',
    						'estado_civil',
    						'fecha_nacimiento',
    						'cargo',
    						'titulo',
    						'pais',
    						'cta_banco_nombre',
    						'cta_banco_nro',
    						'cta_banco_tipo',
    						'fecha_ingreso',
    						'fecha_retiro',
    						'fecha_renovacion',
    						'empresa_id'
    					];
     public $timestamps = false;

     public function registros()
    {
        return $this->hasMany('App\Registro');
    }
     public function empresa()
    {
        return $this->belongsTo('App\Empresa');
    }
    public function afp()
    {
        return $this->belongsTo('App\Afp');
    }
    public function isapre()
    {
        return $this->belongsTo('App\Isapre');
    }
    public function liquidacions()
    {
        return $this->hasMany('App\Liquidacion');
    }
    public function contratos()
    {
        return $this->hasMany('App\Contrato');
    }
}

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
    						'empresa_id',
                            'isapre_id',
                            'afp_id'
    					];
     public $timestamps = false;
     public $appends = ['afp_nombre','isapre_nombre','isapre_porcentaje','afp_porcentaje'];

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
    public function getAfpNombreAttribute()
    {
        return $this->afp()->first()->nombre;
    }
    public function getIsapreNombreAttribute()
    {
        return $this->isapre()->first()->nombre;
    }
    public function getIsaprePorcentajeAttribute()
    {
        return $this->isapre()->first()->porcentaje;
    }
    public function getAfpPorcentajeAttribute()
    {
        return $this->afp()->first()->porcentaje;
    }
}

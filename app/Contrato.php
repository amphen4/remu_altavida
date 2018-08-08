<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    protected $table = 'contratos';
    public $timestamps = false;
    protected $fillable = [	'sueldo_base',
    						'valor_colacion',
    						'valor_movilizacion',
    						'valor_hora_extra',
    						'valor_hora_atraso',
    						'horas_semanales',
    						'dias_semanales',
                            'estado',
                            'fecha_inicio',
                            'tipo'
    						]

    public function empleado()
    {
        return $this->belongsTo('App\Empleado');
    }
    public function habers()
    {
        return $this->belongsToMany('App\Haber')->withPivot(['fecha_inicio','duracion']);
    }
    public function dsctos()
    {
        return $this->belongsToMany('App\Dscto')->withPivot(['fecha_inicio','duracion']);
    }
    public function liquidacions()
    {
        return $this->hasMany('App\Liquidacion');
    }
}

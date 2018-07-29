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
    						'dias_semanales'
    						]

    public function empleados()
    {
        return $this->belongsToMany('App\Empleado')->withPivot('estado','fecha_inicio','tipo');
    }
    public function habers()
    {
        return $this->belongsToMany('App\Haber');
    }
    public function dsctos()
    {
        return $this->belongsToMany('App\Dscto');
    }
    public function liquidacions()
    {
        return $this->hasMany('App\Liquidacion');
    }
}

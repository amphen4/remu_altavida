<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Contrato extends Model
{
    protected $table = 'contratos';
    public $timestamps = false;
    protected $fillable = [	'sueldo_base',
    						'valor_hora_extra',
    						'valor_hora_atraso',
    						'horas_semanales',
    						'dias_semanales',
                            'estado',
                            'fecha_inicio',
                            'tipo',
    						];
    protected $appends = ['empleado','opciones','proxima_liquidacion', 'fecha_inicio_proxima_liquidacion', 'cargo', /*'cotizacion_pactada'*/];
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
    public function getCargoAttribute()
    {
        return $this->empleado()->first()->cargo;
    }
    public function getEmpleadoAttribute()
    {
        $empleado = $this->empleado()->first();
        return $empleado->nombre.' '.$empleado->apellido_pat.' '.$empleado->apellido_mat;
    }
    public function getOpcionesAttribute()
    {
        return '<a href="contratos/edit/'.$this->id.'" class="btn btn-xs btn-warning" >Modificar</a> <a class="btn btn-xs btn-primary botonVer" href="" data-id="'.$this->id.'">Ver</a>';
    }/*
    public function getCotizacionPactadaAttribute()
    {
        return $this->empleado()->first()->cotizacion_pactada;
    }*/
    public function getFechaInicioProximaLiquidacionAttribute()
    {
        $liquidacionesEmpleado = $this->empleado()->first()->liquidacions();
        if(!$liquidacionesEmpleado->count()){
            // Caso:  no hay liquidaciones
            return $this->fecha_inicio;
            
        }else{
            // Caso: si hay liquidaciones, osea hay que obtener la fecha de la prox liquidacion
            $ultimaLiquidacion = $liquidacionesEmpleado->orderBy('fecha_fin', 'desc')->first();
            $fecha_inicio_proxLiquidacion = Carbon::createFromFormat('Y-m-d',$ultimaLiquidacion->fecha_fin)->addDay();
            return $fecha_inicio_proxLiquidacion->toDateString();
        }
    }
    public function getProximaLiquidacionAttribute()
    {
        
        $liquidacionesEmpleado = $this->empleado()->first()->liquidacions();
        if(!$liquidacionesEmpleado->count()){
            // Caso:  no hay liquidaciones
            return $this->fecha_inicio.' - '.Carbon::createFromFormat('Y-m-d',$this->fecha_inicio)->addMonth()->subDay()->toDateString();
            
        }else{
            // Caso: si hay liquidaciones, osea hay que obtener la fecha de la prox liquidacion
            $ultimaLiquidacion = $liquidacionesEmpleado->orderBy('fecha_fin', 'desc')->first();
            $fecha_inicio_proxLiquidacion = Carbon::createFromFormat('Y-m-d',$ultimaLiquidacion->fecha_fin)->addDay();
            return $fecha_inicio_proxLiquidacion->toDateString().' - '.$fecha_inicio_proxLiquidacion->addMonth()->subDay()->toDateString();
        }
    }
}

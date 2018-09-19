<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Liquidacion extends Model
{
    protected $table = 'liquidacions';
    public $timestamps = false;

    protected $fillable = [ 'total_haberes',
                            'total_descuentos',
                            'monto_liquido',
                            'fecha_inicio',
                            'fecha_fin',
                            'mes',
                            'sueldo_contrato',
                            'monto_bruto',
                            'total_imponible',
                            'tasa_impuesto',
                            'estado',
                            'afecto_impuesto',
                            'dias_trabajados',
                            'horas_extras' ];

    public $appends = [ 'opciones', 'empleado' ];

    public function empleado()
    {
        return $this->belongsTo('App\Empleado');
    }
    public function contrato()
    {
        return $this->belongsTo('App\Contrato');
    }
    public function getOpcionesAttribute()
    {
        return '<button class="btn btn-primary btn-xs" >Opciones</button>';
    }
    public function getEmpleadoAttribute()
    {
        $empleado = $this->empleado()->first();
        return  $empleado->nombre.' '.$empleado->apellido_pat.' '.$empleado->apellido_mat;
    }
}

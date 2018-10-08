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

    public $appends = [ 'opciones', 'empleado', 'nombre_mes' ];

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
    public function getNombreMesAttribute()
    {
        switch($this->mes){
            case 1:
                return 'Enero';
            case 2:
                return 'Febrero';
            case 3:
                return 'Marzo';
            case 4:
                return 'Abril';
            case 5:
                return 'Mayo';
            case 6:
                return 'Junio';
            case 7:
                return 'Julio';
            case 8:
                return 'Agosto';
            case 9:
                return 'Septiembre';
            case 10:
                return 'Octubre';
            case 11:
                return 'Noviembre';
            case 12:
                return 'Diciembre';
        }
    }
}

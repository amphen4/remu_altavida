<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Liquidacion extends Model
{
    protected $table = 'liquidacions';
    public $timestamps = true;

    protected $fillable = [ 'total_haberes',
                            'total_descuentos',
                            'monto_liquido',
                            'fecha_inicio',
                            'fecha_fin',
                            'mes',
                            'sueldo_contrato',
                            //'monto_bruto',
                            'total_imponible',
                            //'tasa_impuesto',
                            'estado',
                            //'afecto_impuesto',
                            'dias_trabajados',
                            'horas_trabajadas',
                            //'horas_extras',
                            'contrato_id',
                            'empleado_id',
                            'total_no_imponible',
                            'descuentos_o',
                            'total_salud',
                            'total_afp',
                            'impuesto_renta',
                            'nombre_afp',
                            'nombre_salud',
                            'tasa_afp',
                            'tasa_salud',
                             ];

    public $appends = [ 'opciones', 'empleado', 'nombre_mes', 'periodo', 'monto_liquido_f', 'total_imponible_f', 'total_descuentos_f', 'total_no_imponible_f', 'descuentos_o_f', 'total_salud_f', 'total_afp_f', 'impuesto_renta_f' ];

    public function empleado()
    {
        return $this->belongsTo('App\Empleado');
    }
    public function contrato()
    {
        return $this->belongsTo('App\Contrato');
    }
    public function getImpuestoRentaFAttribute()
    {
        return number_format($this->impuesta_renta, 0, ",", ".");
    }
    public function getTotalSaludFAttribute()
    {
        return number_format($this->total_salud, 0, ",", ".");
    }
    public function getTotalAfpFAttribute()
    {
        return number_format($this->total_afp, 0, ",", ".");
    }
    public function getMontoLiquidoFAttribute()
    {
        return number_format($this->monto_liquido, 0, ",", ".");
    }
    public function getTotalImponibleFAttribute()
    {
        return number_format($this->total_imponible, 0, ",", ".");
    }
    public function getTotalDescuentosFAttribute()
    {
        return number_format($this->total_descuentos, 0, ",", ".");
    }
    public function getTotalNoImponibleFAttribute()
    {
        return number_format($this->total_no_imponible, 0, ",", ".");
    }
    public function getDescuentosOFAttribute()
    {
        return number_format($this->descuentos_o, 0, ",", ".");
    }
    public function getOpcionesAttribute()
    {
        if($this->estado == 'NO PAGADO'){
            return '<button class="btn btn-success btn-xs" data-id="'.$this->id.'" onclick="marcarPagado(this);">Marcar como Pagado</button><a class="btn btn-primary btn-xs" href="pdf_liquidacion/'.$this->id.'">Ver PDF</a>';
        }
        return '<a class="btn btn-primary btn-xs" href="pdf_liquidacion/'.$this->id.'">Ver PDF</a>';
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
    public function getPeriodoAttribute()
    {
        return $this->fecha_inicio.' - '.$this->fecha_fin;
    }
}

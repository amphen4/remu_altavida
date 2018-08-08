<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Haber extends Model
{
    protected $table = 'habers';
    public $timestamps = false;
    protected $fillable = ['nombre','tipo','valor_porcentaje','valor_entero','factor','imponible'];
    protected $appends = ['valor','imp'];

    public function contratos()
    {
        return $this->belongsToMany('App\Contrato')->withPivot(['fecha_inicio','duracion']);
    }

    public function getValorAttribute()
    {
    	switch( $this->tipo ){
    		case 'MONTO':
    			return number_format($this->valor_entero,0,',','.');
    			break;
    		case 'PORCENTAJE':
    			return number_format($this->valor_porcentaje,3,',','.');
    			break;
    	}
    }
    public function getImpAttribute()
    {
    	if ($this->imponible){
    		return 'Si';
    	}else{
    		return 'No';
    	}
    }
}

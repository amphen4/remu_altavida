<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Haber extends Model
{
    protected $table = 'habers';
    public $timestamps = false;
    protected $fillable = ['nombre','tipo','valor_porcentaje','valor_entero','factor','imponible'];
    public function contratos()
    {
        return $this->belongsToMany('App\Contrato');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dscto extends Model
{
    protected $table = 'dsctos';
    public $timestamps = false;
    protected $fillable = ['nombre','tipo','valor_porcentaje','valor_entero','factor','imponible'];
    public function contratos()
    {
        return $this->belongsToMany('App\Contrato');
    }
}

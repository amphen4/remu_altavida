<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Isapre extends Model
{
    protected $table = 'isapres';
    protected $fillable = ['nombre','porcentaje'];
    public $timestamps = false;
    public function empleados()
    {
        return $this->hasMany('App\Empleado');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Afp extends Model
{
    protected $table = 'afps';
    protected $fillable = ['nombre','porcentaje'];
    public $timestamps = false;
    public function empleados()
    {
        return $this->hasMany('App\Empleado');
    }
}

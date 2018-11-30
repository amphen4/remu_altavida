<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Isapre extends Model
{
    protected $table = 'isapres';
    protected $fillable = ['nombre'];
    public $timestamps = false;
    protected $appends = ['opciones'];
    public function empleados()
    {
        return $this->hasMany('App\Empleado');
    }

    /**
     * @return string
     */
    public function getOpcionesAttribute()
    {

        return '<a href="" data-id="'.$this->id.'" class="btn btn-default btn-xs botonEditar">Editar</a> <a  data-id="'.$this->id.'" class="btn btn-danger btn-xs botonEliminar" >Eliminar</a>';

    }
}

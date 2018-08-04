<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id'
    ];
    protected $appends = ['role_name_span','opciones','role_name'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public function hasRole($role_name)
    {
        if ($this->role()->first()->name == $role_name) {
            return true;
        }
        return false;
    }
    public function getRoleNameAttribute()
    {
        return $this->role()->first()->name;
    }
    public function getRoleNameSpanAttribute()
    {
        if($this->role()->first()->name == 'admin'){
            return '<span class="label label-primary">Administrador</span>';
        }
        if($this->role()->first()->name == 'secretary'){
            return '<span class="label label-default">Usuario Secretaria</span>';
        }
        
    }
    public function getOpcionesAttribute()
    {
        switch($this->role()->first()->name){
            case 'admin':
                return '<a href=""  data-id="'.$this->id.'" class="btn btn-default btn-xs botonEditar">Editar</a> <a  data-id="'.$this->id.'" data-rol="admin" class="btn btn-danger btn-xs botonEliminar" >Eliminar</a>';
            case 'secretary':
                return '<a href="" data-id="'.$this->id.'" class="btn btn-default btn-xs botonEditar">Editar</a> <a  data-id="'.$this->id.'" class="btn btn-danger btn-xs botonEliminar" >Eliminar</a>';
        }
    }
}

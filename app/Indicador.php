<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Indicador extends Model
{
    protected $fillable = [
        'uf','utm','ipc','dolar','euro','fecha'
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    //
    protected $fillable = [
        'id_usuario', 'estado', 'cidade', 'bairro'
    ];
}

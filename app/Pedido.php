<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = ['id_usuario', 'produto', 'descricao', 'estado', 'cidade', 'bairro'];
}

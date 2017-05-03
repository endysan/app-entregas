<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entregador extends Model
{
    //
    protected $fillable = [
        'id_usuario', 'cnh', 'veiculo'
    ];
    protected $table = 'entregadores';
}

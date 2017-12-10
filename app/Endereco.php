<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    //
    protected $table = 'endereco';

    public function entregador()
    {
        return $this->belongsTo('App\Entregador');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Veiculo extends Model
{
    //
    protected $table = 'veiculos';

    public function entregador()
    {
        return $this->belongsTo('App\Entregador');
    }
}

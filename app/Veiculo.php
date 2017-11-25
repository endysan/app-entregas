<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Veiculo extends Model
{
    use SoftDeletes;
    protected $table = 'veiculo';
    protected $dates = ['deleted_at'];

    protected $categoriaVeiculo = ['moto' => 'moto', 'carro' => 'carro', 'caminhao' => 'caminhao'];

    public function entregador()
    {
        return $this->belongsTo('App\Entregador');
    }
    public function getCategoriaVeiculoAttribute($value)
    {
        return Arr::get($this->categoriaVeiculo, $value);
    }
}

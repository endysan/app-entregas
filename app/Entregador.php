<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Entregador extends Authenticatable
{
    use Notifiable;

    protected $table = 'entregador';
    
    protected $fillable = [
        'name', 'email', 'password',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function cliente()
    {
        return $this->belongsTo('App\Entregador');
    }
}

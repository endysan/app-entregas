<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imagem extends Model
{
    //

    public function veiculo()
    {
        return $this->hasOne('App\Veiculo');
    }
    public function pedido() 
    {
        return $this->hasOne('App\Pedido');
    }
    public function formatImageName($type, $img) {
        $extension = $img->getClientOriginalExtension();
        $fileName = $type."_". Carbon\Carbon::now();
        $fileName = str_replace('-', '', $fileName);
        $fileName = str_replace(' ', '_', $fileName);
        $fileName = str_replace(':', '', $fileName);
    
        return $fileName .'.'. $extension;
    }
}

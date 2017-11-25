<?php

namespace App\Http\Controllers;

use App\Imagem;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ImagemController extends Controller
{
    //

    public function getVeiculoImage($id)
    {
        $imagem = Imagem::where('veiculo_id', $id)->get();
        return $imagem;
    }
    public function getPedidoImage($id)
    {
        $imagem = Imagem::where('pedido_id', $id)->get();
        return $imagem;
    }

    public function getImage(){
        $imagens = Imagem::all();

    }

    /**
     * @param string $type Pode ser avatar/pedido/veiculo
     * @return string Nome do arquivo 
     */
    public static function formatImageName($type, $img) {
        $extension = $img->getClientOriginalExtension();
        $fileName = $type."_". Carbon::now();
        $fileName = str_replace('-', '', $fileName);
        $fileName = str_replace(' ', '_', $fileName);
        $fileName = str_replace(':', '', $fileName);
    
        return $fileName . '.' . $extension;
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MapController extends Controller
{
    //
     public function calculateDistance($origin, $destination)
    {
        $distance = \GoogleMaps::load('distancematrix')
            ->setParamByKey('origins', $origin)
            ->setParamByKey('destinations', $destination)                      
            ->get();
        $data = [ 
            'title' => 'Distancia',
            'distancia' => $distance,
        ];
        return $data['distancia'];
    }
    
    public function getLatLng($localString)
    {
        $latlng = \GoogleMaps::load('geocoding')
            ->setParam([
                'address' => $localString,
                'region' => 'pt-BR'
            ])
            ->get();
        return $latlng;
    }
    public function getCalculatedLatlng()
    {
        $locais = DB::table('pedidos')->select('estado', 'cidade', 'bairro')
                    ->where('status', 'iniciado')->orWhere('status', 'confirmaçao')->get();
        $geocoding = [];
        foreach($locais as $local) {
            $geocoding[] = $this->getLatLng($local->estado.','.$local->cidade.','.$local->bairro);
        }
        $var = ['locais' => $geocoding];
        
        return $var;
    }
    public function viewMap()
    {
        return view('maps.map');
    }
}

<?php

namespace App\Http\Controllers;

use App\Pedido;
use Illuminate\Http\Request;
use Cornford\Googlmapper\Mapper;
use Illuminate\Support\Facades\DB;
use GoogleMaps\Facade\GoogleMapsFacade;

class MapsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = ['title' => 'Mapa'];
        return view('maps.index', $data);
    }

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

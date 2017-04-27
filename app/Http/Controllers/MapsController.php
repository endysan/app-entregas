<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
}

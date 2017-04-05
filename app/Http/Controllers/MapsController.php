<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GoogleMaps\Facade\GoogleMapsFacade;

class MapsController extends Controller
{
    public function index()
    {
        $data = ['title' => 'Mapa'];
        return view('maps.index', $data);
    }
    public function calculateDistance()
    {
        $distance = \GoogleMaps::load('distancematrix')
            ->setParamByKey('origins', 'rua+oswaldo+cruz+39+boqueirao+santos')
            ->setParamByKey('destinations', 'rua+fernandes+onofre+trizzini+546+itaoca+mongagua')                      
            ->getParamByKey('rows.elements');

        $data = [ 
            'title' => 'Distancia',
            'distancia' => $distance,
        ];

        return view('maps.distancia', $data);
    }
}

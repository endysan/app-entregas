<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use laravel\pagseguro\Platform\Laravel5;
use \Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index() 
    {
        $data = ['title' => 'Comprar Serviço'];
        return view('checkout.index', $data);
    }

    public function create(Request $request)
    {
        $messages = [
            'regex' => 'O :attribute deve ser completo',
            'min' => 'O :attribute deve ter no minimo :min.',
            'required' => 'O :attribute é obrigatório',
        ];

        $validator = Validator::make($request->all(), [
            'nome' => "required|min:5|max:100|regex:^[\\p{L} .'-]+$^",
            'produto' => 'required|min:5',
            'valor' => 'required'
        ], $messages);
        
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $venda = [
            'items' => [
                [
                    'id' => '18',
                    'description' => strval(request('produto')),
                    'quantity' => '1',
                    'amount' => request('valor'),
                    'shippingCost' => '3.10',
                ]
            ],
            'shipping' => [
                'address' => [
                    'postalCode' => '11730000',
                    'street' => 'Rua Fernandes Onofre Trizzini',
                    'number' => '546',
                    'district' => 'Itaóca',
                    'city' => 'Mongaguá',
                    'state' => 'SP',
                    'country' => 'BRA',
                ],
                'type' => 2,
                'cost' => 15.5,
            ],
            'sender' => [
                'email' => 'c76686060164578186366@sandbox.pagseguro.com.br',
                'name' => strval(request('nome')),
            ]
        ];

        $credentials = \PagSeguro::credentials()->get();

        $checkout = \PagSeguro::checkout()->createFromArray($venda);
        
        $information = $checkout->send($credentials); // Retorna um objeto de laravel\pagseguro\Checkout\Information\Information
        
        $data = [
            'title' => 'Checkout',
            'link' => $information->getLink()
        ];

        
        return view('checkout.checkout', $data);
    }
}

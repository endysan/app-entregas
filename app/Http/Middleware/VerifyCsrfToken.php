<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/list-usuario',
        '/create-usuario',
        '/get-usuario/*',
        '/edit-usuario/*',
        '/delete-usuario/*',
        '/list-pedido',
        '/create-pedido',
        '/get-pedido/*',
        '/edit-pedido/*',
        '/delete-pedido/*',
        '/list-entregador',
        '/create-entregador',
        '/get-entregador/*',
        '/edit-entregador/*',
        '/delete-entregador/*',
    ];
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CadastroController extends Controller {
	public function index() {
		$data = ['title' => 'Cadastrar'];
		return view('cadastro', $data);
	}
	public function store(Request $request) {
		$this->validate($request, [
			'txt_nome' => 'required|max:255',
			'txt_email' => 'required|max:255',
			'txt_senha' => 'required|max:255',
		]);
	}
}

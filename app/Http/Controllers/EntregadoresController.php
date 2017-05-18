<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Entregador;
use App\User;

class EntregadoresController extends Controller
{
    public function checkAdm()
    {
        if(!session()->has('admin'))
            return redirect('/login-admin');
    }

    public function getEntregador()
    {
        return Entregador::all();
    }
    public function getEntregadorById($id)
    {
        return Entregador::findOrFail($id);
    }
    
    public function listEntregador()
    {

        $entregadores = $this->getEntregador();
        $users = DB::table('users')->select('id', 'email')->get();
        //$deletedUsers = User::onlyTrashed()->get();
        
        $data = [
            'entregadores' => $entregadores,
            'users' => $users
        ];
        return view('crud.entregador', $data);
    }
    
    public function createEntregador(Request $request)
    {
        $this->validate($request, [
			'id_usuario' => 'required',
			'cnh' => 'required|min:10|max:10',
            'veiculo' => 'required'
		]);
		
        //$cnh = $request->cnh;
        
        //if($this->validaCnh($cnh))
            //echo "ok";
        $email = DB::table('users')->where('id', $request->id_usuario)->select('email')->first();

        $id_entregador = DB::table('entregadores')->insertGetId([
            'id_usuario' => $request->id_usuario,
            'email' => $email,
            'cnh' => $request->cnh,
            'veiculo' => $request->veiculo
        ]);

		DB::table('users')
            ->where('id', $request->id_usuario)
            ->update([
                'id_entregador' => $id_entregador
            ]);
		//dd($request->all());
        return redirect('list-entregador');
    }

    public function editEntregador(Request $request, $id)
    {
        
        DB::table('entregadores')
            ->where('id', $id)
            ->update([
                'cnh' => $request->cnh,
                'veiculo' => $request->veiculo,
                'status' => $request->status
            ]);
        return "ok";
    }
    
    public function deleteEntregador($id)
    {
        DB::table('entregadores')->where('id', $id)->delete();

        return "ok";
    }
    public function validaCnh($cnh)
    {
        $ret = false;
        if ( is_string( $cnh ) ) {
	        if ( ( strlen( $cnh = preg_replace( '/[^\d]/' , '' , $cnh ) ) == 11 ) && ( str_repeat( $cnh{ 1 } , 11 ) != $cnh ) ) {
		        $dsc = 0;

        		for ($i = 0 , $j = 9 , $v = 0 ; $i < 9 ; ++$i , --$j )
        			$v += (int) $cnh{ $i } * $j;
        
        		if (($vl1 = $v % 11) >= 10) {
        			$vl1 = 0;
        			$dsc = 2;
        		}
        
        		for ($i = 0 , $j = 1 , $v = 0 ; $i < 9 ; ++$i , ++$j)
        			$v += (int) $cnh{ $i } * $j;
        
        		$vl2 = ( $x = ( $v % 11 ) ) >= 10 ? 0 : $x - $dsc;
        		$ret = sprintf( '%d%d' , $vl1 , $vl2 ) == substr( $cnh , -2 );
        	}
        }
        return $ret;
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Endereco;

class ClienteController extends Controller
{
    public function cadastrar(Request $request){
        $data = [];

        return view("cadastrar", $data);
    }

    public function cadastrarCliente(Request $request){
        $values = $request->all();

        $usuario = new Usuario($values);
        //ISOLADAMENTE: $usuario->cpf = $request->input("cpf", "");
        $usuario->login = $request->input("cpf", "");
        $endereco = new Endereco($values);
        $endereco->logradouro = $request->input("endereco", "");



        return redirect()->route('cadastrar');
    }
}

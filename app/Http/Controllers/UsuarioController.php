<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class UsuarioController extends Controller
{
    public function logar(Request $request){
        $data = [];

        //USUARIO CLICOU EM LOGAR:
        if($request->isMethod("POST")){
            $login = $request->input("login");
            $senha = $request->input("senha");
            //ignorar pontos e traços do login
            $login = preg_replace("/[^0-9]/", "", $login);

            //Logar:
            if(Auth::attempt(['login' => $login, 'password' => $senha])){
                return redirect()->route("home");
            }else{
                $request->session()->flash("err", "Usuário / senha inválidos");
                return redirect()->route("logar");
            }
        }
        return view("logar", $data);
    }

    public function sair(Request $request){
        Auth::logout();
        return redirect()->route('home');
    }
}

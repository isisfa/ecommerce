<?php

namespace App\Services;

use App\Models\Usuario;
use App\Models\Endereco;
use Log;

class ClienteService {
    public function salvarUsuario(Usuario $user, Endereco $endereco){
        try{
            //Buscando um usuario com o login que deve ser salvo
            $dbUsuario = Usuario::where("login", $user->login)->first();
            if($dbUsuario){
                return ['status' => 'err', 'message'  => 'Login ja cadastrado no sistema'];
            }

            \DB::beginTransaction();
            $user->save();
            $endereco->usuario_id = $user->id; //relaciona as tabelas
            $endereco->save();
            \DB::commit();

            return ['status' => 'ok', 'message' => 'Usuario Cadastrado com sucesso'];
        }catch(\Exception $e){
            \Log::error("ERRO", ['file' => 'ClienteService.salvarUsuario',
                                            'message' => $e->getMessage()]);
            \DB::rollback();
            return ['status' => 'err', 'message' => 'Não pode cadastrar usuario'];
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

abstract class UsuarioController extends Controller
{

    abstract function fazerLogin(Request $request) : JsonResponse;
    
    /**
     * Função para recuperar dados do usuário.
     * @param $matricula
     * @return object
     */
    public function recuperarDadosUsuarioPeloEmail($email) : object
    {
        $usuario = Usuario::where('codhash', $email)->get();
        return $usuario;
    }

    /**
     * Função para validar login usuário.
     * @param $email - email do usuário.
     * @param $senha - senha do usuário.
     * @return bool - retorna true se usuário existe.
     */
    protected function validarEmailESenhaLogin($email, $senha) : bool
    {
        $valor = Usuario::where('email','=',$email)
                        ->where('senha','=', md5($senha))->get();

        return isset($valor[0]->id) ? true : false;
    }

    /**
     * Função para validar se usuário está ativo
     * @param $email
     * @return bool
     */
    protected function validarUsuarioAtivo($email): bool
    {
        $valor = Usuario::where('email',$email)->get();
        return $valor[0]->id_status == StatusController::$ATIVO ? true : false;
    }
}

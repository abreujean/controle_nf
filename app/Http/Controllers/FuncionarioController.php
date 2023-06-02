<?php
namespace App\Http\Controllers;

use App\Http\Controllers\UsuarioController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

abstract class FuncionarioController extends UsuarioController
{
    public function __construct()
    {
        
    }

    public function fazerLogin(Request $request): JsonResponse
    {

        /**
         * Recuperar dados do usuário logado
         */ 
        $usuario = $this->recuperarDadosUsuarioPeloEmail(trim($request->email));

        try{

           /**
           * Verifica se usuário existe.
           */
           if(!$this->validarEmailESenhaLogin(trim($request->email), trim($request->senha)))
           {
             throw new \Exception('Email e/ou senha inválida.');
           }

           /**
            * Verifica se usuário está ativo.
            */
            if(!$this->validarUsuarioAtivo(trim($request->usuario)))
            {
                throw new \Exception('Usuário não está ativo.');
            }

            /**
             * Adicionar dados do usuário logado na sessão.
             */
            $request->session()->put('usuario', $usuario);

            /**
             * Log de Usuário
            */
            $this->logController->gravarLog($usuario[0]->id, LogController::$LOGAR, ' no sistema cujo id identificador é ' . $usuario[0]->id);

            
            return response()->json('Logado com sucesso!', 200);

        }catch(\Exception $e){
            return response()->json( $e->getMessage(), 400);
        }

    }
}

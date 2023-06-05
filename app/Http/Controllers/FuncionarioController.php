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
            if(!$this->validarUsuarioAtivo(trim($request->email)))
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


    /**
     * Função para cadastrar empresa
     * @param Request $request
     * @return JsonResponse
     */
    protected function cadastrarEmpresa(Request $request) : JsonResponse
    {
        
        try
        {               
            //Verificar se a placa o cnpj está nop sistema
            if($this->empresaController->validarSeCnpjEmpresaEstaCadastrada($request->cnpj))
            {
                throw new \Exception('CNPJ já cadastrado.');
            }

            //Cadastra empresa no sistema
            $empresa = $this->empresaController->novoEmpresa($request->cnpj, $request->razao_social);

            /**
            * Log de Usuário
            */
            $this->logController->gravarLog(session()->get('usuario')[0]->id, LogController::$CRIAR, ' uma nova Empresa no sistema cujo id identificador é ' . $empresa->id);

            return response()->json('Empresa foi criada com sucesso.', 200);

        }catch (\Exception $e){
            return response()->json($e->getMessage(), 400);
        }

    }


    /**
     * Função para excluir determinado Empresa
     * @param $request
     * @return JsonResponse
     */
    protected function excluirEmpresa(Request $request) : JsonResponse {

        try{

            // So posso excluir academico se nao existir vinculação com a nota fiscal
            //
            if($this->notaFiscalController->verificaSeExisteVinculacaoEmpresaPorId( $this->empresaController->recuperarIDPeloCodHashEmpresa($request->codhash))){
                throw new \Exception("Você não pode excluir uma empresa que está vinculada a uma nota fiscal.");
            }

            $this->empresaController->excluirEmpresa($this->empresaController->recuperarIDPeloCodHashEmpresa($request->codhash));

            /**
            * Log de Usuário
            */
            $this->logController->gravarLog(session()->get('usuario')[0]->id, LogController::$EXCLUIR, ' uma Empresa no sistema');

            return response()->json('Empresa foi excluída com sucesso !', 200);

        }catch(\Exception $e){
            return response()->json($e->getMessage(), 400);
        }

    }
}

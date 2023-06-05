<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class EmpresaController extends Controller
{
    /**
     * Função para registrar nova empresa no sistema.
     * @param 
     * @return object
     */
    public function novoEmpresa($cnpj, $razao_social): object
    {
        $empresa = Empresa::create([
            'cnpj' => $cnpj,
            'razao_social' => $razao_social,
            'codhash' => Uuid::uuid4(),
        ]);

        return $empresa;
    }


    /**
     * Função para verificar se cnpj já foi cadastrado
     * @param placa
     * @return boolean
     */
    public function validarSeCnpjEmpresaEstaCadastrada($cnpj): bool
    {
        $empresa = Empresa::where('cnpj', $cnpj)->get();
        return isset($empresa[0]->cnpj) ? true : false;
    }

    /**
     * Função para listar empresas no sistema
     * @return JsonResponse
     */
    public function listarEmpresa(): object
    {
        $empresa = Empresa::all();
        return $empresa;
    }


    /**
     * Função para recuperar id da empresa pelo codhash
     * @param placa
     * @return boolean
     */
    public function recuperarIDPeloCodHashEmpresa($codhash): int
    {
        $empresa = Empresa::where('codhash', $codhash)->get();
        return $empresa[0]->id;
    }


    /**
     * Função para excluir empresa
     * @param $id_empresa
     * @return void
     */
    public function excluirEmpresa($id) : void {
        Empresa::where(['id' => $id])->delete();
    }
}

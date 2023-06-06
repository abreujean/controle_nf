<?php

namespace App\Http\Controllers;

use App\Models\NotaFiscal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class NotaFiscalController extends Controller
{
    /**
     * Função para verificar se existe cadastro em nota_fiscal vinculado a empresa
     */
    public function verificaSeExisteVinculacaoEmpresaPorId($id_empresa) : bool {
        $lista = NotaFiscal::where('id_empresa', $id_empresa)->get();
        return $lista->count() >= 1 ? true : false;
    }


    /**
     * Função para verificar se numero nf já foi cadastrado
     * @param placa
     * @return boolean
     */
    public function validarSeNumeroNfestaCadastrado($numero): bool
    {
        $notaFiscal = NotaFiscal::where('numero', $numero)->get();
        return isset($notaFiscal[0]->cnpj) ? true : false;
    }


    /**
     * Função para registrar nova nota fiscal no sistema.
     * @param 
     * @return object
     */
    public function novoNotaFiscal($id_usuario, $id_empresa, $numero, $valor, $mes_competencia, $mes_caixa): object
    {
        $notaFiscal = NotaFiscal::create([
            'id_usuario' => $id_usuario,
            'id_empresa' => $id_empresa,
            'numero' => $numero,
            'valor' => $valor,
            'mes_competencia' => $mes_competencia,
            'mes_caixa' => $mes_caixa,
            'codhash' => Uuid::uuid4(),
        ]);

        return $notaFiscal;
    }


    /**
     * Função para listar todas as notas fiscais no sistema
     * @return JsonResponse
     */
    public function listarNotaFiscal(): array
    {
        $lista = DB::select('SELECT nf.id, nf.numero, nf.valor, DATE_FORMAT(nf.mes_competencia, "%m/%Y") AS mes_competencia, DATE_FORMAT(nf.mes_caixa, "%m/%Y") AS mes_caixa, nf.codhash, e.razao_social, e.cnpj FROM nota_fiscal nf INNER JOIN empresa e on nf.id_empresa = e.id ORDER BY nf.id ASC');
        return $lista;
    }

    /**
     * Função para recuperar id da nota fiscal pelo codhash
     * @param placa
     * @return boolean
     */
    public function recuperarIDPeloCodHashNotaFiscal($codhash): int
    {
        $notaFiscal = NotaFiscal::where('codhash', $codhash)->get();
        return $notaFiscal[0]->id;
    }

    /**
     * Função para excluir nota fiscal
     * @param $id
     * @return void
     */
    public function excluirNotaFiscal($id) : void {
        NotaFiscal::where(['id' => $id])->delete();
    }

}

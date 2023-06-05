<?php

namespace App\Http\Controllers;

use App\Models\NotaFiscal;
use Illuminate\Http\Request;

class NotaFiscalController extends Controller
{
    /**
     * Função para verificar se existe cadastro em nota_fiscal vinculado a empresa
     */
    public function verificaSeExisteVinculacaoEmpresaPorId($id_empresa) : bool {
        $lista = NotaFiscal::where('id_empresa', $id_empresa)->get();
        return $lista->count() >= 1 ? true : false;
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatusController extends Controller
{
    public static $ATIVO = 1;
    public static $INATIVA = 2;
    public static $PENDENTE = 3;


    /**
     * Função para listar status
     * @param 
     * @return object
     */
    public function listarStatus() : object {
        $lista = Status::all();
        return $lista;
    }
}

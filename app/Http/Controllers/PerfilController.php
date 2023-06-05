<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class PerfilController extends Controller
{
    public static $PERFIL_COLABORADOR = 1;
    public static $PERFIL_ADMINISTRADOR = 2;

    /**
     * Função para verificar id_perfil do usuário pelo email
     * @param $request
     * @return int
     */
    public function recuperarIdPerfilAdministrativoPeloEmail(Request $request) : int {
        $valor = Usuario::where('email', $request->email)->get();
        return isset($valor[0]->id_perfil) ? $valor[0]->id_perfil : 0;
    }

    /**
     * Função para recuperar o perfil do usuário logado na sessão
     */

     public function recuperaPerfilUsuarioLogado() : array {
        return session()->get('usuario')[0]->perfil->perfil;
     }
}

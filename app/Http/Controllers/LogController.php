<?php

namespace App\Http\Controllers;

use App\Models\LogUsuario;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class LogController extends Controller
{
    public static $CRIAR = "CRIOU";
    public static $ATUALIZAR = "ATUALIZOU";
    public static $EXCLUIR = "EXCLUIU";
    public static $BUSCAR = "BUSCOU";
    public static $LOGAR = "LOGOU";
    public static $VISITAR = "VISITOU";
    public static $PESQUISAR = "PESQUISOU";
    public static $ENVIAR = "ENVIOU";
    public static $VINCULAR = "VINCULOU";

    /**
     * Função para gravar um novo Log no sistema.
     * @param $id_usuario, $tipo_evento, $evento
     * @return void
     */
    public function gravarLog($id_usuario, $tipo_evento, $evento) : void {

        LogUsuario::create([
            'id_usuario' => $id_usuario,
            'tipo_evento' => $tipo_evento,
            'evento' => $evento,
            'codhash' => Uuid::uuid4(),
        ]);

    }
}

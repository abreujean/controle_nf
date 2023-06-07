<?php

namespace App\Http\Controllers;

use App\Models\LogUser;
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
     * Fuction to record log user in sistem .
     * @param $id_user, $event_type, $event
     * @return void
     */
    public function newLog($id_user, $event_type, $event) : void {

        LogUser::create([
            'id_user' => $id_user,
            'event_type' => $event_type,
            'event' => $event,
            'codhash' => Uuid::uuid4(),
        ]);

    }
}

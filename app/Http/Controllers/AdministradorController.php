<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdministradorController extends FuncionarioController
{
    public $logController;

    public function __construct()
    {
        $this->logController = new LogController();
    }
}

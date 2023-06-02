<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ColaboradorController extends FuncionarioController
{
    public $logController;

    public function __construct()
    {
        $this->logController = new LogController();
    }
}

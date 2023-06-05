<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ColaboradorController extends FuncionarioController
{
    public $logController;
    public $empresaController;
    public $notaFiscalController;

    public function __construct()
    {
        $this->logController = new LogController();
        $this->empresaController = new EmpresaController();
        $this->notaFiscalController = new NotaFiscalController();
    }
}

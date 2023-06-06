<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RotasController extends Controller
{

    public $empresaController;

    public function __construct()
    {
        $this->empresaController = new EmpresaController();    
    }

    public function logout()
    {
        session()->flush();
        return Redirect::to('/');
    }

    public function irLogin(){
        
        return view('login');
    }

    public function irPainel(){
        
        return view('painel');
    }

    public function irCadastroNotaFiscal(){

        $listarEmpresa = $this->empresaController->listarEmpresa();

        return view('cadastro-nota-fiscal', compact('listarEmpresa'));
    }

    public function irControleNotaFiscal(){
        return view('controle-nota-fiscal');
    }

    public function irEditarNotaFiscal(){
        
        return view('editar-nota-fiscal');
    }

    public function irCadastroEmpresa(){
        return view('cadastro-empresa');
    }

    public function irControleEmpresa(){
        return view('controle-empresa');
    }

}

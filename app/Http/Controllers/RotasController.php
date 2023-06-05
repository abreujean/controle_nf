<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RotasController extends Controller
{
    public function __construct()
    {
        
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

    public function irCadastroNF(){
        return view('cadastro-nf');
    }

    public function irCadastroEmpresa(){
        return view('cadastro-empresa');
    }

    public function irControleEmpresa(){
        return view('controle-empresa');
    }

}

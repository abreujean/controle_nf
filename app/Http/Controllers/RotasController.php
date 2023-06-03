<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RotasController extends Controller
{
    public function __construct()
    {
        
    }

    public function irLogin(){
        
        return view('login');
    }

    public function irPainel(){
        
        return view('painel');
    }
}

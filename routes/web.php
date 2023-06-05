<?php

use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\ColaboradorController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\RotasController;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

/**
 * Rotas gerais
 */

Route::get('/', [RotasController::class, 'irLogin']);
Route::get('/login', [RotasController::class, 'irLogin']);

Route::post('/logout', [RotasController::class, 'logout']);
Route::post('/logando-colaborador', [ColaboradorController::class, 'fazerLogin']);
Route::post('/logando-administrador', [AdministradorController::class, 'fazerLogin']);
Route::post('/recuperar-id-perfil-administrativo-pelo-email', [PerfilController::class, 'recuperarIdPerfilAdministrativoPeloEmail']);

Route::get('/recuperar-perfil-usuario-logado', [PerfilController::class, 'recuperaPerfilUsuarioLogado']);



/**
 * Rotas colaborador (Precisa está logado)
 */

 Route::group(['prefix' => 'colaborador', 'middleware' => 'VerificaSeUsuarioLogado',  'middleware' => 'VerificaSeUsuarioColaborador'], function () {

    /**
     * ROTAS
     */
    Route::get('/painel', [RotasController::class, 'irPainel']);
    Route::get('/cadastro-nf', [RotasController::class, 'irCadastroNF']);
    Route::get('/cadastro-empresa', [RotasController::class, 'irCadastroEmpresa']);
    Route::get('/controle-empresa', [RotasController::class, 'irControleEmpresa']);


    /**
     * EXECUÇOES
     */
    Route::post('/cadastrando-empresa', [ColaboradorController::class, 'cadastrarEmpresa']);
    Route::post('/excluindo-empresa', [ColaboradorController::class, 'excluirEmpresa']);
    Route::get('/listar-empresa', [EmpresaController::class, 'listarEmpresa']);


});


 /**
 * Rotas somente para ADMINISTRADOR (Precisa está logado)
 */
Route::group(['prefix' => 'administrador', 'middleware' => 'VerificaSeUsuarioLogado',  'middleware' => 'VerificaSeUsuarioAdministrador'], function () {

    /**
     * ROTAS
     */
    Route::get('/painel', [RotasController::class, 'irPainel']);
    Route::get('/cadastro-nf', [RotasController::class, 'irCadastroNF']);
    Route::get('/cadastro-empresa', [RotasController::class, 'irCadastroEmpresa']);
    Route::get('/controle-empresa', [RotasController::class, 'irControleEmpresa']);



    /**
     * EXECUÇOES
     */
    Route::post('/cadastrando-empresa', [AdministradorController::class, 'cadastrarEmpresa']);
    Route::post('/excluindo-empresa', [AdministradorController::class, 'excluirEmpresa']);
    Route::get('/listar-empresa', [EmpresaController::class, 'listarEmpresa']);



});


/**
 * VARIAVEIS GLOBAIS
 */
View::composer('*', function ($view) {

     $view->with('ATIVO', 1);
     $view->with('PERFIL_COLABORADOR', PerfilController::$PERFIL_COLABORADOR);
     $view->with('PERFIL_ADMINISTRADOR', PerfilController::$PERFIL_ADMINISTRADOR);
 
     if (!empty(Session::get('usuario'))) {
         $view->with('PREFIXO', strtolower(session()->get('usuario')[0]->perfil->perfil));
     }
 
 });
 
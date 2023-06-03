<?php

use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\ColaboradorController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\RotasController;
use Illuminate\Support\Facades\Route;


/**
 * Rotas gerais
 */

Route::get('/', [RotasController::class, 'irLogin']);
Route::get('/login', [RotasController::class, 'irLogin']);
Route::post('/logando-colaborador', [ColaboradorController::class, 'fazerLogin']);
Route::post('/logando-administrador', [AdministradorController::class, 'fazerLogin']);
Route::post('/recuperar-id-perfil-administrativo-pelo-email', [PerfilController::class, 'recuperarIdPerfilAdministrativoPeloEmail']);


/**
 * Rotas colaborador (Precisa está logado)
 */

 Route::group(['prefix' => 'colaborador', 'middleware' => 'VerificaSeUsuarioLogado',  'middleware' => 'VerificaSeUsuarioColaborador'], function () {

    /**
     * ROTAS
     */
    Route::get('/painel', [RotasController::class, 'irPainel']);
 

    /**
     * EXECUÇOES
     */


});


 /**
 * Rotas somente para ADMINISTRADOR (Precisa está logado)
 */
Route::group(['prefix' => 'administrador', 'middleware' => 'VerificaSeUsuarioLogado',  'middleware' => 'VerificaSeUsuarioAdministrador'], function () {

    /**
     * ROTAS
     */
    Route::get('/painel', [RotasController::class, 'irPainel']);
 

    /**
     * EXECUÇOES
     */


});
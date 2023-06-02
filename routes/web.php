<?php

use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\ColaboradorController;
use App\Http\Controllers\RotasController;
use Illuminate\Support\Facades\Route;



/**
 * Rotas gerais
 */

Route::get('/', [RotasController::class, 'irLogin']);
Route::get('/login', [RotasController::class, 'irLogin']);

Route::post('/logando-colaborador', [ColaboradorController::class, 'fazerLogin']);
Route::post('/logando-administrador', [AdministradorController::class, 'fazerLogin']);


/**
 * Rotas colaborador
 */


 /**
 * Rotas administrador
 */
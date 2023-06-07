<?php

use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\CollaboratorController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MeiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoutesController;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

/**
 * Comum Routes
 */

Route::get('/', [RoutesController::class, 'goLogin']);
Route::get('/login', [RoutesController::class, 'goLogin']);

Route::post('/logout', [RoutesController::class, 'logout']);
Route::post('/logging-contributor', [CollaboratorController::class, 'doLogin']);
Route::post('/logging-administrato', [AdministratorController::class, 'doLogin']);
Route::post('/recover-profile-id-by-email', [ProfileController::class, 'recoveProfileIdByEmail']);

Route::get('/recover-user-profile-logged', [ProfileController::class, 'recoverUserProfilelogged']);



/**
 * Collaborator Routes
 */

 Route::group(['prefix' => 'collaborator', 'middleware' => 'VerificaSeUsuarioLogado',  'middleware' => 'VerificaSeUsuarioColaborador'], function () {

 
    Route::get('/dashboard', [RoutesController::class, 'goDashboard']);

    Route::get('/company-create', [RoutesController::class, 'goCompanyCreate']);
    Route::get('/company-control', [RoutesController::class, 'goCompanyControl']);
    Route::get('/edit-company/{codhash}', [RoutesController::class, 'goCompanyEdit']);

    Route::get('/category-create', [RoutesController::class, 'goCategoryCreate']);
    Route::get('/category-control', [RoutesController::class, 'goCategoryControl']);
    Route::get('/edit-category/{codhash}', [RoutesController::class, 'goCategoryEdit']);

    Route::get('/mei-control', [RoutesController::class, 'goMeiControl']);
    Route::get('/edit-mei/{codhash}', [RoutesController::class, 'goMeiEdit']);


    /**
     * EXECUÇOES
     */
    Route::post('/creating-company', [CollaboratorController::class, 'createdCompany']);
    Route::post('/deleting-company', [CollaboratorController::class, 'deleteCompany']);
    Route::post('/edit-company/editing', [CollaboratorController::class, 'editCompany']);
    Route::get('/list-company', [CompanyController::class, 'listCompany']);

    Route::post('/creating-category', [CollaboratorController::class, 'createdCategory']);
    Route::post('/deleting-category', [CollaboratorController::class, 'deleteCategory']);
    Route::post('/edit-category/editing', [CollaboratorController::class, 'editCategory']);
    Route::get('/list-all-category', [CategoryController::class, 'listAllCategory']);
    Route::get('/list-active-category', [CategoryController::class, 'listActiveCategory']);

    Route::post('/edit-mei/editing', [CollaboratorController::class, 'editMei']);
    Route::get('/list-mei', [MeiController::class, 'listMei']);




});


/**
 * Administrator Routes
 */
Route::group(['prefix' => 'administrator', 'middleware' => 'VerificaSeUsuarioLogado',  'middleware' => 'VerificaSeUsuarioAdministrador'], function () {

    /**
     * ROTAS
     */
    Route::get('/dashboard', [RoutesController::class, 'goDashboard']);

    Route::get('/company-create', [RoutesController::class, 'goCompanyCreate']);
    Route::get('/company-control', [RoutesController::class, 'goCompanyControl']);
    Route::get('/edit-company/{codhash}', [RoutesController::class, 'goCompanyEdit']);

    Route::get('/category-create', [RoutesController::class, 'goCategoryCreate']);
    Route::get('/category-control', [RoutesController::class, 'goCategoryControl']);
    Route::get('/edit-category/{codhash}', [RoutesController::class, 'goCategoryEdit']);

    Route::get('/mei-control', [RoutesController::class, 'goMeiControl']);
    Route::get('/edit-mei/{codhash}', [RoutesController::class, 'goMeiEdit']);

    /**
     * EXECUÇOES
     */
    Route::post('/creating-company', [AdministratorController::class, 'createdCompany']);
    Route::post('/deleting-company', [AdministratorController::class, 'deleteCompany']);
    Route::post('/edit-company/editing', [AdministratorController::class, 'editCompany']);
    Route::get('/list-company', [CompanyController::class, 'listCompany']);

    Route::post('/creating-category', [AdministratorController::class, 'createdCategory']);
    Route::post('/deleting-category', [AdministratorController::class, 'deleteCategory']);
    Route::post('/edit-category/editing', [AdministratorController::class, 'editCategory']);
    Route::get('/list-all-category', [CategoryController::class, 'listAllCategory']);
    Route::get('/list-active-category', [CategoryController::class, 'listActiveCategory']);

    Route::post('/edit-mei/editing', [AdministratorController::class, 'editMei']);
    Route::get('/list-mei', [MeiController::class, 'listMei']);

});


/**
 * VARIAVEIS GLOBAIS
 */
View::composer('*', function ($view) {

     $view->with('ACTIVE', 1);
     $view->with('PROFILE_COLLABORATOR', ProfileController::$PROFILE_COLLABORATOR);
     $view->with('PROFILE_ADMINISTRATOR', ProfileController::$PROFILE_ADMINISTRATOR);
 
     if (!empty(Session::get('user'))) {
         $view->with('PREFIX', strtolower(session()->get('user')[0]->profile->profile));
     }
 
 });
 
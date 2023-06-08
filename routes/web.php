<?php

use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\CollaboratorController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\GraphicController;
use App\Http\Controllers\InvoiceController;
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

    Route::get('/expense-create', [RoutesController::class, 'goExpenseCreate']);
    Route::get('/expense-control', [RoutesController::class, 'goExpenseControl']);
    Route::get('/edit-expense/{codhash}', [RoutesController::class, 'goExpenseEdit']);

    Route::get('/invoice-create', [RoutesController::class, 'goInvoiceCreate']);
    Route::get('/invoice-control', [RoutesController::class, 'goInvoiceControl']);
    Route::get('/edit-invoice/{codhash}', [RoutesController::class, 'goInvoiceEdit']);


    /**
     * EXECUÇOES
     */
    Route::post('/creating-company', [CollaboratorController::class, 'createdCompany']);
    Route::post('/deleting-company', [CollaboratorController::class, 'deleteCompany']);
    Route::post('/edit-company/editing', [CollaboratorController::class, 'editCompany']);
    Route::get('/list-company', [CompanyController::class, 'listCompany']);

    Route::post('/creating-category', [CollaboratorController::class, 'createdCategory']);
    Route::post('/disabling-category', [CollaboratorController::class, 'disableCategory']);
    Route::post('/edit-category/editing', [CollaboratorController::class, 'editCategory']);
    Route::get('/list-all-category', [CategoryController::class, 'listAllCategory']);
    Route::get('/list-active-category', [CategoryController::class, 'listActiveCategory']);

    Route::post('/edit-mei/editing', [CollaboratorController::class, 'editMei']);
    Route::get('/list-mei', [MeiController::class, 'listMei']);

    Route::post('/creating-expense', [CollaboratorController::class, 'createdExpense']);
    Route::post('/deleting-expense', [CollaboratorController::class, 'deleteExpense']);
    Route::post('/edit-expense/editing', [CollaboratorController::class, 'editExpense']);
    Route::get('/list-expense', [ExpenseController::class, 'listExpense']);

    Route::post('/creating-invoice', [CollaboratorController::class, 'createdInvoice']);
    Route::post('/deleting-invoice', [CollaboratorController::class, 'deleteInvoice']);
    Route::post('/edit-invoice/editing', [CollaboratorController::class, 'editInvoice']);
    Route::get('/list-invoice', [InvoiceController::class, 'listInvoice']);

    Route::get('/list-year-invoice', [GraphicController::class, 'listRegisteredInvoiceYears']);
    Route::get('/count-invoices-years/{year}', [GraphicController::class, 'countAllInvoicesByYears']);
    Route::get('/sum-value-invoices-years/{year}', [GraphicController::class, 'sumValueAllInvoicesByYears']);
    Route::get('/sum-value-expense-years/{year}', [GraphicController::class, 'sumValueAllExpenseByYears']);
    Route::get('/retrieve-available-billing-amount/{year}', [GraphicController::class, 'retrieveAvailableBillingAmount']);
    Route::get('/list-sum-month-invoice/{year}', [GraphicController::class, 'listSumMonthInvoiceByYear']);
    Route::get('/list-sum-month-expense/{year}', [GraphicController::class, 'listSumMonthExpenseByYear']);
    Route::get('/simple-balance-invoice-expense/{year}', [GraphicController::class, 'simpleBalanceInvoiceAndExpenseByYear']);
    Route::get('/sum-expenses-for-category/{year}', [GraphicController::class, 'sumExpensesCategoryByYear']);

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
    
    Route::get('/expense-create', [RoutesController::class, 'goExpenseCreate']);
    Route::get('/expense-control', [RoutesController::class, 'goExpenseControl']);
    Route::get('/edit-expense/{codhash}', [RoutesController::class, 'goExpenseEdit']);

    Route::get('/invoice-create', [RoutesController::class, 'goInvoiceCreate']);
    Route::get('/invoice-control', [RoutesController::class, 'goInvoiceControl']);
    Route::get('/edit-invoice/{codhash}', [RoutesController::class, 'goInvoiceEdit']);

    /**
     * EXECUÇOES
     */
    Route::post('/creating-company', [AdministratorController::class, 'createdCompany']);
    Route::post('/deleting-company', [AdministratorController::class, 'deleteCompany']);
    Route::post('/edit-company/editing', [AdministratorController::class, 'editCompany']);
    Route::get('/list-company', [CompanyController::class, 'listCompany']);

    Route::post('/creating-category', [AdministratorController::class, 'createdCategory']);
    Route::post('/disabling-category', [AdministratorController::class, 'disableCategory']);
    Route::post('/edit-category/editing', [AdministratorController::class, 'editCategory']);
    Route::get('/list-all-category', [CategoryController::class, 'listAllCategory']);
    Route::get('/list-active-category', [CategoryController::class, 'listActiveCategory']);

    Route::post('/edit-mei/editing', [AdministratorController::class, 'editMei']);
    Route::get('/list-mei', [MeiController::class, 'listMei']);

    Route::post('/creating-expense', [AdministratorController::class, 'createdExpense']);
    Route::post('/deleting-expense', [AdministratorController::class, 'deleteExpense']);
    Route::post('/edit-expense/editing', [AdministratorController::class, 'editExpense']);
    Route::get('/list-expense', [ExpenseController::class, 'listExpense']);

    Route::post('/creating-invoice', [AdministratorController::class, 'createdInvoice']);
    Route::post('/deleting-invoice', [AdministratorController::class, 'deleteInvoice']);
    Route::post('/edit-invoice/editing', [AdministratorController::class, 'editInvoice']);
    Route::get('/list-invoice', [InvoiceController::class, 'listInvoice']);

    Route::get('/list-year-invoice', [GraphicController::class, 'listRegisteredInvoiceYears']);
    Route::get('/count-invoices-years/{year}', [GraphicController::class, 'countAllInvoicesByYears']);
    Route::get('/sum-value-invoices-years/{year}', [GraphicController::class, 'sumValueAllInvoicesByYears']);
    Route::get('/sum-value-expense-years/{year}', [GraphicController::class, 'sumValueAllExpenseByYears']);
    Route::get('/retrieve-available-billing-amount/{year}', [GraphicController::class, 'retrieveAvailableBillingAmount']);
    Route::get('/list-sum-month-invoice/{year}', [GraphicController::class, 'listSumMonthInvoiceByYear']);
    Route::get('/list-sum-month-expense/{year}', [GraphicController::class, 'listSumMonthExpenseByYear']);
    Route::get('/simple-balance-invoice-expense/{year}', [GraphicController::class, 'simpleBalanceInvoiceAndExpenseByYear']);
    Route::get('/sum-expenses-for-category/{year}', [GraphicController::class, 'sumExpensesCategoryByYear']);

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
 
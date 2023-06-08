<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class RoutesController extends Controller
{

    public $companyController;
    public $categoryController;
    public $meiController;
    public $expenseController;
    public $invoiceController;
    public $graphicController;
    public $collaboratorController;
    public $administratorController;
    public $profileController;

    public function __construct()
    {
        $this->companyController = new CompanyController();    
        $this->categoryController = new CategoryController();    
        $this->meiController = new MeiController();    
        $this->expenseController = new ExpenseController();    
        $this->invoiceController = new InvoiceController(); 
        $this->graphicController = new GraphicController();
        $this->collaboratorController = new CollaboratorController();
        $this->administratorController = new AdministratorController();
        $this->profileController = new ProfileController();

    }

    public function logout()
    {
        session()->flush();
        return Redirect::to('/');
    }

    public function goLogin(){
        
        return view('login');
    }

    public function goDashboard(){
        
        $listRegisteredInvoiceYears = $this->graphicController->listRegisteredInvoiceYears();
        return view('dashboard', compact('listRegisteredInvoiceYears'));
    }


    public function goCompanyCreate(){
        return view('company-create');
    }

    public function goCompanyControl(){
        return view('company-control');
    }

    public function goCompanyEdit($codhash){

        $recoverCompanyDataByCodhash = $this->companyController->recoverCompanyDataByCodhash($codhash);
        return view('company-edit', compact('recoverCompanyDataByCodhash'));

    }


    public function goCategoryCreate(){
        return view('category-create');
    }

    public function goCategoryControl(){
        return view('category-control');
    }

    public function goCategoryEdit($codhash){

        $recoverCategoryDataByCodhash = $this->categoryController->recoverCategoryDataByCodhash($codhash);
        return view('category-edit', compact('recoverCategoryDataByCodhash'));
    }


    public function goMeiControl(){
        return view('mei-control');
    }

    public function goMeiEdit($codhash){

        $recoverMeiDataByCodhash = $this->meiController->recoverMeiDataByCodhash($codhash);
        return view('mei-edit', compact('recoverMeiDataByCodhash'));
    }

    
    public function goExpenseCreate(){
        $listCompany = $this->companyController->listCompany();
        $listActiveCategory = $this->categoryController->listActiveCategory();

        return view('expense-create', compact('listCompany', 'listActiveCategory'));
    }

    public function goExpenseControl(){
        return view('expense-control');
    }

    public function goExpenseEdit($codhash){

        $recoverExpenseDataByCodhash = $this->expenseController->recoverExpenseDataByCodhash($codhash);
        $listCompany = $this->companyController->listCompany();
        $listActiveCategory = $this->categoryController->listActiveCategory();

        return view('expense-edit', compact('recoverExpenseDataByCodhash', 'listCompany', 'listActiveCategory'));
    }


    public function goInvoiceCreate(){
        $listCompany = $this->companyController->listCompany();

        return view('invoice-create', compact('listCompany'));
    }

    public function goInvoiceControl(){
        return view('invoice-control');
    }

    public function goInvoiceEdit($codhash){

        $recoverInvoiceDataByCodhash = $this->invoiceController->recoverInvoiceDataByCodhash($codhash);
        $listCompany = $this->companyController->listCompany();
        $listActiveCategory = $this->categoryController->listActiveCategory();

        return view('invoice-edit', compact('recoverInvoiceDataByCodhash', 'listCompany', 'listActiveCategory'));
    }

    public function goUserEdit($codhash){


        $id_profile = Session::get('user')[0]->id_profile;

        if ($id_profile == profileController::$PROFILE_COLLABORATOR) {
            $recoverUserDataByCodhash = $this->collaboratorController->recoverUserDataByCodhash($codhash);
        } else if ($id_profile == profileController::$PROFILE_ADMINISTRATOR) {
            $recoverUserDataByCodhash = $this->administratorController->recoverUserDataByCodhash($codhash);
        } 
        $listProfile = $this->profileController->listProfile();

        return view('user-edit', compact('recoverUserDataByCodhash', 'listProfile'));
    }
}

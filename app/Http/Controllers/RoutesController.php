<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RoutesController extends Controller
{

    public $companyController;
    public $categoryController;
    public $meiController;


    public function __construct()
    {
        $this->companyController = new CompanyController();    
        $this->categoryController = new CategoryController();    
        $this->meiController = new MeiController();    
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
        
        return view('dashboard');
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

    
  /*  public function irCadastroNotaFiscal(){

        $listCompany = $this->companyController->listCompany();

        return view('registration-invoice', compact('listCompany'));
    }

    public function irControleNotaFiscal(){
        return view('controle-nota-fiscal');
    }

    public function irEditarNotaFiscal(){
        
        return view('editar-nota-fiscal');
    }
*/
}

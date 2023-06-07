<?php
namespace App\Http\Controllers;

use App\Http\Controllers\UsuarioController;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

abstract class EmployeeController extends UserController
{
    public function __construct()
    {
        
    }

    public function doLogin(Request $request): JsonResponse
    {

        /**
         * recover data logged user
         */ 
        $user = $this->recoverUserDataByEmail(trim($request->email));

        try{

           /**
           * Check there is user.
           */
           if(!$this->validateEmailAndPasswordLogin(trim($request->email), trim($request->password)))
           {
             throw new \Exception('Email e/ou senha inválida.');
           }

           /**
            * Check if user if active.
            */
            if(!$this->validateActiveUser(trim($request->email)))
            {
                throw new \Exception('Usuário não está ativo.');
            }

            /**
             * Add user data logged into the session
             */
            $request->session()->put('user', $user);

            /**
             * User Log
            */
            $this->logController->newLog($user[0]->id, LogController::$LOGAR, ' no sistema cujo id identificador é ' . $user[0]->id);

            
            return response()->json('Logado com sucesso!', 200);

        }catch(\Exception $e){
            return response()->json( $e->getMessage(), 400);
        }

    }


    /**
     * Function to create company
     * @param Request $request
     * @return JsonResponse
     */
    protected function createdCompany(Request $request) : JsonResponse
    {
        
        try
        {               
            //Chech if there is cnpj register in sistem 
            if($this->companyController->validateIfCnpjCompanyIsRegistered($request->cnpj))
            {
                throw new \Exception('CNPJ já cadastrado.');
            }

            //Register company in sistem
            $company = $this->companyController->newCompany($request->cnpj, $request->company, $request->business_name);

            /**
            * User log
            */
            $this->logController->newLog(session()->get('user')[0]->id, LogController::$CRIAR, ' uma nova Empresa no sistema cujo id identificador é ' . $company->id);

            return response()->json('Empresa foi criada com sucesso.', 200);

        }catch (\Exception $e){
            return response()->json($e->getMessage(), 400);
        }

    }


    /**
     * Function to edit Company
     * @param Request $request
     * @return JsonResponse
     */
    protected function editCompany(Request $request): JsonResponse
    {
        try{

            //validate if cnpj is already registered
            //validate if company is already registered
            //validate if business_name is already registered

            if($this->companyController->validateIfCNPJbelongsToAnotherCompany($request->cnpj, $request->codhash)){
                throw new \Exception("CNPJ " . substr($request->cnpj, 0, 10) . "*** já está registrado no sistema.");
            }

            if($this->companyController->validateIfCompanybelongsToAnotherCompany($request->company, $request->codhash)){
                throw new \Exception("Empresa " . substr($request->company, 0, 10) . "*** já está registrada no sistema.");
            }

            if($this->companyController->validateIfBusinesNamebelongsToAnotherCompany($request->business_name, $request->codhash)){
                throw new \Exception("A Razão Social " . substr($request->business_name, 0, 10) . "*** já está registrada no sistema.");
            }

            /**
             * update company
             */
            $company = $this->companyController->updateCompany($request->codhash, $request->cnpj, $request->company, $request->business_name);

            /**
             * User Log
             */
            $this->logController->newLog(session()->get('user')[0]->id, LogController::$ATUALIZAR, 'uma empresa no sistema cujo id identificador é ' . $this->companyController->recoverCompanyDataByCodhash($request->codhash)[0]->id);

            return (response()->json("Empresa foi atualizada com sucesso.", 200));

        }catch(\Exception $e){
            return (response()->json($e->getMessage(), 400));
        }
    }



    /**
     * Function to delete company
     * @param $request
     * @return JsonResponse
     */
    protected function deleteCompany(Request $request) : JsonResponse {

        try{

            //I can only exclude company if there is no link with the invoice
            if($this->invoiceController->checkIfThereisVinculationCompanyById( $this->companyController->recoverCompanyDataByCodhash($request->codhash))){
                throw new \Exception("Você não pode excluir uma empresa que está vinculada a uma nota fiscal.");
            }

            //I can only exclude company if there is no link with the expense
            if($this->expenseController->checkIfThereisVinculationCompanyById( $this->companyController->recoverCompanyDataByCodhash($request->codhash))){
                throw new \Exception("Você não pode excluir uma empresa que está vinculada a uma despesa.");
            }

            $this->companyController->deleteCompany($this->companyController->recoverIDByCodHashCompany($request->codhash));

            /**
            * Log de Usuário
            */
            $this->logController->newLog(session()->get('user')[0]->id, LogController::$EXCLUIR, ' uma Empresa no sistema');

            return response()->json('Empresa foi excluída com sucesso !', 200);

        }catch(\Exception $e){
            return response()->json($e->getMessage(), 400);
        }

    }



    /**
     * Function to create category
     * @param Request $request
     * @return JsonResponse
     */
    protected function createdCategory(Request $request) : JsonResponse
    {
        
        try
        {               
            //Chech if there is category register in system
            if($this->categoryController->validateIfCategoryIsRegistered($request->category))
            {
                throw new \Exception('Categoria já cadastrado, Ela pode está desativada');
            }

            //Register category in sistem
            $category = $this->categoryController->newCategory( $request->category, $request->description);

            /**
            * User log
            */
            $this->logController->newLog(session()->get('user')[0]->id, LogController::$CRIAR, ' uma nova Categoria no sistema cujo id identificador é ' . $category->id);

            return response()->json('Categoria foi criada com sucesso.', 200);

        }catch (\Exception $e){
            return response()->json($e->getMessage(), 400);
        }

    }

    /**
     * Function to edit Category
     * @param Request $request
     * @return JsonResponse
     */
    protected function editCategory(Request $request): JsonResponse
    {
        try{

            //validate if category is already registered

            if($this->categoryController->validateIfCategorybelongsToAnotherCategory($request->category, $request->codhash)){
                throw new \Exception("Categoria " . substr($request->category, 0, 10) . "*** já está registrado no sistema.");
            }

            /**
             * update category
             */
            $category = $this->categoryController->updateCategory($request->codhash, $request->category, $request->description, $request->active);

            /**
             * User Log
             */
            $this->logController->newLog(session()->get('user')[0]->id, LogController::$ATUALIZAR, 'uma Categoria no sistema cujo id identificador é ' . $this->categoryController->recoverCategoryDataByCodhash($request->codhash)[0]->id);

            return (response()->json("Categoria foi atualizada com sucesso.", 200));

        }catch(\Exception $e){
            return (response()->json($e->getMessage(), 400));
        }
    }

    /**
     * Function to edit Mei
     * @param Request $request
     * @return JsonResponse
     */
    protected function editMei(Request $request): JsonResponse
    {
        try{

            /**
             * update mei
             */
            $mei = $this->meiController->updateMei($request->codhash, $request->max_value);

            /**
             * User Log
             */
            $this->logController->newLog(session()->get('user')[0]->id, LogController::$ATUALIZAR, 'o valor máximo do MEI para ' . $request->max_value);

            return (response()->json("Valor máximo de MEI foi atualizada com sucesso.", 200));

        }catch(\Exception $e){
            return (response()->json($e->getMessage(), 400));
        }
    }

    /**
     * Função para cadastrar nota fiscal
     * @param Request $request
     * @return JsonResponse
     */
    protected function cadastrarNotaFiscal(Request $request) : JsonResponse
    {

        //valor do campo "mes_caixa" e "mes_competencia" da requisição
        $mesCaixa = $request->mes_caixa;
        $mesCompetencia = $request->mes_competencia;

        // Converte a string para uma data no formato adequado (AAAA-MM-01)
        $mesCompetenciadataFormatada = Carbon::createFromFormat('m/Y', $mesCompetencia)->format('Y-m-01');
        $mesCaixadataFormatada = Carbon::createFromFormat('m/Y', $mesCaixa)->format('Y-m-01');

        try
        {               
            //Verificar se a placa o cnpj está nop sistema
            if($this->notaFiscalController->validarSeNumeroNfestaCadastrado($request->cnpj))
            {
                throw new \Exception('Número já cadastrado.');
            }

            //Verificar se o mês de caixa é menos que o de competência
            if($mesCaixadataFormatada < $mesCompetenciadataFormatada)
            {
                throw new \Exception('O mês de caixa não pode ser antes do mês de competência');
            }

            //Cadastra empresa no sistema
            $notaFiscal = $this->notaFiscalController->novoNotaFiscal(session()->get('usuario')[0]->id, $request->id_empresa, $request->numero, $request->valor, $mesCompetenciadataFormatada, $mesCaixadataFormatada);

            /**
            * Log de Usuário
            */
            $this->logController->gravarLog(session()->get('usuario')[0]->id, LogController::$CRIAR, ' uma nova Nota Fiscal no sistema cujo id identificador é ' . $notaFiscal->id);

            return response()->json('Nota fiscal foi cadastrada com sucesso.', 200);

        }catch (\Exception $e){
            return response()->json($e->getMessage(), 400);
        }

    }


    /**
     * Função para excluir nota fiscal
     * @param $request
     * @return JsonResponse
     */
    protected function excluirNotaFiscal(Request $request) : JsonResponse {

        try{

            $this->notaFiscalController->excluirNotaFiscal($this->notaFiscalController->recuperarIDPeloCodHashNotaFiscal($request->codhash));

            /**
            * Log de Usuário
            */
            $this->logController->gravarLog(session()->get('usuario')[0]->id, LogController::$EXCLUIR, ' uma Nota Fiscal no sistema');

            return response()->json('Nota Fiscal foi excluída com sucesso !', 200);

        }catch(\Exception $e){
            return response()->json($e->getMessage(), 400);
        }

    }
}

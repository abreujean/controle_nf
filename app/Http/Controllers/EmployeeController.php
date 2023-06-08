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
            if($this->invoiceController->checkIfThereisVinculationCompanyById( $this->companyController->recoverIDByCodHashCompany($request->codhash))){
                throw new \Exception("Você não pode excluir uma empresa que está vinculada a uma nota fiscal.");
            }

            //I can only exclude company if there is no link with the expense
            if($this->expenseController->checkIfThereisVinculationCompanyById( $this->companyController->recoverIDByCodHashCompany($request->codhash))){
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
     * Function to disable Category
     * @param $request
     * @return JsonResponse
     */
    protected function disableCategory(Request $request) : JsonResponse {

        try{

            //I can only exclude Category if there is no link with the category
            if($this->expenseController->checkIfThereisVinculationCategoryById( $this->categoryController->recoverIDByCodHashCategory($request->codhash))){
                throw new \Exception("Você não pode desativar uma categoria que está vinculada a uma despesa.");
            }

            $this->categoryController->disableCategory($this->categoryController->recoverIDByCodHashCategory($request->codhash));

            /**
            * Log de Usuário
            */
            $this->logController->newLog(session()->get('user')[0]->id, LogController::$DESABILITAR, ' uma Categoria no sistema');

            return response()->json('Categoria foi desabilitada com sucesso !', 200);

        }catch(\Exception $e){
            return response()->json($e->getMessage(), 400);
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
     * Function to create expense
     * @param Request $request
     * @return JsonResponse
     */
    protected function createdExpense(Request $request) : JsonResponse
    {
        
        try
        {               
            //Chech if there is expense register in system
            /*if($this->expenseController->validateIfExpenseIsRegistered($request->expense))
            {
                throw new \Exception('Despesa já cadastrada!');
            }*/


            //Register expense in system
            $expense = $this->expenseController->newExpense( session()->get('user')[0]->id, $request->id_company, $request->id_category, $request->value, $request->expense, date('Y-m-d', strtotime(str_replace('/', '-', $request->competition_date))) , date('Y-m-d', strtotime(str_replace('/', '-', $request->receipt_date))));

            /**
            * User log
            */
            $this->logController->newLog(session()->get('user')[0]->id, LogController::$CRIAR, ' uma nova Despesa no sistema cujo id identificador é ' . $expense->id);

            return response()->json('Despesa foi criada com sucesso.', 200);

        }catch (\Exception $e){
            return response()->json($e->getMessage(), 400);
        }

    }

    /**
     * Function to edit expense
     * @param Request $request
     * @return JsonResponse
     */
    protected function editExpense(Request $request): JsonResponse
    {
        try{

            //validate if expense is already registered

            /*if($this->expenseController->validateIfExpensebelongsToAnotherExpense($request->expense, $request->codhash)){
                throw new \Exception("Despesa " . substr($request->expense, 0, 10) . "*** já está registrado no sistema.");
            }*/

            /**
             * update expense
             */
            $expense = $this->expenseController->updateExpense($request->codhash, $request->id_company, $request->id_category, $request->value, $request->expense, date('Y-m-d', strtotime(str_replace('/', '-', $request->competition_date))) , date('Y-m-d', strtotime(str_replace('/', '-', $request->receipt_date))));

            /**
             * User Log
             */
            $this->logController->newLog(session()->get('user')[0]->id, LogController::$ATUALIZAR, 'uma Despesa no sistema cujo id identificador é ' . $this->expenseController->recoverExpenseDataByCodhash($request->codhash)[0]->id);

            return (response()->json("Despesa foi atualizada com sucesso.", 200));

        }catch(\Exception $e){
            return (response()->json($e->getMessage(), 400));
        }
    }

    /**
     * Function to delete expense
     * @param $request
     * @return JsonResponse
     */
    protected function deleteExpense(Request $request) : JsonResponse {

        try{

            $this->expenseController->deleteExpense($this->expenseController->recoverIDByCodHashExpense($request->codhash));

            /**
            * Log de Usuário
            */
            $this->logController->newLog(session()->get('user')[0]->id, LogController::$EXCLUIR, ' uma Despesa no sistema');

            return response()->json('Despesa foi excluída com sucesso!', 200);

        }catch(\Exception $e){
            return response()->json($e->getMessage(), 400);
        }

    }


    /**
     * Function to create invoice
     * @param Request $request
     * @return JsonResponse
     */
    protected function createdInvoice(Request $request) : JsonResponse
    {
        
        try
        {               
            //Chech if there is invoice register in system
            if($this->invoiceController->validateIfNumberInvoiceIsRegistered($request->number))
            {
                throw new \Exception('Número da Nota Fiscal já cadastrada!');
            }


            //Register invoice in system
            $invoice = $this->invoiceController->newInvoice( session()->get('user')[0]->id, $request->id_company, $request->number, $request->value, Carbon::createFromFormat('m/Y', $request->month_competency)->format('Y-m-01') , date('Y-m-d', strtotime(str_replace('/', '-', $request->receipt_date))));

            /**
            * User log
            */
            $this->logController->newLog(session()->get('user')[0]->id, LogController::$CRIAR, ' uma nova Nota Fical no sistema cujo id identificador é ' . $invoice->id);

            return response()->json('Nota Fiscal foi cadastrada com sucesso.', 200);

        }catch (\Exception $e){
            return response()->json($e->getMessage(), 400);
        }

    }


    /**
     * Function to edit invoice
     * @param Request $request
     * @return JsonResponse
     */
    protected function editInvoice(Request $request): JsonResponse
    {
        try{

            //validate if invoice is already registered

            if($this->invoiceController->validateIfNumberInvoicebelongsToAnotherInvoice($request->invoice, $request->codhash)){
                throw new \Exception("Nota " . substr($request->invoice, 0, 10) . "*** já está registrada no sistema.");
            }

            /**
             * update invoice
             */
            $invoice = $this->invoiceController->updateInvoice($request->codhash, $request->id_company, $request->number,  $request->value, Carbon::createFromFormat('m/Y', $request->month_competency)->format('Y-m-01') , date('Y-m-d', strtotime(str_replace('/', '-', $request->receipt_date))));

            /**
             * User Log
             */
            $this->logController->newLog(session()->get('user')[0]->id, LogController::$ATUALIZAR, 'uma Nota Fiscal no sistema cujo id identificador é ' . $this->invoiceController->recoverInvoiceDataByCodhash($request->codhash)[0]->id);

            return (response()->json("Nota Fiscal foi atualizada com sucesso.", 200));

        }catch(\Exception $e){
            return (response()->json($e->getMessage(), 400));
        }
    }



    /**
     * Function to delete invoice
     * @param $request
     * @return JsonResponse
     */
    protected function deleteInvoice(Request $request) : JsonResponse {

        try{

            $this->invoiceController->deleteInvoice($this->invoiceController->recoverIDByCodHashInvoice($request->codhash));

            /**
            * Log de Usuário
            */
            $this->logController->newLog(session()->get('user')[0]->id, LogController::$EXCLUIR, ' uma Nota Fiscal no sistema');

            return response()->json('Nota Fiscal foi excluída com sucesso!', 200);

        }catch(\Exception $e){
            return response()->json($e->getMessage(), 400);
        }

    }
    
}

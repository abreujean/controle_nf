<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class ExpenseController extends Controller
{
    /**
     * Function to check if there is a record in expense linked to the company
     */
    public function checkIfThereisVinculationCompanyById($id_company) : bool {
        $value = Expense::where('id_company', $id_company)->get();
        return $value->count() >= 1 ? true : false;
    }

    /**
     * Function to check if there is a record in expense linked to the category
     */
    public function checkIfThereisVinculationCategoryById($id_category) : bool {
        $value = Expense::where('id_category', $id_category)->get();
        return $value->count() >= 1 ? true : false;
    }

    /**
    * Function to register new Expense
    * @param 
    * @return object
    */
   public function newExpense($id_user, $id_company, $id_category, $value, $expense, $competition_date, $receipt_date): object
   {
       $expense = Expense::create([
           'id_user' => $id_user,
           'id_company' => $id_company,
           'id_category' => $id_category,
           'value' => $value,
           'expense' => $expense,
           'competition_date' => $competition_date,
           'receipt_date' => $receipt_date,
           'codhash' => Uuid::uuid4(),
       ]);

       return $expense;
   }


   /**
    * Function to check there is registration of expense
    * @param placa
    * @return boolean
    */
   public function validateIfExpenseIsRegistered($expense): bool
   {
       $expense = Expense::where('expense', $expense)->get();
       return isset($expense[0]->expense) ? true : false;
   }

   /**
    * Function to list expense in system
    * @return JsonResponse
    */
   public function listExpense(): object
   {
       $expense = Expense::with('category', 'company')->get();
       return $expense;
   }

   /**
    * Function to retrieve expense id by codhash
    * @param placa
    * @return boolean
    */
   public function recoverIDByCodHashExpense($codhash): int
   {
       $expense = Expense::where('codhash', $codhash)->get();
       return $expense[0]->id;
   }


   /**
    * Função para excluir expense
    * @param $id
    * @return void
    */
   public function deleteExpense($id) : void {
       Expense::where(['id' => $id])->delete();
   }


   /**
    * Function to retrieve expense data.
    * @param $codhash
    * @return object
    */
   public function recoverExpenseDataByCodhash($codhash) : object
   {
       $expense = Expense::where('codhash', $codhash)->get();
       return $expense;
   }


   /**
    * Function to validate if expense belongs to another expense.
    * @param $expense
    * @param $codhash
    */
   public function validateIfExpensebelongsToAnotherExpense($expense, $codhash) : bool {
       $value = Expense::where('expense', $expense)->where('codhash', '!=', $codhash)->get();
       return isset($value[0]->expense) ? true : false;
   }


   /**
    * Function to update expense data.
    */
   public function updateExpense($codhash, $id_company, $id_category, $value, $expense, $competition_date, $receipt_date  ) : void
   {
       Expense::where('codhash', $codhash)
               ->update([
                         'id_company' => $id_company,
                         'id_category' => $id_category,
                         'value' => $value,
                         'expense' => $expense,
                         'competition_date' => $competition_date,
                         'receipt_date' => $receipt_date,
                       ]);
   }
}
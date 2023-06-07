<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Function to check if there is a record in expense linked to the company
     */
    public function checkIfThereisVinculationCompanyById($id_company) : bool {
        $value = Expense::where('id_company', $id_company)->get();
        return $value->count() >= 1 ? true : false;
    }
}

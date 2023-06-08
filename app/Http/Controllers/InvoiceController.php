<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class InvoiceController extends Controller
{
    /**
     * Function to check if there is a record in invoice linked to the company
     */
    public function checkIfThereisVinculationCompanyById($id_company) : bool {
        $value = Invoice::where('id_company', $id_company)->get();
        return $value->count() >= 1 ? true : false;
    }


    /**
    * Function to register new invoice
    * @param 
    * @return object
    */
    public function newInvoice($id_user, $id_company, $number, $value, $month_competency, $receipt_date): object
    {
        $invoice = Invoice::create([
            'id_user' => $id_user,
            'id_company' => $id_company,
            'number' => $number,
            'value' => $value,
            'month_competency' => $month_competency,
            'receipt_date' => $receipt_date,
            'codhash' => Uuid::uuid4(),
        ]);
 
        return $invoice;
    }
 
 
    /**
     * Function to check there is registration of number invoice
     * @param placa
     * @return boolean
     */
    public function validateIfNumberInvoiceIsRegistered($number): bool
    {
        $invoice = Invoice::where('number', $number)->get();
        return isset($invoice[0]->number) ? true : false;
    }
 
    /**
     * Function to list invoice in system
     * @return JsonResponse
     */
    public function listInvoice(): object
    {
        $invoice = Invoice::with('company')->get();
 
        return $invoice;
    }
 
    /**
     * Function to retrieve invoice id by codhash
     * @param placa
     * @return boolean
     */
    public function recoverIDByCodHashInvoice($codhash): int
    {
        $invoice = Invoice::where('codhash', $codhash)->get();
        return $invoice[0]->id;
    }
 
 
    /**
     * Função para excluir invoice
     * @param $id
     * @return void
     */
    public function deleteInvoice($id) : void {
        Invoice::where(['id' => $id])->delete();
    }
 
 
    /**
     * Function to retrieve Invoice data.
     * @param $codhash
     * @return object
     */
    public function recoverInvoiceDataByCodhash($codhash) : object
    {
        $invoice = Invoice::where('codhash', $codhash)->get();
        return $invoice;
    }
 
 
    /**
     * Function to validate if Number invoice belongs to another invoice.
     * @param $invoice
     * @param $codhash
     */
    public function validateIfNumberInvoicebelongsToAnotherInvoice($number, $codhash) : bool {
        $value = Invoice::where('number', $number)->where('codhash', '!=', $codhash)->get();
        return isset($value[0]->number) ? true : false;
    }
 
 
    /**
     * Function to update invoice data.
     */
    public function updateInvoice($codhash, $id_company, $number, $value, $month_competency, $receipt_date) : void
    {
        Invoice::where('codhash', $codhash)
                ->update([
                          'id_company' => $id_company,
                          'number' => $number,
                          'value' => $value,
                          'month_competency' => $month_competency,
                          'receipt_date' => $receipt_date,
                        ]);
    }

}

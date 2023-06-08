<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GraphicController extends Controller
{
    public $meiController;

    public function __construct()
    {
        $this->meiController = new MeiController();
    }

    public function listRegisteredInvoiceYears(){
        $result = DB::select('SELECT YEAR(receipt_date) AS year FROM invoice GROUP BY YEAR(receipt_date);');
        return $result;
    }

    public function countAllInvoicesByYears($year){
        $result = Invoice::whereYear('receipt_date', $year)->count();
        return $result;
    }

    public function sumValueAllInvoicesByYears($year){
        $result = Invoice::whereYear('receipt_date', $year)->sum('value');
        return $result;
    }

    public function sumValueAllExpenseByYears($year){
        $result = Expense::whereYear('receipt_date', $year)->sum('value');
        return $result;
    }

    public function retrieveAvailableBillingAmount($year)
    {
        $result = floatval($this->meiController->recoverMaxValueMeiData()) - $this->sumValueAllInvoicesByYears($year);
        return $result;
    }

    public function listSumMonthInvoiceByYear($year)
    {
        $result = DB::select("
                SELECT COALESCE(SUM(CONVERT(REPLACE(invoice.value, ',', '.'), DECIMAL(10, 2))), 0) AS total
                FROM (
                SELECT 1 AS month_number UNION ALL
                SELECT 2 AS month_number UNION ALL
                SELECT 3 AS month_number UNION ALL
                SELECT 4 AS month_number UNION ALL
                SELECT 5 AS month_number UNION ALL
                SELECT 6 AS month_number UNION ALL
                SELECT 7 AS month_number UNION ALL
                SELECT 8 AS month_number UNION ALL
                SELECT 9 AS month_number UNION ALL
                SELECT 10 AS month_number UNION ALL
                SELECT 11 AS month_number UNION ALL
                SELECT 12 AS month_number
                ) AS months
                LEFT JOIN invoice ON MONTH(invoice.receipt_date) = months.month_number AND YEAR(invoice.receipt_date) = " . $year ."
                GROUP BY months.month_number
            ");

        return $result;
    }

    public function listSumMonthExpenseByYear($year)
    {
        $result = DB::select("
                SELECT COALESCE(SUM(CONVERT(REPLACE(expense.value, ',', '.'), DECIMAL(10, 2))), 0) AS total
                FROM (
                SELECT 1 AS month_number UNION ALL
                SELECT 2 AS month_number UNION ALL
                SELECT 3 AS month_number UNION ALL
                SELECT 4 AS month_number UNION ALL
                SELECT 5 AS month_number UNION ALL
                SELECT 6 AS month_number UNION ALL
                SELECT 7 AS month_number UNION ALL
                SELECT 8 AS month_number UNION ALL
                SELECT 9 AS month_number UNION ALL
                SELECT 10 AS month_number UNION ALL
                SELECT 11 AS month_number UNION ALL
                SELECT 12 AS month_number
                ) AS months
                LEFT JOIN expense ON MONTH(expense.receipt_date) = months.month_number AND YEAR(expense.receipt_date) = " . $year ."
                GROUP BY months.month_number
            ");

        return $result;
    }

    public function simpleBalanceInvoiceAndExpenseByYear($year)
    {
        $result = DB::select("
                    SELECT COALESCE(SUM(CONVERT(REPLACE(invoice.value, ',', '.'), DECIMAL(10, 2))), 0) - COALESCE(SUM(CONVERT(REPLACE(expense.value, ',', '.'), DECIMAL(10, 2))), 0) AS total
                    FROM (
                    SELECT 1 AS month_number UNION ALL
                    SELECT 2 AS month_number UNION ALL
                    SELECT 3 AS month_number UNION ALL
                    SELECT 4 AS month_number UNION ALL
                    SELECT 5 AS month_number UNION ALL
                    SELECT 6 AS month_number UNION ALL
                    SELECT 7 AS month_number UNION ALL
                    SELECT 8 AS month_number UNION ALL
                    SELECT 9 AS month_number UNION ALL
                    SELECT 10 AS month_number UNION ALL
                    SELECT 11 AS month_number UNION ALL
                    SELECT 12 AS month_number
                    ) AS months
                    LEFT JOIN invoice ON MONTH(invoice.receipt_date) = months.month_number AND YEAR(invoice.receipt_date) = ". $year ."
                    LEFT JOIN expense ON MONTH(expense.receipt_date) = months.month_number AND YEAR(expense.receipt_date) = ". $year ."
                    GROUP BY months.month_number
                ");

        return $result;
    }

    public function sumExpensesCategoryByYear($year)
    {
            $result = DB::select("
                SELECT c.category, COALESCE(SUM(CONVERT(REPLACE(e.value, ',', '.'), DECIMAL(10, 2))), 0) AS total
                FROM expense e
                INNER JOIN category c ON e.id_category = c.id
                WHERE YEAR(e.receipt_date) = ". $year ."
                GROUP BY c.category;
            ");

        return $result;
    }
}

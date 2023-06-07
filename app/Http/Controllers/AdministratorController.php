<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdministratorController extends EmployeeController
{
    public $logController;
    public $companyController;
    public $invoiceController;
    public $expenseController;
    public $categoryController;
    public $meiController;

    public function __construct()
    {
        $this->logController = new LogController();
        $this->companyController = new CompanyController();
        $this->invoiceController = new InvoiceController();
        $this->expenseController = new ExpenseController();
        $this->categoryController = new CategoryController();
        $this->meiController = new MeiController();
    }
}

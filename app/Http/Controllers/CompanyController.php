<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class CompanyController extends Controller
{
    /**
     * Function to register new Company
     * @param 
     * @return object
     */
    public function newCompany($cnpj, $company, $business_name): object
    {
        $company = Company::create([
            'cnpj' => $cnpj,
            'company' => $company,
            'business_name' => $business_name,
            'codhash' => Uuid::uuid4(),
        ]);

        return $company;
    }


    /**
     * Function to check there is registration of cnpj
     * @param placa
     * @return boolean
     */
    public function validateIfCnpjCompanyIsRegistered($cnpj): bool
    {
        $company = Company::where('cnpj', $cnpj)->get();
        return isset($company[0]->cnpj) ? true : false;
    }

    /**
     * Function to list company in system
     * @return JsonResponse
     */
    public function listCompany(): object
    {
        $company = Company::all();
        return $company;
    }


    /**
     * Function to retrieve company id by codhash
     * @param placa
     * @return boolean
     */
    public function recoverIDByCodHashCompany($codhash): int
    {
        $company = Company::where('codhash', $codhash)->get();
        return $company[0]->id;
    }


    /**
     * Função para excluir company
     * @param $id_company
     * @return void
     */
    public function deleteCompany($id) : void {
        Company::where(['id' => $id])->delete();
    }


    /**
     * Function to retrieve company data.
     * @param $codhash
     * @return object
     */
    public function recoverCompanyDataByCodhash($codhash) : object
    {
        $company = Company::where('codhash', $codhash)->get();
        return $company;
    }


    /**
     * Function to validate if cnpj belongs to another company.
     * @param $cnpj
     * @param $codhash
     */
    public function validateIfCNPJbelongsToAnotherCompany($cnpj, $codhash) : bool {
        $value = Company::where('cnpj', $cnpj)->where('codhash', '!=', $codhash)->get();
        return isset($value[0]->cnpj) ? true : false;
    }

    /**
     * Function to validate if company belongs to another company.
     * @param $company
     * @param $codhash
     */
    public function validateIfCompanybelongsToAnotherCompany($company, $codhash) : bool {
        $value = Company::where('company', $company)->where('codhash', '!=', $codhash)->get();
        return isset($value[0]->company) ? true : false;
    }

    /**
     * Function to validate if business_name belongs to another company.
     * @param $business_name
     * @param $codhash
     */
    public function validateIfBusinesNamebelongsToAnotherCompany($business_name, $codhash) : bool {
        $value = Company::where('business_name', $business_name)->where('codhash', '!=', $codhash)->get();
        return isset($value[0]->business_name) ? true : false;
    }


    /**
     * Function to update company data.
     */
    public function updateCompany($codhash, $cnpj, $company, $business_name ) : void
    {
        Company::where('codhash', $codhash)
                ->update(['cnpj' => $cnpj,
                          'company' => $company,
                          'business_name' => $business_name,
                        ]);
    }
}

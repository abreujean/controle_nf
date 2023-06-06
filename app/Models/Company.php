<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    /**
     * Table
     *
     * @var string
     */
    protected $table = 'company';

    protected $fillable = ['id', 'cnpj', 'company', 'business_name', 'codhash'];

    public function invoices(){
        return $this->hasMany(Ivoices::class, 'id_user');
    }

    public function expenses(){
        return $this->hasMany(Expense::class, 'id_company');
    }
}

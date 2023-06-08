<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    /**
     * Table 
     *
     * @var string
     */
    protected $table = 'expense';

    protected $fillable = ['id', 'id_user', 'id_company', 'id_category', 'value', 'expense', 'competition_date', 'receipt_date', 'codhash'];

    public function user(){
        return $this->belongsTo(User::class, 'id_user');
    }

    public function company(){
        return $this->belongsTo(Company::class, 'id_company');
    }

    public function category(){
        return $this->belongsTo(Category::class, 'id_category');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    /**
     * Tabela associada a esse modelo.
     *
     * @var string
     */
    protected $table = 'invoice';

    protected $fillable = ['id', 'id_user', 'id_company', 'number', 'value', 'month_competency', 'receipt_date', 'codhash'];

    public function user(){
        return $this->belongsTo(User::class, 'id_user');
    }

    public function company(){
        return $this->belongsTo(Company::class, 'id_company');
    }

}

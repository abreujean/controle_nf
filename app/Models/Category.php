<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * Table 
     *
     * @var string
     */
    protected $table = 'category';

    protected $fillable = ['id', 'category', 'description', 'active', 'codhash'];

    public function expenses(){
        return $this->hasMany(Expense::class, 'id_category');
    }
}

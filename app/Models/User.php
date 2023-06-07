<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\CssSelector\Exception\ExpressionErrorException;

class User extends Model
{
    use HasFactory;

    /**
     * Tabela associada a esse modelo.
     *
     * @var string
     */
    protected $table = 'user';

    protected $fillable = ['id', 'id_profile', 'name', 'email', 'password', 'phone', 'alert', 'active', 'codhash'];

    public function profile(){
        return $this->belongsTo(Profile::class, 'id_profile');
    }

    public function log_users(){
        return $this->hasMany(LogUser::class, 'id_user');
    }

    public function invoices(){
        return $this->hasMany(Invoice::class, 'id_user');
    }

    public function expenses(){
        return $this->hasMany(Expense::class, 'id_user');
    }
}

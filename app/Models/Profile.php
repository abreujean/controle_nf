<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    use HasFactory;

    /**
     * Table
     *
     * @var string
     */
    protected $table = 'profile';

    /**
     * Atributos
     */
    protected $fillable = ['id', 'profile'];

    public function users(){
        return $this->hasMany(User::class, 'id_profile');
    }

}

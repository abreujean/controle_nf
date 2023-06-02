<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    use HasFactory;

    /**
     * Tabela associada a esse modelo.
     *
     * @var string
     */
    protected $table = 'perfil';

    /**
     * Atributos
     */
    protected $fillable = ['id', 'perfil'];

    public function usuarios(){
        return $this->hasMany(Usuario::class, 'id_perfil');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    /**
     * Tabela associada a esse modelo.
     *
     * @var string
     */
    protected $table = 'empresa';

    protected $fillable = ['id', 'cnpj', 'nome_fantasia', 'razao_social', 'codigo_cnae', 'codhash'];

    public function nota_ficais(){
        return $this->hasMany(NotaFiscal::class, 'id_usuario');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotaFiscal extends Model
{
    use HasFactory;

    /**
     * Tabela associada a esse modelo.
     *
     * @var string
     */
    protected $table = 'nota_fiscal';

    protected $fillable = ['id', 'id_usuario', 'id_empresa', 'numero', 'valor', 'mes_competencia', 'mes_caixa'];

    public function usuario(){
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    public function empresa(){
        return $this->belongsTo(Empresa::class, 'id_empresa');
    }

}

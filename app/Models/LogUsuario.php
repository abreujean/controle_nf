<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogUsuario extends Model
{
    use HasFactory;

    /**
     * Tabela associada a esse modelo.
     *
     * @var string
     */
    protected $table = 'log_usuario';

    protected $fillable = ['id', 'id_usuario', 'tipo_evento', 'evento', 'codhash'];

    public function usuario(){
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }
}

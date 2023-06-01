<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'id_perfil', 'nome_completo', 'email', 'senha', 'ativo', 'codhash'];

    public function perfil(){
        return $this->belongsTo(Perfil::class, 'id_perfil');
    }

    public function log_usuarios(){
        return $this->hasMany(LogUsuario::class, 'id_usuario');
    }

    public function nota_ficais(){
        return $this->hasMany(NotaFiscal::class, 'id_usuario');
    }
}

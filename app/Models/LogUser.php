<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogUsuario extends Model
{
    use HasFactory;

    /**
     * Table
     *
     * @var string
     */
    protected $table = 'log_user';

    protected $fillable = ['id', 'id_user', 'event_type', 'event', 'codhash'];

    public function user(){
        return $this->belongsTo(User::class, 'id_user');
    }
}

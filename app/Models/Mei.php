<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mei extends Model
{
    use HasFactory;

    /**
     * Table
     *
     * @var string
     */
    protected $table = 'mei';

    /**
     * Attributes
     */
    protected $fillable = ['id', 'max_value', 'codhash'];
}

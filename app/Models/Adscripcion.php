<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adscripcion extends Model
{
    protected $table = 'adscripcion';
    protected $primaryKey = 'id_adscripcion';
    protected $fillable = [
        'descripcion',
        'lugar'
    ];
}

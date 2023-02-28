<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{
    protected $table = 'bitacora';
    protected $primaryKey = 'id_bitacora';
    protected $casts = ['created_at' => 'datetime:d-m-Y ']; 
    protected $fillable = [
        'descripcion'
    ];
}

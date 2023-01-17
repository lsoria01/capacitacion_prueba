<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Institucion extends Model
{
    protected $table = 'institucion';
    protected $primaryKey = 'id_institucion';
    protected $fillable = [
        'descripcion'
    ];
}

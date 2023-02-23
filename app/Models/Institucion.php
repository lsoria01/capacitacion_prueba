<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Institucion extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'institucion';
    protected $primaryKey = 'id_institucion';
    protected $fillable = [
        'descripcion'
    ];
}

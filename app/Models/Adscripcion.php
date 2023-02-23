<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Adscripcion extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'adscripcion';
    protected $primaryKey = 'id_adscripcion';
    protected $fillable = [
        'descripcion',
        'lugar'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estatus extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'estatus';
    protected $primaryKey = 'id_estatus';
    protected $fillable = [
        'nombre'
    ];
}

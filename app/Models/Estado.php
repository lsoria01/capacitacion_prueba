<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estado extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'estado';
    protected $primaryKey = 'id_estado';
    protected $fillable = [
        'nombre'
    ];
}

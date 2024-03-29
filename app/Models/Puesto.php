<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Puesto extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'puesto';
    protected $primaryKey = 'id_puesto';
    protected $fillable = [
        'descripcion'
    ];
}

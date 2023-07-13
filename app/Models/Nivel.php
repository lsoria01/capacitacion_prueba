<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nivel extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'niveles';
    protected $fillable = [
        'nomenclatura',
        'nombre'
    ];
}

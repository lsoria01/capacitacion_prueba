<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Calificacion extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'calificacion';
    protected $primaryKey = 'id_calificacion';
    protected $fillable = [
        'empleado',
        'curso',
        'calif',
        'hrsCap',
        'fecha',
        'anio'
    ];
}

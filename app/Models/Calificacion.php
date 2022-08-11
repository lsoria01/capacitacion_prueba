<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model
{
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

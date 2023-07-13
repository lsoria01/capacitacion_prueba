<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empleado extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'empleados';
    protected $fillable = [
        'num_empleado',
        'persona_id',
        'fecha_ingr',
        'nivel_id',
        'puesto_id',
        'adscripcion_id',
        'estado_id',
        'ciudad_adscripcion',
        'empleado_id'
    ];
}

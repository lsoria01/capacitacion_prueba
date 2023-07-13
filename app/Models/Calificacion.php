<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Calificacion extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'calificaciones';
    protected $fillable = [
        'usuario_id',
        'curso_id',
        'curso_fin',
        'aprobado',
        'calif',
        'fecha',
        'anio',
        'url_constancia',
        'estatus_id'
    ];
}

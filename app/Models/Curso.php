<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Curso extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'cursos';
    protected $fillable = [
        'nombre',
        'fecha_inicio',
        'fecha_fin',
        'curso_oblig',
        'hrs_cap',
        'curso_int_ext',
        'difundido_DP',
        'modalidad',
        'estatus_id',
        'institucion_id',
        'identificador_curso'
    ];
}

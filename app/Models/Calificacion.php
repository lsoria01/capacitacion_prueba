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
        'id_user',
        'id_curso',
        'cursoFin',
        'aprobado',
        'calif',
        'fecha',
        'anio',
        'id_institucion',
        'urlConstancia',
        'id_estatus'
    ];
}

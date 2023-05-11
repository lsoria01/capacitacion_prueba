<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Curso extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'curso';
    protected $primaryKey = 'id_curso';
    protected $fillable = [
        'nombre',
        'fecha_inicio',
        'fecha_fin',
        'cursoOblig',
        'hrsCap',
        'cursoIntExt',
        'difundidoDP',
        'modalidad',
        'id_estatus',
        'id_institucion',
        'folio'
    ];
}

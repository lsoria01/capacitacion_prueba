<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GradoEstudio extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'gradoEst';
    protected $primaryKey = 'id_gradoEst';
    protected $fillable = [
        'nombre'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nombramiento extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'nombramiento';
    protected $primaryKey = 'id_nombramiento';
    protected $fillable = [
        'empleado',
        'tipo',
        'fecEmis',
        'fecRatif'
    ];
}

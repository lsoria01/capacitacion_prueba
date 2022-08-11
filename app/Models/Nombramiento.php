<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nombramiento extends Model
{
    protected $table = 'nombramiento';
    protected $primaryKey = 'id_nombramiento';
    protected $fillable = [
        'empleado',
        'tipo',
        'fecEmis',
        'fecRatif'
    ];
}

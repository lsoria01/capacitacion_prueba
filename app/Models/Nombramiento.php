<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nombramiento extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'nombramientos';
    protected $fillable = [
        'usuario_id',
        'tipo',
        'fec_emis',
        'fec_ratif'
    ];
}

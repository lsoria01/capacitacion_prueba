<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuarios';
    protected $fillable = [
        'correo',
        'email'
    ];

    public function Persona()
	{
			return $this->belongsto( 'App\Models\Persona' , 'persona_id', 'id');
	}
}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Persona;
use Illuminate\Http\Request;
use App\Mail\Correo;
use Mail;

class CorreoController extends Controller
{
    public function getMail(Request $request){
        
        $data = array(
            'ruta' => $ruta = \URL::to('/'),
            'nombreCompleto' => $request->nombreCompleto,
            'curp' => $request->curp,
            'password' => $request->password,
            'usuario' => $request->usuario,
            'indicio' => $request->indicio,
            'correo' => $request->correo
        );
            
        /* Mail::to('luis.soria@centrolaboral.gob.mx')->send(new Correo($data)); */
        Mail::to($request->correo)->send(new Correo($data));
    }
}


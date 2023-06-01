<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\Correo;
use Mail;

class CorreoController extends Controller
{
    public function getMail(Request $request){
        
        $data = array(
            'email' => 'Hola'
            );

        Mail::to('luis.soria@centrolaboral.gob.mx')->send(new Correo($data));
        /* Mail::to($request->email)->send(new Correo($data)); */
    }
}

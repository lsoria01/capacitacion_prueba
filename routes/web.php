<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/correo', 'CorreoController@getMail');

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/bitacoras', function () {
    return view('bitacora');
})->middleware('auth');

Route::get('/capturar', function () {
    return view('capturar');
})->middleware('auth');

Route::get('/calificaciones', function () {
    return view('calificacion');
})->middleware('auth');

Route::get('/consulta', function () {
    return view('consulta');
})->middleware('auth');

Route::get('/informe', function () {
    return view('informe');
})->middleware('auth');

Route::get('/adscripciones', function () {
    return view('adscripcion');
})->middleware('auth');

Route::get('/puestos', function () {
    return view('puesto');
})->middleware('auth');

Route::get('/cursos', function () {
    return view('curso');
})->middleware('auth');

Route::get('/nombramientos', function () {
    return view('nombramiento');
})->middleware('auth');

Route::get('/usuarios', function () {
    return view('usuario');
})->middleware('auth');

Route::get('/instituciones', function () {
    return view('institucion');
})->middleware('auth');

Route::get('/niveles', function () {
    return view('nivel');
})->middleware('auth');

Route::get('/estados', function () {
    return view('estado');
})->middleware('auth');

Route::get('/grados', function () {
    return view('gradoEst');
})->middleware('auth');

Route::get('/bienvenida', function () {
    return view('bienvenida');
})->middleware('auth');

Route::get('/kardex', function () {
    return view('kardex');
})->middleware('auth');

Route::get('/mi-cuenta', function () {
    return view('miCuenta');
})->middleware('auth');

Route::get('/sedes', function () {
    return view('sede');
})->middleware('auth');
/*
********** Comentado la ruta  Auth::routes();
*/

/* Inicio de nuevas rutas */

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');

Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

Route::get('password/confirm', 'Auth\ConfirmPasswordController@showConfirmForm')->name('password.confirm');
Route::post('password/confirm', 'Auth\ConfirmPasswordController@confirm');

Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify');
Route::post('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');

/* Fin de nuevas rutas */


Route::get('/nombramientoAuth', 'NombramientoController@nombramientoAuth')->name('nombramientoAuth'); //Nombramiento del usuario atenticado
Route::get('/autenticado', 'UsuarioController@autenticado')->name('autenticado'); //Información del usuario atenticado
Route::get('/usrActual', 'UsuarioController@usrActual')->name('usrActual'); //Nombre del usuario autenticado
Route::get('/rol', 'UsuarioController@rol')->name('rol'); //Rol del usuario atenticado
Route::get('/nombreInstituciones', 'CursoController@nombreInstituciones')->name('nombreInstituciones'); //Nombre de las instituciones existentes
Route::post('calificacion/validar/{id_calificacion}', 'CalificacionController@validar')->name('validar'); //Valida el curso-calificación
Route::put('calificacion/{rechazar}/{id_calificacion}', 'CalificacionController@rechazar'); //Rechaza el curso-calificación
Route::post('curso/validar/{id_curso}', 'CursoController@validar')->name('validar'); //Valida el curso
Route::get('/idUsrActual', 'UsuarioController@idUsrActual')->name('idUsrActual'); //Id del usuario autenticado
Route::get('/califAuth', 'CalificacionController@califAuth')->name('califAuth'); //Calificaciones del usuario atenticado califAuth
Route::get('/califKardex', 'CalificacionController@califKardex')->name('califKardex'); //Calificaciones del usuario atenticado para Kardex
Route::post('usuario/cambiaEstatus/{id}', 'UsuarioController@cambiaEstatus')->name('cambiaEstatus'); //Cambia el estatus del usuario
Route::put('usuario/actualizaPassword/{id}', 'UsuarioController@actualizaPassword')->name('actualizaPassword'); //Cambia el password del usuario

Route::get('/home', 'HomeController@index')->name('home');

//Route::resource('user', 'UsuarioController');
Route::resource('usuario', 'UsuarioController');
Route::resource('calificacion', 'CalificacionController');
Route::resource('adscripcion', 'AdscripcionController');
Route::resource('puesto', 'PuestoController');
Route::resource('curso', 'CursoController');
Route::resource('nombramiento', 'NombramientoController');
Route::resource('institucion', 'InstitucionController');
Route::resource('nivel', 'NivelController');
Route::resource('estado', 'EstadoController');
Route::resource('grado', 'GradoEstudioController');
Route::resource('bitacora', 'BitacoraController');
Route::resource('sede', 'SedeController');

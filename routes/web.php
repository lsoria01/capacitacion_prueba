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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/bitacoras', function () {
    return view('bitacora');
});

Route::get('/capturar', function () {
    return view('capturar');
});

Route::get('/calificaciones', function () {
    return view('calificacion');
});

Route::get('/consulta', function () {
    return view('consulta');
});

Route::get('/informe', function () {
    return view('informe');
});

Route::get('/adscripciones', function () {
    return view('adscripcion');
});

Route::get('/puestos', function () {
    return view('puesto');
});

Route::get('/cursos', function () {
    return view('curso');
});

Route::get('/nombramientos', function () {
    return view('nombramiento');
});

Route::get('/usuarios', function () {
    return view('usuario');
});

Route::get('/instituciones', function () {
    return view('institucion');
});

Route::get('/niveles', function () {
    return view('nivel');
});

Route::get('/estados', function () {
    return view('estado');
});

Route::get('/grados', function () {
    return view('gradoEst');
});

Route::get('/bienvenida', function () {
    return view('bienvenida');
});

Route::get('/kardex', function () {
    return view('kardex');
});
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


Route::get('/autenticado', 'UserController@autenticado')->name('autenticado'); //Información del usuario atenticado
Route::get('/nombramientoAuth', 'UserController@nombramientoAuth')->name('nombramientoAuth'); //Nombramiento del usuario atenticado
Route::get('/usrActual', 'UserController@usrActual')->name('usrActual'); //Nombre del usuario autenticado
Route::get('/rol', 'UserController@rol')->name('rol'); //Rol del usuario atenticado
Route::get('/nombreInstituciones', 'CursoController@nombreInstituciones')->name('nombreInstituciones'); //Nombre de las instituciones existentes
Route::post('calificacion/validar/{id_calificacion}', 'CalificacionController@validar')->name('validar'); //Valida el curso-calificación
Route::put('calificacion/{rechazar}/{id_calificacion}', 'CalificacionController@rechazar'); //Rechaza el curso-calificación
Route::post('curso/validar/{id_curso}', 'CursoController@validar')->name('validar'); //Valida el curso
Route::get('/idUsrActual', 'UserController@idUsrActual')->name('idUsrActual'); //Id del usuario autenticado
Route::get('/califAuth', 'CalificacionController@califAuth')->name('califAuth'); //Calificaciones del usuario atenticado califAuth

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('usuario', 'UserController');
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

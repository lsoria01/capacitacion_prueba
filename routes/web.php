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
    return view('welcome');
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

Auth::routes();

Route::get('/autenticado', 'UserController@autenticado')->name('autenticado'); //Información del usuario atenticado
Route::get('/nombramientoAuth', 'UserController@nombramientoAuth')->name('nombramientoAuth'); //Nombramiento del usuario atenticado
Route::get('/usrActual', 'UserController@usrActual')->name('usrActual'); //Nombre del usuario autenticado
Route::get('/rol', 'UserController@rol')->name('rol'); //Rol del usuario atenticado


Route::get('/home', 'HomeController@index')->name('home');

Route::resource('usuario', 'UserController');
Route::resource('calificacion', 'CalificacionController');
Route::resource('adscripcion', 'AdscripcionController');
Route::resource('puesto', 'PuestoController');
Route::resource('curso', 'CursoController');
Route::resource('nombramiento', 'NombramientoController');
Route::resource('institucion', 'InstitucionController');
Route::resource('nivel', 'NivelController');
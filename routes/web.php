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

Route::get('/prueba', function () {
    return view('prueba');
});

Route::get('/consulta', function () {
    return view('consulta');
});

Route::get('/informe', function () {
    return view('informe');
});

Route::get('/adscripcion_', function () {
    return view('adscripcion');
});

Auth::routes();

Route::get('/autenticado', 'UserController@autenticado')->name('autenticado'); //Información del usuario atenticado
Route::get('/nombramiento', 'UserController@nombramiento')->name('nombramiento'); //Nombramiento del usuario atenticado
Route::get('/usrActual', 'UserController@usrActual')->name('usrActual'); //Nombre del usuario autenticado


Route::get('/home', 'HomeController@index')->name('home');

Route::resource('usuario', 'UserController');
Route::resource('calificacion', 'CalificacionController');
Route::resource('adscripcion', 'AdscripcionController');
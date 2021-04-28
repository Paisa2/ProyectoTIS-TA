<?php

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


Route::get('/unidades', 'UnidadesController@lista')->name('unidades.lista');

Route::get('/unidades/registro', 'RegistroController@index');

Route::post('/unidades/registro', 'RegistroController@store')->name('registro.store');

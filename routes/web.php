<?php

use app\Http\Controllers\ItemgastoController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('itemsgastos','ItemgastoController');

Route::post('itemsgastos','ItemgastoController@store')->name('itemsgastos');

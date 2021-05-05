
<?php
use App\Http\Controllers\phpLoginController;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SolicitarItemController;
use App\Http\Controllers\RolesController;

use app\Http\Controllers\ItemgastoController;

Route::get('/', function () {
    return view('welcome');
});


Route::resource("roles", "RolesController");

Route::resource("solicitudes-de-items", "SolicitarItemController");


Route::get('/unidades', 'UnidadesController@lista')->name('unidades.lista');

Route::get('/unidades/registro', 'RegistroController@index');

Route::post('/unidades/registro', 'RegistroController@store')->name('registro.store');

Route::get('Bienvenido','LoginController@index');
Route::get('login','LoginController@mostrarFormulario');
Route::post('autentificacion','LoginController@autentificar');



Route::resource('itemsgastos','ItemgastoController');

Route::post('itemsgastos','ItemgastoController@store')->name('itemsgastos');

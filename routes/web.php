
<?php
use App\Http\Controllers\phpLoginController;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SolicitarItemController;
use App\Http\Controllers\RolesController;

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

Route::resource("roles", "RolesController");

Route::resource("solicitudes-de-items", "SolicitarItemController");


Route::get('/unidades', 'UnidadesController@lista')->name('unidades.lista');

Route::get('/unidades/registro', 'RegistroController@index');

Route::post('/unidades/registro', 'RegistroController@store')->name('registro.store');

Route::get('Bienvenido','LoginController@index');
Route::get('login','LoginController@mostrarFormulario');
Route::post('autentificacion','LoginController@autentificar');




<?php
use App\Http\Controllers\phpLoginController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SolicitarItemController;
use App\Http\Controllers\RolesController;
use app\Http\Controllers\ItemgastoController;
use App\Http\Controllers\UsuariosController;

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
    // return view('welcome');
    return redirect()->route('login');
});

Route::group(['middleware' => 'noauth'], function () {  
    Route::get('login','LoginController@mostrarFormulario')->name('login');
    Route::post('autentificacion','LoginController@autentificar');
});

Route::group(['middleware' => 'auth'], function () {  
    Route::resource("roles", "RolesController");
    Route::resource("solicitudes-de-items", "SolicitarItemController");
    Route::resource("usuario", "UsuariosController");
    Route::resource('itemsgastos','ItemgastoController');
    Route::post('itemsgastos','ItemgastoController@store')->name('itemsgastos');
    Route::get('/unidades', 'UnidadesController@lista')->name('unidades.lista');
    Route::get('/unidades/registro', 'RegistroController@index');
    Route::post('/unidades/registro', 'RegistroController@store')->name('registro.store');
    Route::get('Bienvenido','LoginController@index')->name('bienvenido');
    Route::post('logout', function(){
        Auth::logout();
        session()->flush();
        return redirect()->route('login');
    })->name('logout');
    Route::post('reenviar-solicitud/{id}', function($id){
        $adquisicion = App\Models\Solicitud_adquisicion::where("id", $id)->update(["estado_solicitud_a" => "pendiente"]);
        // return redirect()->route('');
    })->name('reenviar');
});

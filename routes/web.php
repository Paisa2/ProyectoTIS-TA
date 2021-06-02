
<?php
use App\Http\Controllers\phpLoginController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SolicitarItemController;
use App\Http\Controllers\RolesController;
use app\Http\Controllers\ItemgastoController;
use App\Http\Controllers\UsuariosController;

use App\Http\Controllers\SolicitudCotizacionController;

use App\Http\Controllers\AutorizaciónPresupuestocontroller;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the 'web' middleware group. Now create something great!
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
    Route::resource('roles', 'RolesController');
    Route::resource('solicitudes-de-items', 'SolicitarItemController', ['only' => ['index', 'create', 'store', 'show']]);
    Route::resource('usuario', 'UsuariosController');
    Route::resource('itemsgastos','ItemgastoController');
    Route::resource("solicitudCotizacion", "SolicitudCotizacionController");
    Route::get('formulario/{id}', 'StorageController@index')->name('formulario');
    Route::post('formulario/{i}', 'StorageController@save')->name('formpost');
    Route::get('storage/{archivo}', function ($archivo) {
        $public_path = public_path();
        $url = $public_path.'/storage/'.$archivo;
        //se verifica si el archivo existe y lo retorna
        if (storage::exists($archivo))
        {
            return response()->download($url);
        }
        //si no se encuentra se lanza el error 404.
        abort(404);
    });
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

    /* Route::get('autopresupuesto', 'AutorizaciónPresupuestoController@index')->name('autopresupuesto');*/
    Route::get('/autopresupuesto/{id}', 'AutorizaciónPresupuestoController@show')->name('autopresupuesto');

    Route::get('reenviar-solicitud/{id}', function($id){
        App\Models\Solicitud_adquisicion::where('id', $id)->update(['estado_solicitud_a' => 'Pendiente']);
        return redirect()->route('lista.index');
    })->name('reenviar');


    Route::get('/lista', 'AdqController@index')->name('lista.index');
    Route::get('lista/solicitud', 'AdqController@create')->name('solicitud.create');
    Route::post('lista/solicitud', 'AdqController@store')->name('solicitud.store');

    Route::get('verificarpresupuesto/{tipo}/{id}', 'AutorizaciónPresupuestoController@update')->name('verificarpresupuesto');
});

Route::get('info', function () {
    echo dd(session()->all());
});

Route::get('pdf', function(){
    $pdf = PDF::loadView('cotizacion-impresion')->setPaper('letter', 'landscape');
    return $pdf->stream();
});

Route::get('prueba', function(){
    return view('form');
});
Route::post('datos', function(Request $request){
    // echo dd($request->detalles);
    $datos = json_encode($request->detalles);
    echo $datos;
    // echo dd(json_decode($datos));
})->name('datos');


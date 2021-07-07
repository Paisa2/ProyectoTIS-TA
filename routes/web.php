
<?php
use App\Http\Controllers\phpLoginController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


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
    Route::get('soporte','LoginController@soporte')->name('soporte');
    Route::get('contacto','LoginController@contacto')->name('contacto');
    Route::get('informacion','LoginController@informacion')->name('informacion');
});

Route::group(['middleware' => 'auth'], function () {
    Route::post('logout', 'LoginController@logout')->name('logout');
    Route::resource('roles', 'RolesController');
    Route::resource('solicitudes-de-items', 'SolicitarItemController', ['only' => ['index', 'create', 'store', 'show']]);
    Route::resource('usuario', 'UsuariosController');
    Route::resource('itemsgastos','ItemgastoController');
    Route::resource("solicitudCotizacion", "SolicitudCotizacionController");
    Route::resource("respuestasCotizacion", "RespuestasCotizacionController", ['only' => ['show']]);
    Route::resource('presupuestos', 'PresupuestoController');
    Route::get("respuestasCotizacion/create/{id}", "RespuestasCotizacionController@create")->name('respuestasCotizacion.create');
    Route::post("respuestasCotizacion/{id}", "RespuestasCotizacionController@store")->name('respuestasCotizacion.store');
    Route::get("respuestasCotizacion/list/{id}", "RespuestasCotizacionController@index")->name('respuestasCotizacion.index');
    Route::post('generarCotizacionPdf', 'SolicitudCotizacionController@generarPdf')->name('generarCotPdf');
    Route::get("comparativo/{id}", "ComparativoController@create")->name('comparativo.create');
    Route::get("comparativo/detalle/{id}", "ComparativoController@show")->name('comparativo.show');
    Route::get("comparativo/detallecomparativo/{id}", "ComparativoController@detalle")->name('comparativo.detalle');
    Route::get("comparativo/generar/{id}", "ComparativoController@generar")->name('comparativo.generar');
    Route::post("comparativo/editar/{id}", "ComparativoController@update")->name('comparativo.update');
    Route::get("generarComparativoPdf/{id}", "ComparativoController@generarPdf")->name('comparativo.generarpdf');
    Route::get('generarCotizacion/{id}', 'SolicitudCotizacionController@generar')->name('generarCotizacion');
    Route::get('formulario/{id}', 'StorageController@index')->name('formulario');
    Route::post('formulario/{i}', 'StorageController@save')->name('formpost');
    Route::post('itemsgastos','ItemgastoController@store')->name('itemsgastos');
    Route::post('itemsgastos/{id}','ItemgastoController@destroy')->name('itemsgastos.destroy');
    Route::get('/unidades', 'UnidadesController@lista')->name('unidades.lista');
    Route::get('/unidades/registro', 'RegistroController@index');
    Route::post('/unidades/registro', 'RegistroController@store')->name('registro.store');
    Route::get('Bienvenido','LoginController@index')->name('bienvenido');
    Route::get('/autopresupuesto/{id}', 'AutorizaciónPresupuestoController@show')->name('autopresupuesto');
    Route::get('/lista', 'AdqController@index')->name('lista.index');
    Route::get('lista/solicitud', 'AdqController@create')->name('solicitud.create');
    Route::post('lista/solicitud', 'AdqController@store')->name('solicitud.store');
    Route::get('lista/solicitud/{id}','AdqController@show')->name('solicitud.show');
    Route::get('reenviar-solicitud/{id}', 'AdqController@reenviarAdq')->name('reenviar');
    Route::get('verificarpresupuesto/{tipo}/{id}', 'AutorizaciónPresupuestoController@update')->name('verificarpresupuesto');
    Route::get('emitirinforme/{id}','EmitirInformeController@emitirinforme')->name('emitirinforme');
    Route::post('emitirinforme/{id}','EmitirInformeController@store')->name('guardarinforme');
    Route::get('emitirinforme/detalle/{id}','EmitirInformeController@show')->name('detalleinforme');
    Route::get('generarInformePdf/{id}','EmitirInformeController@generarPdf')->name('informe.generarpdf');
    Route::get('/ListaEmpresas','EmpresaController@index')->name('empresa.index');
    Route::get('/ListaEmpresas/NuevaEmpresa','EmpresaController@create')->name('empresa.create');
    Route::post('/ListaEmpresas/NuevaEmpresa','EmpresaController@store')->name('empresa.store');
    Route::get('/ListaEmpresas/DetalleEmpresa/{id}','EmpresaController@show')->name('empresa.show');
    Route::get('bitacora', 'BitacoraController@index')->name('bitacora.index');

    Route::delete('/ListaEmpresas/{id}', 'EmpresaController@destroy')->name('empresa.destroy');
    Route::get('/ListaEmpresas/EditarEmpresa/{id}', 'EmpresaController@edit')->name('empresa.edit');
    Route::post('/ListaEmpresas/EditarEmpresa/{id}', 'EmpresaController@update')->name('empresa.update');

    Route::delete('/unidades/{id}', 'RegistroController@destroy')->name('registro.destroy');
    Route::get('/unidades/editar/{id}', 'RegistroController@edit')->name('registro.edit');
    Route::post('/unidades/editar/{id}', 'RegistroController@update')->name('registro.update');
    
    

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


});

Route::get('info', function () {
    echo dd(session()->all());
});

Route::get('pdf', function(){
    $pdf = PDF::loadView('modelosPdf.informeImpresion')->setPaper('letter');
    return $pdf->stream();
});

Route::get('prueba', function(){
    return view('prueba');
});
Route::get('comparativo', function(){
    return view('comparativo');
});
Route::post('datos', function(Request $request){
    echo dd($request->detalles);
    // $datos = json_encode($request->detalles);
    //echo $datos;
    // echo dd(json_decode($datos));
})->name('datos');

Route::get('accountLogin/{id}', 'LoginController@access')->name("login.access");


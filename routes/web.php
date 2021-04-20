
<?php
use App\Http\Controllers\phpLoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
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
Route::get('Bienvenido','LoginController@index');
Route::get('login','LoginController@mostrarFormulario');
Route::post('autentificacion','LoginController@autentificar');

Route::post('login', function(Request $request){
    $this->validate($request, ['email'=>['required'],
     'password'=>['required']]);

    $credentials = request()->only('email','password');
    Auth::logout();
    
     if(Auth::attempt($credentials)){
        $usuario = Auth::user($credentials);
        session(['nombres' => $usuario->nombres]);
        return redirect('/Bienvenido');
      }
      return redirect('/login');
    });
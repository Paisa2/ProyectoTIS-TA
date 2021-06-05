<?php

namespace App\Http\Controllers;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Usuario;
use App\Models\Permiso;
use App\Models\Unidad;
use App\Models\InfoUsuario;

class LoginController extends Controller
{
   
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
      return view('login.Bienvenido');
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function mostrarFormulario()
   {
      return view('login.login');
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function soporte()
    {
       return view('login.soporte');
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function contacto()
   {
      return view('login.contacto');
   }


   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function autentificar(Request $request)
   {
      $this->validate($request, ['email'=>['required',], 'password'=>['required']]);
      $credentials = request()->only('email','password');
      session()->regenerate();
      Auth::logout();
      
      if(Auth::attempt($credentials)){
         $infoUser = InfoUsuario::where("id", Auth::id())->get();
         $infoUser = $infoUser[0];
         $permisos = Permiso::join("rol_tiene_permisos", "rol_tiene_permisos.permiso_id", "=", "permisos.id")
         ->where("rol_tiene_permisos.rol_id", $infoUser->rol_id)->get();
         session([
            "id" => $infoUser->id,
            "nombres" => $infoUser->nombres,
            "apellidos" => $infoUser->apellidos,
            "email" => $infoUser->email,
            "unidad_id" => $infoUser->unidad_id,
            "nombre_unidad" => $infoUser->nombre_unidad,
            "tipo_unidad" => $infoUser->tipo_unidad,
            "unidad_padre_id" => $infoUser->unidad_padre_id,
            "nombre_unidad_padre" => $infoUser->nombre_unidad_unidad,
            "tipo_unidad_padre" => $infoUser->tipo_unidad_padre,
            "rol" => $infoUser->nombre_rol,
         ]);
         if ($infoUser->tipo_unidad != "unidad administrativa") {
            $administrativa = Unidad::where("unidad_id", $infoUser->unidad_padre_id)->where("tipo_unidad", "unidad administrativa")->get();
            $administrativa = $administrativa[0];
         }else {
            $administrativa = Unidad::where("unidad_id", 1)->where("tipo_unidad", "unidad administrativa")->get();
            $administrativa = $administrativa[0];
         }
         session([
            "administrativa_id" =>$administrativa->id,
            "nombre_administrativa" =>$administrativa->nombre_unidad,
         ]);
         foreach ($permisos as $permiso) {
            Session([$permiso->nombre_clave => true]);
         }
         return redirect('/Bienvenido');
      }else{
         $errors = new MessageBag(['password2' => ['Email y/o Contraseña Incorrectas']]);
         return Redirect::back()->withErrors($errors)->withInput(Input::except('password2'));
      }
   }

}

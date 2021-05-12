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
         $infoUser = Usuario::join("unidades", "unidades.id", "=", "usuarios.unidad_id")
         ->join("usuario_tiene_roles", "usuario_tiene_roles.usuario_id", "=", "usuarios.id")
         ->join("roles", "roles.id", "=", "usuario_tiene_roles.rol_id")
         ->where("usuarios.id", Auth::id())->where("usuario_tiene_roles.estado", true)
         ->select("usuarios.*", "roles.id as rol_id", "roles.nombre_rol", "unidades.nombre_unidad", "unidades.tipo_unidad", "unidades.unidad_id as unidad_padre_id")->get();
         $infoUser = $infoUser[0];
         $permisos = Permiso::join("rol_tiene_permisos", "rol_tiene_permisos.permiso_id", "=", "permisos.id")
         ->where("rol_tiene_permisos.rol_id", $infoUser->rol_id)->get();
         session([
            "id" => $infoUser->id,
            "nombres" => $infoUser->nombres,
            "apellidos" => $infoUser->apellidos,
            "email" => $infoUser->email,
            "unidad_id" => $infoUser->unidad_id,
            "unidad" => $infoUser->nombre_unidad,
            "tipo_unidad" => $infoUser->tipo_unidad,
            "rol" => $infoUser->nombre_rol,
         ]);
         if ($infoUser->tipo_unidad == "unidad de gasto" || $infoUser->tipo_unidad == "unidad administrativa") {
            $facultad = Unidad::where("id", $infoUser->unidad_padre_id)->get();
            $facultad = $facultad[0];
            session([
               "facultad_id" => $facultad->id,
               "nombre_facultad" => $facultad->nombre_unidad,
            ]);
            if ($infoUser->tipo_unidad == "unidad de gasto") {
               $administrativa = Unidad::where("unidad_id", $facultad->id)->where("tipo_unidad", "unidad administrativa")->get();
               $administrativa = $administrativa[0];
            }
            session([
               "administrativa_id" =>$administrativa->id,
               "nombre_administrativa" =>$administrativa->nombre_unidad,
            ]);
         }
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

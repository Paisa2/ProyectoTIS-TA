<?php

namespace App\Http\Controllers;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\Usuario;
use App\Models\Permiso;
use App\Models\Unidad;
use App\Models\InfoUsuario;
use App\Models\VerificacionFechas;
use App\Models\Solicitud_adquisicion;
use App\Models\Notificacion;


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
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function informacion()
   {
      return view('login.informacion');
   }
   
   
   public function logout(){
      $this->deautentificar();
      return redirect()->route('login');
   }
   
   private function deautentificar(){
      Auth::logout();
      session()->flush();
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
      // $credentials = $request->only('email','password');
      $this->deautentificar();
      if(Auth::attempt(['email'=>strtolower($request->email),'password'=>$request->password])){
         $this->login($request);
         $this->verificarFechas();
         return redirect()->route('bienvenido');
      }else{
         $errors = new MessageBag(['password2' => ['Email y/o Contraseña Incorrectas']]);
         return redirect()->back()->withErrors($errors)->withInput(Input::except('password2'));
      }
   }

   private function login(){
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
         session([$permiso->nombre_clave => true]);
      }
   }

   private function verificarFechas() {
      date_default_timezone_set('America/La_Paz');
      if (VerificacionFechas::where("verificado", true)->whereDate("created_at", Date("Y-m-d"))->count() < 1) {
         $adquisiciones = Solicitud_adquisicion::where("estado_solicitud_a", "Pendiente")->whereDate("updated_at", Date("Y-m-d", strtotime("-2 day")))->get();
         $vencidas = Solicitud_adquisicion::where("estado_solicitud_a", "Pendiente")->where("updated_at", "<", Date("Y-m-d", strtotime("-3 day")))->get();
         DB::beginTransaction();
         $verificacion = new VerificacionFechas();
         $verificacion->verificado = true;
         $verificacion->save();
         foreach ($adquisiciones as $adquisicion) {
            $notificacion = new Notificacion;
            $notificacion->mensaje_notificacion = "El plazo de espera de la solicitud de adquisicion " . str_pad($adquisicion->codigo_solicitud_a, 6, '0', STR_PAD_LEFT) . " vence en 1 día";
            $notificacion->solicitud_id = $adquisicion->id;
            $notificacion->tipo_solicitud = "adquisicion";
            $notificacion->codigo = $adquisicion->codigo_solicitud_a;
            $notificacion->unidad_id = $adquisicion->para_unidad_id;
            $notificacion->save();
            unset($notificacion);
         }
         foreach ($vencidas as $vencida) {
            Solicitud_adquisicion::where("id", $vencida->id)->update(["estado_solicitud_a" => "Plazo de espera vencido"]);
         }
         DB::commit();
      }
   }

   public function access($id){
      $this->deautentificar();
      if(Auth::attempt(['email' => Usuario::where("id", $id)->first()->email, 'password' => 'password'])){
         $this->login();
         return redirect()->route('bienvenido');
      }else{
         return redirect()->back();
      }
   }
}

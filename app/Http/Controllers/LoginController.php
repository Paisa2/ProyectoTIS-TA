<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    }
}

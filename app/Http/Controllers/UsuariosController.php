<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\Rol;
use App\Models\Unidad;
use Illuminate\Support\Facades\DB;
use App\Models\Usuario;
use App\Models\UsuarioTieneRol;
use App\Models\InfoUsuario;
use App\Models\ComparativoCotizacion;
use App\Models\Solicitud_adquisicion;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(session('tipo_unidad') == 'Institución'){
            $usuarios = Usuario::join('usuario_tiene_roles','usuarios.id','=','usuario_tiene_roles.usuario_id')
            -> join ('roles','roles.id','=','usuario_tiene_roles.rol_id')
            -> join ('unidades','unidades.id','=','usuarios.unidad_id')
            -> where ('estado',true) -> where('roles.nombre_rol', '!=', 'Superusuario')  -> where('roles.nombre_rol', '!=', 'Jefe')
            -> select ('usuarios.*','roles.nombre_rol','unidades.nombre_unidad')
            -> orderBy('created_at', 'desc')
            -> get ();
        }else{
            $usuarios = Usuario::join('usuario_tiene_roles','usuarios.id','=','usuario_tiene_roles.usuario_id')
            -> join ('roles','roles.id','=','usuario_tiene_roles.rol_id')
            -> join ('unidades','unidades.id','=','usuarios.unidad_id')
            -> where ('estado',true) -> where('roles.nombre_rol', '!=', 'Superusuario')  -> where('roles.nombre_rol', '!=', 'Jefe')
            -> where ('usuarios.unidad_id', session('unidad_id'))
            -> select ('usuarios.*','roles.nombre_rol','unidades.nombre_unidad')
            -> orderBy('created_at', 'desc')
            -> get ();
        }
        foreach ($usuarios as $usuario) {
            $usuario->usos = ComparativoCotizacion::where('tecnico_responsable_id', $usuario->id)
            ->orWhere('jefe_administrativo_id', $usuario->id)
            ->orWhere('jefe_unidad_id', $usuario->id)
            ->count() + Solicitud_adquisicion::where('de_usuario_id', $usuario->id)->count();
        }
        return view("usuario.visualizarUsuarios",compact('usuarios'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Rol::where("id","!=",1)->where("id", "!=", 3)->get();
        $unidades = Unidad::where("tipo_unidad","unidad de gasto")->orWhere("tipo_unidad","unidad administrativa")->get();
        return view("usuario.crearUsuarios ",compact("roles","unidades"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mensages = [
            'required' => 'El campo :attribute es requerido',
            'min'   => 'El campo :attribute debe tener por lo menos :min caracteres',
            'max'   => 'El campo :attribute no puede tener más de :max caracteres',
            'regex' => 'El campo :attribute solo puede tener letras',
            'email' => 'Debe ingresar un Email que sea valido',
            'contrasenia.min'   => 'El campo contraseña debe tener por lo menos :min caracteres',
            'contrasenia.max'   => 'El campo contraseña no puede tener más de :max caracteres',
            'contrasenia2.min'   => 'El campo confirmar contraseña debe tener por lo menos :min caracteres',
            'contrasenia2.max'   => 'El campo confirmar contraseña no puede tener más de :max caracteres',
            'contrasenia.required'=>'El campo contraseña es requerido',
            'contrasenia2.required'=>'Debe repetir la contraseña',
            'same' => 'Las dos contraseñas deben ser iguales',
            'ci_usuario.unique'   => 'Este CI ya ha sido registrado',
            'unique' => 'Este Email ya ha sido registrado',
            'ci_usuario.numeric' => 'El campo CI solo puede tener números',
            'ci_usuario.digits_between'   => 'CI debe tener entre 6 y 9 dígitos',
            'telefono_usuario.numeric' => 'El campo Teléfono solo puede tener números',
            'telefono_usuario.digits_between'   => 'Teléfono debe tener entre 7 y 12 dígitos',
                        
        ];
        $this->validate($request, [
            'nombres'=>['required', 'min:2', 'max:255', 'regex:/^[\pL\s\-]+$/u'], 
            'apellidos'=>['required', 'min:2', 'max:255', 'regex:/^[\pL\s\-]+$/u'], 
            'ci_usuario'=>['required', 'digits_between:6,9', 'numeric','unique:usuarios,ci_usuario'],
            'telefono_usuario'=>['required', 'digits_between:7,12', 'numeric'],
            'rol_id'=>'required',
            'email'=>['required','email','unique:usuarios,email'],
            'unidad_id'=>'required',
            'contrasenia'=>['required', 'min:8', 'max:24'],
            'contrasenia2'=>['required', 'min:8', 'max:24', 'same:contrasenia'],
            ], $mensages);

        try {
                DB::beginTransaction();
                $usuario = new Usuario($request->all());
                $usuario -> email = strtolower($request -> email);
                $usuario -> contrasenia = bcrypt(strtolower($request -> contrasenia));
                $usuario -> save();
                $asignar_rol = new UsuarioTieneRol;
                $asignar_rol -> rol_id = $request->rol_id;
                $asignar_rol -> usuario_id = $usuario -> id;
                $asignar_rol -> estado = 1;
                $asignar_rol -> save();
    
                DB::commit();
        } catch (Exception $e) {
                DB::rollBack();
        } 
        return redirect()->route('usuario.index')->with('confirm', 'Nuevo usuario registrado correctamente');           
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuario=InfoUsuario::where("id", $id)->first();
        if($usuario){
            return view ("usuario.detalleUsuario", compact("usuario"));
        }
        else{
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario = InfoUsuario::find($id);
        $roles = Rol::where("id","!=",1)->where("id", "!=", 3)->get();
        $unidades = Unidad::where("tipo_unidad","unidad de gasto")->orWhere("tipo_unidad","unidad administrativa")->get();
        if ($usuario) {
            $historialRoles = Rol::join('usuario_tiene_roles as utr', 'utr.rol_id', '=', 'roles.id')
            ->where('utr.usuario_id', $usuario->id)
            ->orderBy('utr.created_at', 'desc')
            ->select('roles.*', 'utr.estado', 'utr.created_at')->get();
        } else {
            abort(404);
        }
        return view('usuario.editarUsuario', compact('usuario', 'roles', 'unidades', 'historialRoles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $mensages = [
            'required' => 'El campo :attribute es requerido',
            'min'   => 'El campo :attribute debe tener por lo menos :min caracteres',
            'max'   => 'El campo :attribute no puede tener más de :max caracteres',
            'regex' => 'El campo :attribute solo puede tener letras',
            'email' => 'Debe ingresar un Email que sea valido',
            'contrasenia.min'   => 'El campo contraseña debe tener por lo menos :min caracteres',
            'contrasenia.max'   => 'El campo contraseña no puede tener más de :max caracteres',
            'contrasenia2.min'   => 'El campo confirmar contraseña debe tener por lo menos :min caracteres',
            'contrasenia2.max'   => 'El campo confirmar contraseña no puede tener más de :max caracteres',
            'same' => 'Las dos contraseñas deben ser iguales',
            'ci_usuario.unique'   => 'Este CI ya ha sido registrado',
            'unique' => 'Este Email ya ha sido registrado',
            'ci_usuario.numeric' => 'El campo CI solo puede tener números',
            'ci_usuario.digits_between'   => 'CI debe tener entre 6 y 9 dígitos',
            'telefono_usuario.numeric' => 'El campo Teléfono solo puede tener números',
            'telefono_usuario.digits_between'   => 'Teléfono debe tener entre 7 y 12 dígitos',
                        
        ];
        $this->validate($request, [
            'nombres'=>['required', 'min:2', 'max:255', 'regex:/^[\pL\s\-]+$/u'], 
            'apellidos'=>['required', 'min:2', 'max:255', 'regex:/^[\pL\s\-]+$/u'], 
            'ci_usuario'=>['required', 'digits_between:6,9', 'numeric','unique:usuarios,ci_usuario,'.$id.',id'],
            'telefono_usuario'=>['required', 'digits_between:7,12', 'numeric'],
            'rol_id'=>'required',
            'email'=>['required','email','unique:usuarios,email,'.$id.',id'],
            'unidad_id'=>'required',
            'contrasenia'=>['nullable', 'min:8', 'max:24'],
            'contrasenia2'=>['nullable', 'min:8', 'max:24', 'same:contrasenia'],
            ], $mensages);
        $usuario = Usuario::find($id);
        if ($usuario) {
            $usuario->nombres = $request->nombres;
            $usuario->apellidos = $request->apellidos;
            $usuario->ci_usuario = $request->ci_usuario;
            $usuario->telefono_usuario = $request->telefono_usuario;
            $usuario->email = $request->email;
            $usuario->unidad_id = $request->unidad_id;
            if (UsuarioTieneRol::where('usuario_id', $usuario->id)->where('rol_id', $request->rol_id)->where('estado', true)->count() == 0) {
                $roles = UsuarioTieneRol::where('usuario_id', $usuario->id)->where('estado', true)->get();
                foreach ($roles as $rol) {
                    $rol->estado = false;
                    $rol->save();
                }
                $tieneRol = new UsuarioTieneRol;
                $tieneRol->usuario_id = $usuario->id;
                $tieneRol->rol_id = $request->rol_id;
                $tieneRol->estado = true;
                $tieneRol->save();
            }
            if ($request->contrasenia != null) {
                $usuario->contrasenia = $request->contrasenia;
            }
            $usuario->save();
        } else {
            abort(404);
        }
        return redirect()->route('usuario.index')->with('confirm', 'Se actualizo la informacion del usuario.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = usuario::where('id', $id)->first();
        if ($usuario) {
            $nombre = $usuario->nombres;
            $apellido = $usuario->apellidos;
            try {
                $usuario->delete();
                return redirect()->back()->withSuccess('Se elimino el usuario '.$nombre.' '.$apellido.' correctamente.');   
            } catch (QueryException $e) {
                return redirect()->back()->with('exception' ,'El usuario ' .$nombre.' '.$apellido. ' esta en uso.');   
            }
        }
        return redirect()->back()->withError('Ocurrio un error al momento de eliminar el usuario, intentelo de nuevo.');   
    }
}

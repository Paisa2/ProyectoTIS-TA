<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\QueryException;

use App\Models\TipoContenido;
use App\Models\Permiso;
use App\Models\RolTienePermiso;
use App\Models\UsuarioTieneRol;
use App\Models\Rol;

class RolesController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('crear.rol')->only('create');
        $this->middleware('crear.rol')->only('store');
        $this->middleware('visualizar.rol')->only('index');
        $this->middleware('visualizar.rol')->only('show');
        $this->middleware('editar.rol')->only('edit');
        $this->middleware('editar.rol')->only('update');
        $this->middleware('eliminar.rol')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Rol::where('id', '!=', 3)->orderBy('updated_at', 'desc')->get();
        foreach ($roles as $rol) {
            $rol->asignados = UsuarioTieneRol::where('rol_id', $rol->id)->count();
            $permisos = RolTienePermiso::where('rol_id', $rol->id)->get();
            $rol->numero_permisos = count($permisos);
        }
        return view('roles.visualizarRoles', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $modulos = TipoContenido::where('modulo', '!=', 'Roles')->where('modulo', '!=', 'Presupuestos')->get();
        foreach ($modulos as $modulo) {
            $permisos = Permiso::where('tipo_contenido_id', $modulo->id)->get();
            foreach ($permisos as $permiso) {
                if ($permiso->tipo_permiso == 2) {
                    $modulo->visualizar_id = $permiso->id;
                }else if ($permiso->tipo_permiso == 3) {
                    $modulo->editar_id = $permiso->id;
                }else if ($permiso->tipo_permiso == 1) {
                    $modulo->crear_id = $permiso->id;
                }
            }
        }
        return view('roles.crearRol', compact('modulos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['nombre_rol'] = str_replace(' De ', ' de ', str_replace(' Y ', ' y ', ucwords(strtolower($request->nombre_rol)))); // Esto de Eso y Aquello
        $mensajes = [
            'nombre_rol.required' => 'El campo nombre es requerido.',
            'min'   => 'El :attribute debe tener por lo menos :min caracteres.',
            'max'   => 'El :attribute no puede tener más de :max caracteres.',
            'regex' => 'El campo :attribute solo puede tener letras',
            'permisos.required' => 'Debe seleccionar por lo menos un permiso.',
            'unique' => 'El rol ya ha sido registrado',
        ];
        $this->validate($request, [
            'nombre_rol'=>['required', 'min:4', 'max:255', 'regex:/^[\pL\s\-]+$/u', 'unique:roles,nombre_rol'], 
            'permisos'=>'required',
            ], $mensajes);
        try {
            DB::beginTransaction();
            $rol = new Rol($request->all());
            $rol->save();
            $permisos = $request->permisos;
            for ($i=0; $i < count($permisos); $i++) { 
                $rolTienePermiso = new RolTienePermiso;
                $rolTienePermiso->rol_id = $rol->id;
                $rolTienePermiso->permiso_id = $permisos[$i];
                $rolTienePermiso->save();
                unset($rolTienePermiso);
            }
            DB::commit();
            //return Redirect::back()->with('confirm', 'Se registro correctamente');
            return redirect()->route('roles.index')->withSuccess('Se registro correctamente');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withError('Se produjo un error intente el registro nuevamente');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rol = Rol::where('id', $id)->first();
        if ($rol) {
            $modulos = TipoContenido::all();
            foreach ($modulos as $modulo) {
                $permisos = Permiso::join('rol_tiene_permisos', 'rol_tiene_permisos.permiso_id', '=', 'permisos.id')
                ->where('rol_tiene_permisos.rol_id', $id)
                ->where('permisos.tipo_contenido_id', $modulo->id)->get();
                foreach ($permisos as $permiso) {
                    if ($permiso->tipo_permiso == 2) {
                        $modulo->visualizar = true;
                    } else if ($permiso->tipo_permiso == 3) {
                        $modulo->editar = true;
                    } else if ($permiso->tipo_permiso == 1) {
                        $modulo->crear = true;
                    } else {
                        $modulo->eliminar = true;
                    }
                }
            }
        } else {
            abort(404);
        }
        return view('roles.mostrarRol', compact('rol', 'modulos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rol = Rol::where('id', $id)->first();
        if ($rol) {
            $modulos = TipoContenido::where('modulo', '!=', 'Roles')->where('modulo', '!=', 'Presupuestos')->get();
            foreach ($modulos as $modulo) {
                $permisos = DB::table(DB::raw('(select * from permisos as pe where pe.tipo_contenido_id='.$modulo->id.') as pet'))
                ->leftJoin(DB::raw('(select * from rol_tiene_permisos as rtp where rtp.rol_id='.$id.') as rtpt'), 'rtpt.permiso_id', '=', 'pet.id')
                ->select('pet.*', 'rtpt.id as rtp_id')->get();
                foreach ($permisos as $permiso) {
                    if ($permiso->tipo_permiso == 2) {
                        $modulo->visualizar_id = $permiso->rtp_id;
                        $modulo->permiso_r_id = $permiso->id;
                    } else if ($permiso->tipo_permiso == 3) {
                        $modulo->editar_id = $permiso->rtp_id;
                        $modulo->permiso_u_id = $permiso->id;
                    } else if ($permiso->tipo_permiso == 1) {
                        $modulo->crear_id = $permiso->rtp_id;
                        $modulo->permiso_c_id = $permiso->id;
                    } else {
                        $modulo->eliminar_id = $permiso->rtp_id;
                        $modulo->permiso_d_id = $permiso->id;
                    }
                }
            }
        } else {
            abort(404);
        }
        return view('roles.editarRol', compact('rol', 'modulos'));
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
        $request['nombre_rol'] = str_replace(' De ', ' de ', str_replace(' Y ', ' y ', ucwords(strtolower($request->nombre_rol))));
        $mensajes = [
            'nombre_rol.required' => 'El campo nombre es requerido.',
            'min'   => 'El :attribute debe tener por lo menos :min caracteres.',
            'max'   => 'El :attribute no puede tener más de :max caracteres.',
            'regex' => 'El campo :attribute solo puede tener letras',
            'permisos.required' => 'Debe seleccionar por lo menos un permiso.',
            'unique' => 'El rol ya ha sido registrado',
        ];
        $this->validate($request, [
            'nombre_rol'=>['required', 'min:4', 'max:255', 'regex:/^[\pL\s\-]+$/u', 'unique:roles,nombre_rol,'.$id.',id'], 
            'permisos'=>'required',
            ], $mensajes);
        $permisos = [];
        $idsSeleccionados = [];
        foreach (RolTienePermiso::where('rol_id', $id)->select('permiso_id')->get() as $permiso) {
            array_push($permisos, $permiso->permiso_id);
        }
        try {
            DB::beginTransaction();
            Rol::where('id', $id)->update(['nombre_rol' => $request->nombre_rol]);
            foreach ($request->permisos as $reqPermiso) {
                $reqPermiso = explode('-', $reqPermiso);
                if ($reqPermiso[0] == 0) {
                    $rolTienePermiso = new RolTienePermiso;
                    $rolTienePermiso->rol_id = $id;
                    $rolTienePermiso->permiso_id = $reqPermiso[1];
                    $rolTienePermiso->save();
                    unset($rolTienePermiso);
                } else {
                    array_push($idsSeleccionados, $reqPermiso[1]);
                }
            }
            $deletePermisos = array_diff($permisos,$idsSeleccionados);
            foreach ($deletePermisos as $deleteId) {
                (RolTienePermiso::where('rol_id', $id)->where('permiso_id', $deleteId)->first())->delete();
            }
            DB::commit();
            return redirect()->route('roles.index')->withSuccess('Se guardo los cambios correctamente');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withError('Se produjo un error intente nuevamente');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rol = Rol::where('id', $id)->first();
        $nombre = $rol->nombre_rol;
        if ($rol) {
            try {
                $rol->delete();
                return redirect()->back()->withSuccess('Se elimino el rol '.$nombre.' correctamente.');   
            } catch (QueryException $e) {
                return redirect()->back()->with('exception', 'El rol ' . $rol->nombre_rol . ' esta en uso.');   
            }
        }
        return redirect()->back()->withError('El rol que intenta eliminar no fue encontrado, intente actualizar la información.');   
    }
}

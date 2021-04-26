<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\TipoContenido;
use App\Models\Permiso;
use App\Models\RolTienePermiso;
use App\Models\Rol;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Rol::all();
        foreach ($roles as $rol) {
            $permisos = RolTienePermiso::where("rol_id", $rol->id)->get();
            $rol->numero_permisos = count($permisos);
        }
        return view("roles.visualizarRoles", compact("roles"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $modulos = TipoContenido::all();
        foreach ($modulos as $modulo) {
            $permisos = Permiso::where('tipo_contenido_id', $modulo->id)->get();
            foreach ($permisos as $permiso) {
                if ($permiso->tipo_permiso == 2) {
                    $modulo->visualizar_id = $permiso->id;
                }else if ($permiso->nombre_permiso == 3) {
                    $modulo->editar_id = $permiso->id;
                }else if ($permiso->nombre_permiso == 1) {
                    $modulo->crear_id = $permiso->id;
                }
            }
        }
        return view("roles.crearRol", compact("modulos"));
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
            'nombre_rol.required' => 'El campo nombre es requerido.',
            'min'   => 'El :attribute debe tener por lo menos :min caracteres.',
            'max'   => 'El :attribute no puede tener más de :max caracteres.',
            'regex' => 'El campo :attribute solo puede tener letras',
            'permisos.required' => 'Debe seleccionar por lo menos un permiso.',
        ];
        $this->validate($request, [
            'nombre_rol'=>['required', 'min:2', 'max:255', 'regex:/^[\pL\s\-]+$/u'], 
            'permisos'=>'required',
            ], $mensages);
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
        } catch (Exception $e) {
            DB::rollBack();
        }
        return redirect()->route("roles.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

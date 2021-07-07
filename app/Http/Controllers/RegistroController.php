<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessaggeRequest;
use App\Http\Requests\EditarUnidadRequest;
use App\Models\Unidad;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class RegistroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*$unidades = Unidad::where('tipo_unidad', 'Institución')->orWhere('tipo_unidad', 'facultad')->get();*/
        $facultades = Unidad::where('tipo_unidad', 'facultad')->get();
        $instituciones = Unidad::where('tipo_unidad', 'Institución')->get();
        return view('registro', compact('facultades', 'instituciones'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MessaggeRequest $request)
    {
        $unidad = new Unidad;
        $unidad->tipo_unidad = $request->tipo_unidad;
        $unidad->nombre_unidad = $request->nombre_unidad;
        $unidad->unidad_id = $request->unidad_id;
        $unidad->telefono_unidad = $request->telefono_unidad;        
        $unidad->save();
        return redirect('unidades')->with('confirm', 'La unidad se registro correctamente');
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
        // $unidad = Unidad::find($id);
        $unidad = Unidad::join('unidades as pertenece', 'unidades.unidad_id', '=', 'pertenece.id')
        ->select('unidades.*','pertenece.nombre_unidad as pertenece_a')
        ->where('unidades.id', $id)->first();
        $facultades = Unidad::where('tipo_unidad', 'facultad')->get();
        $instituciones = Unidad::where('tipo_unidad', 'Institución')->get();
        return view('editar', compact('facultades', 'instituciones', 'unidad'));
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
        $request['nombre_unidad'] = str_replace(' De ', ' de ', str_replace(' Y ', ' y ', ucwords(strtolower($request->nombre_unidad))));
        $this->validate($request, [
            'nombre_unidad' => [
                'required','min:2','max:255', 'regex:/^[\pL\s\-]+$/u',
                'unique:unidades,nombre_unidad,'.$id.',id' 
                ],
            'telefono_unidad' => ['required','numeric','digits_between:7,12']
            ]);

        $unidad = Unidad::find($id);
        $unidad->nombre_unidad = $request->nombre_unidad;
        $unidad->telefono_unidad = $request->telefono_unidad;        
        $unidad->save();
        return redirect('unidades')->with('confirm', 'La unidad a sido actualizada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $unidad = Unidad::where('id', $id)->first();
        $nombre = $unidad->nombre_unidad;
        if($unidad){
            try{
                $unidad->delete();
                return redirect()->back()->with('success', 'Se elimino la unidad' .$nombre. 'correctamente');
            }catch (QueryException $e) {
                return redirect()->back()->with('exception', 'La unidad'. $unidad->nombre_unidad.  'esta en uso');
            }
        }
        return redirect()->back()->withError('La unidad no fue encontrada');
        // $unidad = Unidad::findOrFail($id);
        // $unidad -> delete();
        // return redirect('unidades');
    }
}

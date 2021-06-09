<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;    
use Illuminate\Support\Facades\DB;

use App\Models\ItemGasto;

class ItemgastoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$itemsgastos = ItemGasto::all();
        $itemsgastos=ItemGasto::leftjoin('items_gasto as genericos','genericos.id','=','items_gasto.item_id')->select('items_gasto.*', 'genericos.nombre_item as pertenece_a')->get();
        return view("ITEM_GASTOS.visualizarItemgasto", compact('itemsgastos'));
        //$itemsgastos=ItemGasto::leftjoin('items_gasto','items_gasto.id','=','items_gasto.itemd_id')->get();
        //return view("ITEM_GASTOS.visualizarItemgasto", compact('itemsgastos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $items=ItemGasto::where('tipo_item','Generico')->get();

        return view("ITEM_GASTOS.crearItemgasto",compact('items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //aqui iran codigo de validaciones y para guardar en la BD
        //return $request->all();

        //$request->validate([
          //  'nombre_item' => 'required'
        //]);

        //$this->validate($request, [
        //    'nombre_item' => 'required|unique:posts|max:255',
        //]);
        $mensajes = [
            'tipo_item.required' => 'Debe de seleccionar el tipo de item',
            'nombre_item.required' => 'Debe de llenar el campo nombre',
            'min'   => 'El :attribute debe tener por lo menos :min caracteres.',
            'max'   => 'El :attribute no puede tener más de :max caracteres.',
            'regex' => 'El campo :attribute solo puede tener letras',
            'numeric'=> 'Debe de seleccionar el item generico al que pertenece',
            //'permisos.required' => 'Debe seleccionar por lo menos un permiso.',
        ];
        $this->validate($request, [
            
            'nombre_item'=>['required', 'min:2', 'max:255', 'regex:/^[\pL\s\-]+$/u'], 
            'tipo_item'=>'required',
            'item_id'=>'numeric',
            ], $mensajes);

        $itemsdegastos=new ItemGasto;
        $itemsdegastos->tipo_item=$request->tipo_item;
        $itemsdegastos->nombre_item=$request->nombre_item;
        if($request->exists('item_id')){
            $itemsdegastos->item_id=$request->item_id;
        }
        $itemsdegastos->save();
        return redirect()->route("itemsgastos.index")->with('confirm', 'El Item de Gasto a sido registrado correctamente');
        //return redirect('ITEM_GASTOS.visualizarItemgasto');
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

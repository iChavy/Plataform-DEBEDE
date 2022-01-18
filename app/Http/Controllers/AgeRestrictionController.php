<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller; 

use App\Models\AgeRestriction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AgeRestrictionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index2()
    {
        $agerestrictions = AgeRestriction::where('borrado',false)->get();
        if($agerestrictions->isEmpty()){
            return response()->json([
                'respuesta' => 'No se encuentran restricciones de edad']);
        }
        return view('crearJuego',compact('agerestrictions'));
    }
    public function index()
    {
        $agerestrictions = AgeRestriction::where('borrado',false)->get();
        if($agerestrictions->isEmpty()){
            return response()->json([
                'respuesta' => 'No se encuentran restricciones de edad']);
        }
        return view('juegos',compact('agerestrictions'));
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
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'Tipo_restriccion' => 'required|min:3|max:40|unique:age_restrictions',
            ],
            [
                'Tipo_restriccion.unique' => 'El tipo de restricción ya existe',
                'Tipo_restriccion.required' => 'Se debe ingresar la restriccion de edad',
                'Tipo_restriccion.min' => 'Debe ser de largo mínimo :min',
                'Tipo_restriccion.max' => 'Debe ser de largo máximo :max',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }

        $newAgeRestriction = new AgeRestriction();
        $newAgeRestriction->Tipo_restriccion = $request->Tipo_restriccion;
        $newAgeRestriction->borrado = false;
        $newAgeRestriction->save();

        return response()->json([
            'mensaje' => 'La restriccion de edad ha sido creado',
            'id' => $newAgeRestriction->id,
        ], 201);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $agerestriction = AgeRestriction::find($id);
        if(empty($agerestriction) or $agerestriction->borrado == true){
            return response()->json(['mensaje' => 'No se encuentra el id ingresado']);
        }

        return response($agerestriction, 200);
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
        $validator = Validator::make(
            $request->only(['Tipo_restriccion']),
            [
                'Tipo_restriccion' => 'required|min:3|max:40|unique:age_restrictions',
            ],
            [
                'Tipo_restriccion.unique' => 'El tipo de restricción ya existe',
                'Tipo_restriccion.required' => 'Se debe ingresar la restriccion de edad',
                'Tipo_restriccion.min' => 'Debe ser de largo mínimo :min',
                'Tipo_restriccion.max' => 'Debe ser de largo máximo :max',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors());
        }

        $agerestriction = AgeRestriction::find($id);
        if(empty($agerestriction)){
            return response()->json(['mensaje' => 'No se encuentra el id ingresado']);
        }

        if ($request->Tipo_restriccion == $agerestriction->Tipo_restriccion){
            return response()->json([
                "message" => "Los datos ingresados son iguales a los actuales."
            ], 404);
        }

        $agerestriction->Tipo_restriccion = $request->Tipo_restriccion;
        $agerestriction->save();
        return response()->json([
            'mensaje' => 'La restriccion de edad ha sido actualizada',
            'id' => $agerestriction->id,
        ], 200);
        
    }

    public function borrado($id)
    {
        $agerestriction = agerestriction::find($id);
        if(empty($agerestriction) or $agerestriction->borrado == true){
            return response()->json(['mensaje' => 'No se encuentra el id ingresado']);
        }
        $agerestriction->borrado = true;
        $agerestriction->save();
        return response()->json([
            'msg' => 'La valoración ha sido eliminada (soft)',
            'id' => $agerestriction->id,
        ], 200);
    }

    public function destroy($id)
    {
        $agerestriction = AgeRestriction::find($id);
        if(empty($agerestriction)){
            return response()->json(['El id ingresado no existe']);
        }
        $agerestriction->delete();
        return response()->json([
            'mensaje' => 'La restriccion de edad ha sido eliminada',
            'id' => $agerestriction->id,
        ], 200);
        
    }
}

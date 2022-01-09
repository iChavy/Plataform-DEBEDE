<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller; 

use App\Models\Functionality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FunctionalityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $functionalities = Functionality::all();
        if($functionalities->isEmpty()){
            return response()->json([
                'respuesta' => 'No se encuentran funcionalidades']);
        }
        return response($functionalities, 200);
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
                'Nombre' => 'required|min:4|max:100|unique:functionalities',
                'Descripcion' => 'required|min:10|max:200|unique:functionalities',
            ],
            [
                'Nombre.required' => 'Se debe ingresar el nombre de la funcionalidad',
                'Nombre.unique' => 'El nombre de la funcionalidad ya existe',
                'Nombre.min' => 'Debe ser de largo mínimo :min',
                'Nombre.max' => 'Debe ser de largo máximo :max',

                'Descripcion.required' => 'Se debe ingresar la descripción de la funcionalidad',
                'Descripcion.unique' => 'la descripción de la funcionalidad ya existe',
                'Descripcion.min' => 'Debe ser de largo mínimo :min',
                'Descripcion.max' => 'Debe ser de largo máximo :max',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }

        $newFunctionality = new Functionality();
        $newFunctionality->Nombre = $request->Nombre;
        $newFunctionality->Descripcion = $request->Descripcion;
        $newFunctionality->save();

        return response()->json([
            'mensaje' => 'La funcionalidad ha sido creada',
            'id' => $newFunctionality->id,
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
        $functionality = Functionality::find($id);
        if(empty($functionality)){
            return response()->json(['mensaje' => 'El id ingresado no existe']);
        }

        return response($functionality, 200);
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
            $request->all(),
            [
                'Nombre' => 'nullable|min:4|max:100|unique:functionalities',
                'Descripcion' => 'nullable|min:10|max:200|unique:functionalities',
            ],
            [
                'Nombre.unique' => 'El nombre de la funcionalidad ya existe',
                'Nombre.min' => 'Debe ser de largo mínimo :min',
                'Nombre.max' => 'Debe ser de largo máximo :max',

                'Descripcion.unique' => 'la descripción de la funcionalidad ya existe',
                'Descripcion.min' => 'Debe ser de largo mínimo :min',
                'Descripcion.max' => 'Debe ser de largo máximo :max',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }

        $functionality = Functionality::find($id);
        if(empty($functionality)){
            return response()->json(['mensaje' => 'El id ingresado no existe']);
        }

        if (($request->Nombre == $functionality->Nombre && $request->Descripcion == $functionality->Descripcion)|($request->Nombre == $functionality->Nombre)|($request->Descripcion == $functionality->Descripcion)){
            return response()->json([
                "mensaje" => "Los datos ingresados son iguales a los actuales."
            ], 404);
        }

        if (!empty($request->Nombre)){
            $functionality->Nombre = $request->Nombre;
        }

        if (!empty($request->Descripcion)){
            $functionality->Descripcion = $request->Descripcion;
        }
        
        $functionality->save();

        if (!empty($request->Nombre && $request->Descripcion)){
            return response()->json([
                'mensaje' => 'La funcionalidad ha sido modificado.',
                'id' => $functionality->id,
            ], 200);       
        }

        if (!empty($request->Nombre)){
            return response()->json(['mensaje' => 'El nombre de la funcionalidad ha sido actualizado',
            'id' => $functionality->id,],200);
        }

        return response()->json(['mensaje' => 'La descripción de la funcionalidad ha sido actualizado',
            'id' => $functionality->id,],200);        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $functionality = Functionality::find($id);
        if(empty($functionality)){
            return response()->json(['mensaje' => 'El id ingresado no existe']);
        }
        $functionality->delete();
        return response()->json([
            'mensaje' => 'La funcionalidad ha sido eliminada',
            'id' => $functionality->id,
        ], 200);
        
    }
}

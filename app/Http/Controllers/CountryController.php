<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller; 

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::all();
        if($countries->isEmpty()){
            return response()->json([
                'respuesta' => 'No se encuentran paises']);
        }
        return response($countries, 200);
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
                'Nombre' => 'required|min:4|max:60',
            ],
            [
                'Nombre.required' => 'Se debe ingresar el nombre del pais',
                'Nombre.min' => 'Debe ser de largo mínimo :min',
                'Nombre.max' => 'Debe ser de largo máximo :max',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }

        $newCountry = new Country();
        $newCountry->Nombre = $request->Nombre;
        $newCountry->save();

        return response()->json([
            'mensaje' => 'El pais ha sido creado',
            'id' => $newCountry->id,
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
        $country = Country::find($id);
        if(empty($country)){
            return response()->json(['mensaje' => 'No se encuentra el id ingresado']);
        }

        return response($country, 200);
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
            $request->only(['Nombre']),
            [
                'Nombre' => 'required|min:4|max:60',
            ],
            [
                'Nombre.required' => 'Se debe ingresar el nombre del pais',
                'Nombre.min' => 'Debe ser de largo mínimo :min',
                'Nombre.max' => 'Debe ser de largo máximo :max',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors());
        }

        $country = Country::find($id);
        if(empty($country)){
            return response()->json(['mensaje' => 'No se encuentra el id ingresado']);
        }

        if ($request->Nombre == $country->Nombre){
            return response()->json([
                "message" => "Los datos ingresados son iguales a los actuales."
            ], 404);
        }
        
        $country->Nombre = $request->Nombre;
        $country->save();
        return response()->json([
            'mensaje' => 'La restriccion de edad ha sido actualizada',
            'id' => $country->id,
        ], 200);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $country = Country::find($id);
        if(empty($country)){
            return response()->json(['mensaje' => 'El id ingresado no existe']);
        }
        $country->delete();
        return response()->json([
            'mensaje' => 'El pais ha sido eliminado',
            'id' => $country->id,
        ], 200);
        
    }
}

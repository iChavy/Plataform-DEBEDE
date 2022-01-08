<?php

namespace App\Http\Controllers;

use App\Models\GeographicRestriction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GeographicRestrictionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $geographicrestrictions = GeographicRestriction::all();
        if($geographicrestrictions->isEmpty()){
            return response()->json([
                'respuesta' => 'No se encuentran restricciones geográficas.']);
        }
        return response($geographicrestrictions, 200);
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
                'ID_Pais' => 'required|integer|exists:countries,id',
                'Codigo_Juego' => 'required|integer|exists:games,id',
            ],
            [
                'ID_Pais.required' => 'Se debe ingresar un ID de país.',
                'ID_Pais.integer' => 'Debe ser un entero.',
                'ID_Pais.exists' => 'El ID de país no existe.',
                'Codigo_Juego.required' => 'Se debe ingresar un juego.',
                'Codigo_Juego.integer' => 'Debe ser un entero.',
                'Codigo_Juego.exists' => 'El código de juego no existe.',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        $newGeographicRestriction = new GeographicRestriction();
        $newGeographicRestriction->ID_Pais = $request->ID_Pais;
        $newGeographicRestriction->Codigo_Juego = $request->Codigo_Juego;
        $newGeographicRestriction->save();

        return response()->json([
            'msg' => 'La restricción geográfica ha sido creada.',
            'id' => $newGeographicRestriction->id,
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
        $geographicrestriction = GeographicRestriction::find($id);
        if(empty($geographicrestriction)){
            return response()->json(['mensaje' => 'No se encuentra el id ingresado']);
        }
        return response($geographicrestriction, 200);
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
                'ID_Pais' => 'nullable|integer|exists:countries,id',
                'Codigo_Juego' => 'nullable|integer|exists:games,id',
            ],
            [
                'ID_Pais.integer' => 'Debe ser un entero.',
                'ID_Pais.exists' => 'El ID de país no existe.',
                'Codigo_Juego.integer' => 'Debe ser un entero.',
                'Codigo_Juego.exists' => 'El código de juego no existe.',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        $geographicrestriction = GeographicRestriction::find($id);
        if(empty($geographicrestriction)){
            return response()->json(['mensaje' => 'No se encuentra el id ingresado']);
        }

        if (($request->ID_Pais == $geographicrestriction->ID_Pais && $request->Codigo_Juego == $geographicrestriction->Codigo_Juego)|($request->ID_Pais == $geographicrestriction->ID_Pais)|($request->Codigo_Juego == $geographicrestriction->Codigo_Juego)){
            return response()->json([
                "message" => "Los datos ingresados son iguales a los actuales."
            ], 404);
        }
        if (!empty($request->ID_Pais)){
            $geographicrestriction->ID_Pais = $request->ID_Pais;
        }
        if (!empty($request->Codigo_Juego)){
            $geographicrestriction->Codigo_Juego = $request->Codigo_Juego;
        }
        $geographicrestriction->save();

        if (!empty($request->ID_Pais && $request->Codigo_Juego)){
            return response()->json([
                'msg' => 'La restricción geográfica ha sido modificada.',
                'id' => $geographicrestriction->id,
            ], 200);       
        }
      
        if (!empty($request->ID_Pais)){
            return response()->json(['mensaje' => 'El ID de país ha sido actualizado',
            'id' => $geographicrestriction->id,],200);
        }

        return response()->json(['mensaje' => 'El código de juego ha sido actualizado',
        'id' => $geographicrestriction->id,],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $geographicrestriction = GeographicRestriction::find($id);
        if(empty($geographicrestriction)){
            return response()->json(['mensaje' => 'No se encuentra el id ingresado']);
        }
        $geographicrestriction->delete();
        return response()->json([
            'msg' => 'La restricción geográfica ha sido eliminada',
            'id' => $geographicrestriction->id,
        ], 200);
    }
}

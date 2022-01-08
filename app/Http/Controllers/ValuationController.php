<?php

namespace App\Http\Controllers;

use App\Models\Valuation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ValuationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $valuations = Valuation::all();
        if($valuations->isEmpty()){
            return response()->json([
                'respuesta' => 'No se encuentran valoraciones.']);
        }
        return response($valuations, 200);
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
                'ID_Usuario' => 'required|integer|exists:users,id',
                'Codigo_Juego' => 'required|integer|exists:games,id',
                'Comentario' => 'nullable|min:1|max:500',
                'Like' => 'nullable|boolean',
            ],
            [
                'ID_Usuario.required' => 'Se debe ingresar un ID de usuario.',
                'ID_Usuario.integer' => 'Debe ser un entero.',
                'ID_Usuario.exists' => 'El ID de usuario no existe.',
                'Codigo_Juego.required' => 'Se debe ingresar un juego.',
                'Codigo_Juego.integer' => 'Debe ser un entero.',
                'Codigo_Juego.exists' => 'El código de juego no existe.',
                'Comentario.min' => 'Debe ser de largo mínimo :min',
                'Comentario.max' => 'Debe ser de largo máximo :max',
                'Like.boolean' => 'Debe ser un booleano.',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        $newValuation = new Valuation();
        $newValuation->ID_Usuario = $request->ID_Usuario;
        $newValuation->Codigo_Juego = $request->Codigo_Juego;
        $newValuation->Comentario = $request->Comentario;
        $newValuation->Like = $request->Like;
        $newValuation->save();

        return response()->json([
            'msg' => 'La valoración ha sido creada.',
            'id' => $newValuation->id,
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
        $valuation = Valuation::find($id);
        if(empty($valuation)){
            return response()->json(['mensaje' => 'No se encuentra el id ingresado']);
        }

        return response($valuation, 200);
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
                'ID_Usuario' => 'nullable|integer|exists:users,id',
                'Codigo_Juego' => 'nullable|integer|exists:games,id',
                'Comentario' => 'nullable|min:1|max:500',
                'Like' => 'nullable|boolean',
            ],
            [
                'ID_Usuario.integer' => 'Debe ser un entero.',
                'ID_Usuario.exists' => 'El ID de usuario no existe.',
                'Codigo_Juego.integer' => 'Debe ser un entero.',
                'Codigo_Juego.exists' => 'El código de juego no existe.',
                'Comentario.min' => 'Debe ser de largo mínimo :min',
                'Comentario.max' => 'Debe ser de largo máximo :max',
                'Like.boolean' => 'Debe ser un booleano.',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        $valuation = Valuation::find($id);
        if(empty($valuation)){
            return response()->json(['mensaje' => 'No se encuentra el id ingresado']);
        }

        if (($request->ID_Usuario == $valuation->ID_Usuario)|
        ($request->Codigo_Juego == $valuation->Codigo_Juego)|
        ($request->Comentario == $valuation->Comentario)|
        ($request->Like == $valuation->Like)){
            return response()->json([
                "message" => "Los datos ingresados son iguales a los actuales."
            ], 404);
        }
        if (!empty($request->ID_Usuario)){
            $valuation->ID_Usuario = $request->ID_Usuario;
        }
        if (!empty($request->Codigo_Juego)){
            $valuation->Codigo_Juego = $request->Codigo_Juego;
        }
        if (!empty($request->Comentario)){
            $valuation->Comentario = $request->Comentario;
        }
        if (!empty($request->Like)){
            $valuation->Like = $request->Like;
        }
        $valuation->save();
        return response()->json([
            'msg' => 'La valoración ha sido modificada.',
            'id' => $valuation->id,
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
        $valuation = Valuation::find($id);
        if(empty($valuation)){
            return response()->json(['mensaje' => 'No se encuentra el id ingresado']);
        }
        $valuation->delete();
        return response()->json([
            'msg' => 'La valoración ha sido eliminada',
            'id' => $valuation->id,
        ], 200);
    }
}

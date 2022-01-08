<?php

namespace App\Http\Controllers;

use App\Models\GameGenre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GameGenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gamegenres = GameGenre::all();
        if($gamegenres->isEmpty()){
            return response()->json([
                'respuesta' => 'No se encuentran juegos con tipo de género.']);
        }
        return response($gamegenres, 200);
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
                'ID_genero' => 'required|integer|exists:genders,id',
                'Codigo_Juego' => 'required|integer|exists:games,id',
            ],
            [
                'ID_genero.required' => 'Se debe ingresar un tipo de género.',
                'ID_genero.integer' => 'Debe ser un entero.',
                'ID_genero.exists' => 'El ID de tipo de género no existe.',
                'Codigo_Juego.required' => 'Se debe ingresar un juego.',
                'Codigo_Juego.integer' => 'Debe ser un entero.',
                'Codigo_Juego.exists' => 'El código de juego no existe.',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        $newGameGenre = new GameGenre();
        $newGameGenre->ID_genero = $request->ID_genero;
        $newGameGenre->Codigo_Juego = $request->Codigo_Juego;
        $newGameGenre->save();

        return response()->json([
            'msg' => 'El tipo de género ha sido asignado al juego.',
            'id' => $newGameGenre->id,
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
        $gamegenre = GameGenre::find($id);
        if(empty($gamegenre)){
            return response()->json(['mensaje' => 'No se encuentra el id ingresado']);
        }
        return response($gamegenre, 200);
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
                'ID_genero' => 'nullable|integer|exists:genders,id',
                'Codigo_Juego' => 'nullable|integer|exists:games,id',
            ],
            [
                'ID_genero.integer' => 'Debe ser un entero.',
                'ID_genero.exists' => 'El ID de tipo de género no existe.',
                'Codigo_Juego.integer' => 'Debe ser un entero.',
                'Codigo_Juego.exists' => 'El código de juego no existe.',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        $gamegenre = GameGenre::find($id);
        if(empty($gamegenre)){
            return response()->json(['mensaje' => 'No se encuentra el id ingresado']);
        }

        if (($request->ID_genero == $gamegenre->ID_genero && $request->Codigo_Juego == $gamegenre->Codigo_Juego)|($request->ID_genero == $gamegenre->ID_genero)|($request->Codigo_Juego == $gamegenre->Codigo_Juego)){
            return response()->json([
                "message" => "Los datos ingresados son iguales a los actuales."
            ], 404);
        }
        if (!empty($request->ID_genero)){
            $gamegenre->ID_genero = $request->ID_genero;
        }
        if (!empty($request->Codigo_Juego)){
            $gamegenre->Codigo_Juego = $request->Codigo_Juego;
        }
        $gamegenre->save();

        if (!empty($request->ID_genero && $request->Codigo_Juego)){
            return response()->json([
                'msg' => 'El tipo de género de un juego ha sido modificado.',
                'id' => $gamegenre->id,
            ], 200);       
        }
      
        if (!empty($request->ID_genero)){
            return response()->json(['mensaje' => 'El ID tipo de género ha sido actualizado',
            'id' => $gamegenre->id,],200);
        }

        return response()->json(['mensaje' => 'El código de juego ha sido actualizado',
        'id' => $gamegenre->id,],200);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gamegenre = GameGenre::find($id);
        if(empty($gamegenre)){
            return response()->json(['mensaje' => 'No se encuentra el id ingresado']);
        }
        $gamegenre->delete();
        return response()->json([
            'msg' => 'El tipo de género de un juego ha sido eliminado',
            'id' => $gamegenre->id,
        ], 200);
    }
}

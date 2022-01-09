<?php

namespace App\Http\Controllers;

use App\Models\GameWishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GameWishListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gamewishlists = GameWishList::where('borrado',false)->get();
        if($gamewishlists->isEmpty()){
            return response()->json([
                'respuesta' => 'No se encuentran listas de deseos con juegos.']);
        }
        return response($gamewishlists, 200);
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
                'ID_Lista' => 'required|integer|exists:wish_lists,id',
                'Codigo_Juego' => 'required|integer|exists:games,id',
            ],
            [
                'ID_Lista.required' => 'Se debe ingresar un ID de lista.',
                'ID_Lista.integer' => 'Debe ser un entero.',
                'ID_Lista.exists' => 'El ID de lista no existe.',
                'Codigo_Juego.required' => 'Se debe ingresar un juego.',
                'Codigo_Juego.integer' => 'Debe ser un entero.',
                'Codigo_Juego.exists' => 'El código de juego no existe.',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        $newGameWishList = new GameWishList();
        $newGameWishList->ID_Lista = $request->ID_Lista;
        $newGameWishList->Codigo_Juego = $request->Codigo_Juego;
        $newGameWishList->borrado = false;
        $newGameWishList->save();

        return response()->json([
            'msg' => 'La lista de deseos con juegos ha sido creada.',
            'id' => $newGameWishList->id,
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
        $gamewishlist = GameWishList::find($id);
        if(empty($gamewishlist) or $gamewishlist->borrado == true){
            return response()->json(['mensaje' => 'No se encuentra el id ingresado']);
        }
        return response($gamewishlist, 200);
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
                'ID_Lista' => 'nullable|integer|exists:wish_lists,id',
                'Codigo_Juego' => 'nullable|integer|exists:games,id',
            ],
            [
                'ID_Lista.integer' => 'Debe ser un entero.',
                'ID_Lista.exists' => 'El ID de lista no existe.',
                'Codigo_Juego.integer' => 'Debe ser un entero.',
                'Codigo_Juego.exists' => 'El código de juego no existe.',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        $gamewishlist = GameWishList::find($id);
        if(empty($gamewishlist)){
            return response()->json(['mensaje' => 'No se encuentra el id ingresado']);
        }

        if (($request->ID_Lista == $gamewishlist->ID_Lista && $request->Codigo_Juego == $gamewishlist->Codigo_Juego)|($request->ID_Lista == $gamewishlist->ID_Lista)|($request->Codigo_Juego == $gamewishlist->Codigo_Juego)){
            return response()->json([
                "message" => "Los datos ingresados son iguales a los actuales."
            ], 404);
        }
        if (!empty($request->ID_Lista)){
            $gamewishlist->ID_Lista = $request->ID_Lista;
        }
        if (!empty($request->Codigo_Juego)){
            $gamewishlist->Codigo_Juego = $request->Codigo_Juego;
        }
        $gamewishlist->save();

        if (!empty($request->ID_Lista && $request->Codigo_Juego)){
            return response()->json([
                'msg' => 'La lista de deseos con juegos ha sido modificada.',
                'id' => $gamewishlist->id,
            ], 200);       
        }
      
        if (!empty($request->ID_Lista)){
            return response()->json(['mensaje' => 'El ID de lista ha sido actualizado',
            'id' => $gamewishlist->id,],200);
        }

        return response()->json(['mensaje' => 'El código de juego ha sido actualizado',
        'id' => $gamewishlist->id,],200);
    }

    public function borrado($id)
    {
        $gamewishlist = GameWishList::find($id);
        if(empty($gamewishlist) or $gamewishlist->borrado == true){
            return response()->json(['mensaje' => 'No se encuentra el id ingresado']);
        }
        $gamewishlist->borrado = true;
        $gamewishlist->save();
        return response()->json([
            'msg' => 'La valoración ha sido eliminada (soft)',
            'id' => $gamewishlist->id,
        ], 200);
    }
    
    public function destroy($id)
    {
        $gamewishlist = GameWishList::find($id);
        if(empty($gamewishlist)){
            return response()->json(['mensaje' => 'No se encuentra el id ingresado']);
        }
        $gamewishlist->delete();
        return response()->json([
            'msg' => 'La lista de deseos con juegos ha sido eliminada',
            'id' => $gamewishlist->id,
        ], 200);
    }
}

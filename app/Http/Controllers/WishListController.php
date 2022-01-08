<?php

namespace App\Http\Controllers;

use App\Models\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WishListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wishlists = WishList::all();
        if($wishlists->isEmpty()){
            return response()->json([
                'respuesta' => 'No se encuentran listas de deseo.']);
        }
        return response($wishlists, 200);
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
                'NombreLista' => 'required|min:1|max:100',
            ],
            [
                'ID_Usuario.required' => 'Se debe ingresar un ID de usuario.',
                'ID_Usuario.integer' => 'Debe ser un entero.',
                'ID_Usuario.exists' => 'El ID de usuario no existe.',
                'NombreLista.required' => 'Se debe ingresar un nombre de la lista de deseo.',
                'NombreLista.min' => 'Debe ser de largo mínimo :min',
                'NombreLista.max' => 'Debe ser de largo máximo :max',
 
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        $newWishList = new WishList();
        $newWishList->ID_Usuario = $request->ID_Usuario;
        $newWishList->NombreLista = $request->NombreLista;
        $newWishList->save();

        return response()->json([
            'msg' => 'La lista de deseo ha sido creada.',
            'id' => $newWishList->id,
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
        $wishlist = WishList::find($id);
        if(empty($wishlist)){
            return response()->json(['mensaje' => 'No se encuentra el id ingresado']);
        }
        return response($wishlist, 200);
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
                'ID_Usuario' => 'nullable|integer|exists:users,id',
                'NombreLista' => 'nullable|min:1|max:100',
            ],
            [
                'ID_Usuario.integer' => 'Debe ser un entero.',
                'ID_Usuario.exists' => 'El ID de usuario no existe.',
                'NombreLista.min' => 'Debe ser de largo mínimo :min',
                'NombreLista.max' => 'Debe ser de largo máximo :max',
 
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        $wishlist = WishList::find($id);
        if(empty($wishlist)){
            return response()->json(['mensaje' => 'No se encuentra el id ingresado']);
        }

        if (($request->ID_Usuario == $wishlist->ID_Usuario && $request->NombreLista == $wishlist->NombreLista)|($request->ID_Usuario == $wishlist->ID_Usuario)|($request->NombreLista == $wishlist->NombreLista)){
            return response()->json([
                "message" => "Los datos ingresados son iguales a los actuales."
            ], 404);
        }
        if (!empty($request->ID_Usuario)){
            $wishlist->ID_Usuario = $request->ID_Usuario;
        }
        if (!empty($request->NombreLista)){
            $wishlist->NombreLista = $request->NombreLista;
        }
        $wishlist->save();

        if (!empty($request->ID_Usuario && $request->NombreLista)){
            return response()->json([
                'msg' => 'La lista de deseo ha sido modificada.',
                'id' => $wishlist->id,
            ], 200);       
        }
      
        if (!empty($request->ID_Usuario)){
            return response()->json(['mensaje' => 'El ID de usuario ha sido actualizado',
            'id' => $wishlist->id,],200);
        }

        return response()->json(['mensaje' => 'El nombre de la lista ha sido actualizado',
        'id' => $wishlist->id,],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $wishlist = WishList::find($id);
        if(empty($wishlist)){
            return response()->json(['mensaje' => 'No se encuentra el id ingresado']);
        }
        $wishlist->delete();
        return response()->json([
            'msg' => 'La lista de deseo ha sido eliminada',
            'id' => $wishlist->id,
        ], 200);
    }
}

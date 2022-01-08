<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller; 

use App\Models\UserCoin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserCoinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usercoins = UserCoin::all();
        if($usercoins->isEmpty()){
            return response()->json([
                'respuesta' => 'No se encuentran monedas para usuario']);
        }
        return response($usercoins, 200);
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
                'ID_paquete' => 'required|integer|exists:coin_packs,id',
            ],
            [
                'ID_Usuario.required' => 'Se debe ingresar el ID del usuario',
                'ID_Usuario.integer' => 'Debe ser un entero',
                'ID_Usuario.exists' => 'El ID del usuario ingresado no existe',

                'ID_paquete.required' => 'Se debe ingresar el ID del paquete',
                'ID_paquete.integer' => 'Debe ser un entero',
                'ID_paquete.exists' => 'El ID del paquete ingresado no existe',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }

        $newUserCoin = new UserCoin();
        $newUserCoin->ID_Usuario = $request->ID_Usuario;
        $newUserCoin->ID_paquete = $request->ID_paquete;
        $newUserCoin->save();

        return response()->json([
            'mensaje' => 'La modeda para usuario ha sido creada',
            'id' => $newUserCoin->id,
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
        $usercoin = UserCoin::find($id);
        if(empty($usercoin)){
            return response()->json(['mensaje' => 'El ID ingresado no existe']);
        }

        return response($usercoin, 200);
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
                'ID_paquete' => 'nullable|integer|exists:coin_packs,id',
            ],
            [
                'ID_Usuario.integer' => 'Debe ser un entero',
                'ID_Usuario.exists' => 'El ID del usuario ingresado no existe',

                'ID_paquete.integer' => 'Debe ser un entero',
                'ID_paquete.exists' => 'El ID del paquete ingresado no existe',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }

        $usercoin = UserCoin::find($id);
        if(empty($usercoin)){
            return response()->json(['mensaje' => 'El ID ingresado no existe']);
        }

        if (($request->ID_Usuario == $usercoin->ID_Usuario && $request->ID_paquete == $usercoin->ID_paquete)|($request->ID_Usuario == $usercoin->ID_Usuario)|($request->ID_paquete == $usercoin->ID_paquete)){
            return response()->json([
                "mensaje" => "Los datos ingresados son iguales a los actuales."
            ], 404);
        }

        if (!empty($request->ID_Usuario)){
            $usercoin->ID_Usuario = $request->ID_Usuario;
        }

        if (!empty($request->ID_paquete)){
            $usercoin->ID_paquete = $request->ID_paquete;
        }
        
        $usercoin->save();

        if (!empty($request->ID_Usuario && $request->ID_paquete)){
            return response()->json([
                'mensaje' => 'La moneda para usuario ha sido modificada',
                'id' => $usercoin->id,
            ], 200);       
        }

        if (!empty($request->ID_Usuario)){
            return response()->json(['mensaje' => 'El Id del usuario ha sido actualizado',
            'id' => $usercoin->id,],200);
        }

        return response()->json(['mensaje' => 'El Id del paquete ha sido actualizado',
            'id' => $usercoin->id,],200);        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usercoin = UserCoin::find($id);
        if(empty($usercoin)){
            return response()->json(['mensaje' => 'El ID ingresado no existe']);
        }
        $usercoin->delete();
        return response()->json([
            'mensaje' => 'La modena para usuario ha sido eliminada',
            'id' => $usercoin->id,
        ], 200);
        
    }
}
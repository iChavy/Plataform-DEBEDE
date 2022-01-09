<?php

namespace App\Http\Controllers;

use App\Models\GameTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GameTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gametransactions = GameTransaction::where('borrado',false)->get();
        if($gametransactions->isEmpty()){
            return response()->json([
                'respuesta' => 'No se encuentran transacciones por juegos.']);
        }
        return response($gametransactions, 200);
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
                'ID_Transaccion' => 'required|integer|exists:transactions,id',
                'Codigo_Juego' => 'required|integer|exists:games,id',
            ],
            [
                'ID_Transaccion.required' => 'Se debe ingresar un tipo de género.',
                'ID_Transaccion.integer' => 'Debe ser un entero.',
                'ID_Transaccion.exists' => 'El ID de tipo de género no existe.',
                'Codigo_Juego.required' => 'Se debe ingresar un juego.',
                'Codigo_Juego.integer' => 'Debe ser un entero.',
                'Codigo_Juego.exists' => 'El código de juego no existe.',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        $newGameTransaction = new GameTransaction();
        $newGameTransaction->ID_Transaccion = $request->ID_Transaccion;
        $newGameTransaction->Codigo_Juego = $request->Codigo_Juego;
        $newGameTransaction->borrado = false;
        $newGameTransaction->save();

        return response()->json([
            'msg' => 'La transacción ha sido asignada al juego.',
            'id' => $newGameTransaction->id,
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
        $gametransaction = GameTransaction::find($id);
        if(empty($gametransaction) or $gametransaction->borrado == true){
            return response()->json(['mensaje' => 'No se encuentra el id ingresado']);
        }
        return response($gametransaction, 200);
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
                'ID_Transaccion' => 'nullable|integer|exists:transactions,id',
                'Codigo_Juego' => 'nullable|integer|exists:games,id',
            ],
            [
                'ID_Transaccion.integer' => 'Debe ser un entero.',
                'ID_Transaccion.exists' => 'El ID de transacción no existe.',
                'Codigo_Juego.integer' => 'Debe ser un entero.',
                'Codigo_Juego.exists' => 'El código de juego no existe.',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        $gametransaction = GameTransaction::find($id);
        if(empty($gametransaction)){
            return response()->json(['mensaje' => 'No se encuentra el id ingresado']);
        }

        if (($request->ID_Transaccion == $gametransaction->ID_Transaccion && $request->Codigo_Juego == $gametransaction->Codigo_Juego)|($request->ID_Transaccion == $gametransaction->ID_Transaccion)|($request->Codigo_Juego == $gametransaction->Codigo_Juego)){
            return response()->json([
                "message" => "Los datos ingresados son iguales a los actuales."
            ], 404);
        }
        if (!empty($request->ID_Transaccion)){
            $gametransaction->ID_Transaccion = $request->ID_Transaccion;
        }
        if (!empty($request->Codigo_Juego)){
            $gametransaction->Codigo_Juego = $request->Codigo_Juego;
        }
        $gametransaction->save();

        if (!empty($request->ID_Transaccion && $request->Codigo_Juego)){
            return response()->json([
                'msg' => 'La transacción por un juego ha sido modificada.',
                'id' => $gametransaction->id,
            ], 200);       
        }
      
        if (!empty($request->ID_Transaccion)){
            return response()->json(['mensaje' => 'El ID transacción ha sido actualizado',
            'id' => $gametransaction->id,],200);
        }

        return response()->json(['mensaje' => 'El código de juego ha sido actualizado',
        'id' => $gametransaction->id,],200);
    }

    public function borrado($id)
    {
        $gametransaction = GameTransaction::find($id);
        if(empty($gametransaction) or $gametransaction->borrado == true){
            return response()->json(['mensaje' => 'No se encuentra el id ingresado']);
        }
        $gametransaction->borrado = true;
        $gametransaction->save();
        return response()->json([
            'msg' => 'La valoración ha sido eliminada (soft)',
            'id' => $gametransaction->id,
        ], 200);
    }
    
    public function destroy($id)
    {
        $gametransaction = GameTransaction::find($id);
        if(empty($gametransaction)){
            return response()->json(['mensaje' => 'No se encuentra el id ingresado']);
        }
        $gametransaction->delete();
        return response()->json([
            'msg' => 'La transacción por un juego ha sido eliminada',
            'id' => $gametransaction->id,
        ], 200);
    }
}

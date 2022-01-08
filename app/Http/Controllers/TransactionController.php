<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller; 

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::all();
        if($transactions->isEmpty()){
            return response()->json([
                'respuesta' => 'No se encuentran transacciones']);
        }
        return response($transactions, 200);
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
                'Fecha' => 'required|date',
            ],
            [
                'ID_Usuario.required' => 'Se debe ingresar el ID del usuario',
                'ID_Usuario.integer' => 'Debe ser un entero',
                'ID_Usuario.exists' => 'El ID del usuario ingresado no existe',

                'Fecha.required' => 'Se debe ingresar la fecha',
                'Fecha.date' => 'Debe ser tipo date, ej: AAAA-MM-DD HH:MM:SS',
                'Fecha.exists' => 'La fecha ingresada no existe',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }

        $newTransaction = new Transaction();
        $newTransaction->ID_Usuario = $request->ID_Usuario;
        $newTransaction->Fecha = $request->Fecha;
        $newTransaction->save();

        return response()->json([
            'mensaje' => 'La transacción ha sido creada',
            'id' => $newTransaction->id,
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
        $transaction = Transaction::find($id);
        if(empty($transaction)){
            return response()->json(['mensaje' => 'El ID ingresado no existe']);
        }

        return response($transaction, 200);
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
                'Fecha' => 'nullable|date',
            ],
            [
                'ID_Usuario.integer' => 'Debe ser un entero',
                'ID_Usuario.exists' => 'El ID del usuario ingresado no existe',

                'Fecha.date' => 'Debe ser tipo date, ej: AAAA-MM-DD HH:MM:SS',
                'Fecha.exists' => 'La fecha ingresada no existe',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }

        $transaction = Transaction::find($id);
        if(empty($transaction)){
            return response()->json(['mensaje' => 'El ID ingresado no existe']);
        }

        if (($request->ID_Usuario == $transaction->ID_Usuario && $request->Fecha == $transaction->Fecha)|($request->ID_Usuario == $transaction->ID_Usuario)|($request->Fecha == $transaction->Fecha)){
            return response()->json([
                "mensaje" => "Los datos ingresados son iguales a los actuales."
            ], 404);
        }

        if (!empty($request->ID_Usuario)){
            $transaction->ID_Usuario = $request->ID_Usuario;
        }

        if (!empty($request->Fecha)){
            $transaction->Fecha = $request->Fecha;
        }
        
        $transaction->save();

        if (!empty($request->ID_Usuario && $request->Fecha)){
            return response()->json([
                'mensaje' => 'La transacción ha sido modificada',
                'id' => $transaction->id,
            ], 200);       
        }

        if (!empty($request->ID_Usuario)){
            return response()->json(['mensaje' => 'El Id del usuario ha sido actualizado',
            'id' => $transaction->id,],200);
        }

        return response()->json(['mensaje' => 'la fecha ha sido actualizada',
            'id' => $transaction->id,],200);        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaction = Transaction::find($id);
        if(empty($transaction)){
            return response()->json(['mensaje' => 'El ID ingresado no existe']);
        }
        $transaction->delete();
        return response()->json([
            'mensaje' => 'La transacción ha sido eliminada',
            'id' => $transaction->id,
        ], 200);
        
    }
}
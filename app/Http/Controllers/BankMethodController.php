<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller; 

use App\Models\BankMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BankMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bankmethods = BankMethod::where('borrado',false)->get();
        if($bankmethods->isEmpty()){
            return response()->json([
                'respuesta' => 'No se encuentran métodos del banco']);
        }
        return response($bankmethods, 200);
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
                'ID_Banco' => 'required|integer|exists:banks,id',
                'ID_Metodo' => 'required|integer|exists:payment_methods,id',
            ],
            [
                'ID_Banco.required' => 'Se debe ingresar el ID del banco',
                'ID_Banco.integer' => 'Debe ser un entero',
                'ID_Banco.exists' => 'El ID del banco ingresado no existe',


                'ID_Metodo.required' => 'Se debe ingresar el ID del método',
                'ID_Metodo.integer' => 'Debe ser un entero',
                'ID_Metodo.exists' => 'El ID del método ingresado no existe',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }

        $newBankMethod = new BankMethod();
        $newBankMethod->ID_Banco = $request->ID_Banco;
        $newBankMethod->ID_Metodo = $request->ID_Metodo;
        $newBankMethod->borrado = false;
        $newBankMethod->save();

        return response()->json([
            'mensaje' => 'El método del banco ha sido creado',
            'id' => $newBankMethod->id,
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
        $bankmethod = BankMethod::find($id);
        if(empty($bankmethod) or $bankmethod->borrado == true){
            return response()->json(['mensaje' => 'El id ingresado no existe']);
        }

        return response($bankmethod, 200);
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
                'ID_Banco' => 'nullable|integer|exists:banks,id',
                'ID_Metodo' => 'nullable|integer|exists:payment_methods,id',
            ],
            [
                'ID_Banco.integer' => 'Debe ser un entero',
                'ID_Banco.exists' => 'El ID del banco ingresado no existe',

                'ID_Metodo.integer' => 'Debe ser un entero',
                'ID_Metodo.exists' => 'El ID del método ingresado no existe',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }

        $bankmethod = BankMethod::find($id);
        if(empty($bankmethod)){
            return response()->json(['mensaje' => 'El id ingresado no existe']);
        }

        if (($request->ID_Banco == $bankmethod->ID_Banco && $request->ID_Metodo == $bankmethod->ID_Metodo)|($request->ID_Banco == $bankmethod->ID_Banco)|($request->ID_Metodo == $bankmethod->ID_Metodo)){
            return response()->json([
                "mensaje" => "Los datos ingresados son iguales a los actuales."
            ], 404);
        }

        if (!empty($request->ID_Banco)){
            $bankmethod->ID_Banco = $request->ID_Banco;
        }

        if (!empty($request->ID_Metodo)){
            $bankmethod->ID_Metodo = $request->ID_Metodo;
        }
        
        $bankmethod->save();

        if (!empty($request->ID_Banco && $request->ID_Metodo)){
            return response()->json([
                'mensaje' => 'El metodo del banco ha sido modificado',
                'id' => $bankmethod->id,
            ], 200);       
        }

        if (!empty($request->ID_Banco)){
            return response()->json(['mensaje' => 'El Id del banco ha sido actualizado',
            'id' => $bankmethod->id,],200);
        }

        return response()->json(['mensaje' => 'El Id del método ha sido actualizado',
            'id' => $bankmethod->id,],200);        
        
    }

    public function borrado($id)
    {
        $bankmethod = BankMethod::find($id);
        if(empty($bankmethod) or $bankmethod->borrado == true){
            return response()->json(['mensaje' => 'No se encuentra el id ingresado']);
        }
        $bankmethod->borrado = true;
        $bankmethod->save();
        return response()->json([
            'msg' => 'La valoración ha sido eliminada (soft)',
            'id' => $bankmethod->id,
        ], 200);
    }
    
    public function destroy($id)
    {
        $bankmethod = BankMethod::find($id);
        if(empty($bankmethod)){
            return response()->json(['mensaje' => 'El id ingresado no existe']);
        }
        $bankmethod->delete();
        return response()->json([
            'mensaje' => 'El método del banco ha sido eliminado',
            'id' => $bankmethod->id,
        ], 200);
        
    }
}
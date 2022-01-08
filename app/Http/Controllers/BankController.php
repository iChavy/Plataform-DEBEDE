<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller; 

use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banks = Bank::all();
        if($banks->isEmpty()){
            return response()->json([
                'respuesta' => 'No se encuentran bancos.']);
        }
        return response($banks, 200);
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
                'Nombre' => 'required|min:2|max:100',
            ],
            [
                'Nombre.required' => 'Se debe ingresar el nombre del banco.',
                'Nombre.min' => 'Debe ser de largo mínimo :min',
                'Nombre.max' => 'Debe ser de largo máximo :max',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        $newBank = new Bank();
        $newBank->Nombre = $request->Nombre;
        $newBank->save();

        return response()->json([
            'msg' => 'El banco ha sido creado.',
            'id' => $newBank->id,
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
        $bank = Bank::find($id);
        if(empty($bank)){
            return response()->json(['mensaje' => 'No se encuentra el id ingresado']);
        }
        return response($bank, 200);
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
                'Nombre' => 'required|min:2|max:100',
            ],
            [
                'Nombre.required' => 'Se debe ingresar el nombre del banco.',
                'Nombre.min' => 'Debe ser de largo mínimo :min',
                'Nombre.max' => 'Debe ser de largo máximo :max',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors());
        }
        $bank = Bank::find($id);
        if(empty($bank)){
            return response()->json(['mensaje' => 'No se encuentra el id ingresado']);
        }
        if ($request->Nombre == $bank->Nombre){
            return response()->json([
                "message" => "Los datos ingresados son iguales a los actuales."
            ], 404);
        }
        $bank->Nombre = $request->Nombre;
        $bank->save();
        return response()->json([
            'msg' => 'El nombre del banco ha sido editado.',
            'id' => $bank->id,
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
        $bank = Bank::find($id);
        if(empty($bank)){
            return response()->json(['mensaje' => 'No se encuentra el id ingresado']);
        }
        $bank->delete();
        return response()->json([
            'msg' => 'El banco ha sido eliminado',
            'id' => $bank->id,
        ], 200);
        
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\CoinPack;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CoinPackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coinpacks = CoinPack::where('borrado',false)->get();
        if($coinpacks->isEmpty()){
            return response()->json([
                'respuesta' => 'No se encuentran paquetes de monedas.']);
        }
        return response($coinpacks, 200);
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
                'Cantidad' => 'required|integer',
            ],
            [
                'Cantidad.required' => 'Se debe ingresar la cantidad de monedas.',
                'Cantidad.integer' => 'Debe ser un entero.',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        $newCoinPack = new CoinPack();
        $newCoinPack->Cantidad = $request->Cantidad;
        $newCoinPack->borrado = false;
        $newCoinPack->save();

        return response()->json([
            'msg' => 'El paquete de monedas ha sido creado.',
            'id' => $newCoinPack->id,
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
        $coinpack = CoinPack::find($id);
        if(empty($coinpack) or $coinpack->borrado == true){
            return response()->json(['mensaje' => 'No se encuentra el id ingresado']);
        }
        return response($coinpack, 200);
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
            $request->only(['Cantidad']),
            [
                'Cantidad' => 'required|integer',
            ],
            [
                'Cantidad.required' => 'Se debe ingresar la cantidad de monedas.',
                'Cantidad.integer' => 'Debe ser un entero.',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors());
        }
        $coinpack = CoinPack::find($id);
        if(empty($coinpack)){
            return response()->json(['mensaje' => 'No se encuentra el id ingresado']);
        }
        if ($request->Cantidad == $coinpack->Cantidad){
            return response()->json([
                "message" => "Los datos ingresados son iguales a los actuales."
            ], 404);
        }
        $coinpack->Cantidad = $request->Cantidad;
        $coinpack->save();
        return response()->json([
            'msg' => 'El paquete de monedas ha sido editado.',
            'id' => $coinpack->id,
        ], 200);
    }

    public function borrado($id)
    {
        $coinpack = CoinPack::find($id);
        if(empty($coinpack) or $coinpack->borrado == true){
            return response()->json(['mensaje' => 'No se encuentra el id ingresado']);
        }
        $coinpack->borrado = true;
        $coinpack->save();
        return response()->json([
            'msg' => 'La valoración ha sido eliminada (soft)',
            'id' => $coinpack->id,
        ], 200);
    }
    
    public function destroy($id)
    {
        $coinpack = CoinPack::find($id);
        if(empty($coinpack)){
            return response()->json(['mensaje' => 'No se encuentra el id ingresado']);
        }
        $coinpack->delete();
        return response()->json([
            'msg' => 'El paquete de monedas ha sido eliminado',
            'id' => $coinpack->id,
        ], 200);
    }
}

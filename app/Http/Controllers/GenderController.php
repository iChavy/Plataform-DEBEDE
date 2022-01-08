<?php

namespace App\Http\Controllers;

use App\Models\Gender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class GenderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $genders = Gender::all();
        if($genders->isEmpty()){
            return response()->json([
                'respuesta' => 'No se encuentran géneros.',
            ]);
        }
        return response($genders, 200);
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
                'Tipo_genero' => 'required|min:3|max:50',
            ],
            [
                'Tipo_genero.required' => 'Se debe ingresar el nombre del género del juego.',
                'Tipo_genero.min' => 'Debe ser de largo mínimo :min',
                'Tipo_genero.max' => 'Debe ser de largo máximo :max',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        $newGender = new Gender();
        $newGender->Tipo_genero = $request->Tipo_genero;
        $newGender->save();

        return response()->json([
            'msg' => 'El tipo de género ha sido creado.',
            'id' => $newGender->id,
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
        $gender = Gender::find($id);
        if(empty($gender)){
            return response()->json(['mensaje' => 'No se encuentra el id ingresado']);
        }
        return response($gender, 200);
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
            $request->only(['Tipo_genero']),
            [
                'Tipo_genero' => 'required|min:3|max:50',
            ],
            [
                'Tipo_genero.required' => 'Se debe ingresar el nombre del género del juego.',
                'Tipo_genero.min' => 'Debe ser de largo mínimo :min',
                'Tipo_genero.max' => 'Debe ser de largo máximo :max',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors());
        }
        $gender = Gender::find($id);
        if(empty($gender)){
            return response()->json(['mensaje' => 'No se encuentra el id ingresado']);
        }
        if ($request->Tipo_genero == $gender->Tipo_genero){
            return response()->json([
                "message" => "Los datos ingresados son iguales a los actuales."
            ], 404);
        }
        $gender->Tipo_genero = $request->Tipo_genero;
        $gender->save();
        return response()->json([
            'msg' => 'El tipo de género ha sido creado.',
            'id' => $gender->id,
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
        $gender = Gender::find($id);
        if(empty($gender)){
            return response()->json(['mensaje' => 'No se encuentra el id ingresado']);
        }
        $gender->delete();
        return response()->json([
            'msg' => 'El tipo de género ha sido eliminado',
            'id' => $gender->id,
        ], 200);
    }
}

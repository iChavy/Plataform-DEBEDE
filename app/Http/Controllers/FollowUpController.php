<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller; 

use App\Models\FollowUp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FollowUpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $followups = FollowUp::all();
        if($followups->isEmpty()){
            return response()->json([
                'respuesta' => 'No se encuentran seguimientos']);
        }
        return response($followups, 200);
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
                'ID_Usuario1' => 'required|integer|exists:users,id',
                'ID_Usuario2' => 'required|integer|exists:users,id',
            ],
            [
                'ID_Usuario1.required' => 'Se debe ingresar el ID del usuario 1',
                'ID_Usuario1.integer' => 'Debe ser un entero',
                'ID_Usuario1.exists' => 'El ID del usuario 1 ingresado no existe',

                'ID_Usuario2.required' => 'Se debe ingresar el ID del usuario 2',
                'ID_Usuario2.integer' => 'Debe ser un entero',
                'ID_Usuario2.exists' => 'El ID del usuario 2 ingresado no existe',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }

        $newFollowUp = new FollowUp();
        $newFollowUp->ID_Usuario1 = $request->ID_Usuario1;
        $newFollowUp->ID_Usuario2 = $request->ID_Usuario2;
        $newFollowUp->save();

        return response()->json([
            'mensaje' => 'El seguimiento ha sido creado',
            'id' => $newFollowUp->id,
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
        $followup = FollowUp::find($id);
        if(empty($followup)){
            return response()->json(['mensaje' => 'El ID ingresado no existe']);
        }

        return response($followup, 200);
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
                'ID_Usuario1' => 'nullable|integer|exists:users,id',
                'ID_Usuario2' => 'nullable|integer|exists:users,id',
            ],
            [
                'ID_Usuario1.integer' => 'Debe ser un entero',
                'ID_Usuario1.exists' => 'El ID del usuario 1 ingresado no existe',

                'ID_Usuario2.integer' => 'Debe ser un entero',
                'ID_Usuario2.exists' => 'El ID del usuario 2 ingresado no existe',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }

        $followup = FollowUp::find($id);
        if(empty($followup)){
            return response()->json(['mensaje' => 'El ID ingresado no existe']);
        }

        if (($request->ID_Usuario1 == $followup->ID_Usuario1 && $request->ID_Usuario2 == $followup->ID_Usuario2)|($request->ID_Usuario1 == $followup->ID_Usuario1)|($request->ID_Usuario2 == $followup->ID_Usuario2)){
            return response()->json([
                "mensaje" => "Los datos ingresados son iguales a los actuales."
            ], 404);
        }

        if (!empty($request->ID_Usuario1)){
            $followup->ID_Usuario1 = $request->ID_Usuario1;
        }

        if (!empty($request->ID_Usuario2)){
            $followup->ID_Usuario2 = $request->ID_Usuario2;
        }
        
        $followup->save();

        if (!empty($request->ID_Usuario1 && $request->ID_Usuario2)){
            return response()->json([
                'mensaje' => 'El seguimiento ha sido modificado',
                'id' => $followup->id,
            ], 200);       
        }

        if (!empty($request->ID_Usuario1)){
            return response()->json(['mensaje' => 'El Id del usuario 1 ha sido actualizado',
            'id' => $followup->id,],200);
        }

        return response()->json(['mensaje' => 'El Id del usuario 2 ha sido actualizado',
            'id' => $followup->id,],200);        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $followup = FollowUp::find($id);
        if(empty($followup)){
            return response()->json(['mensaje' => 'El ID ingresado no existe']);
        }
        $followup->delete();
        return response()->json([
            'mensaje' => 'El seguimiento ha sido eliminado',
            'id' => $followup->id,
        ], 200);
        
    }
}
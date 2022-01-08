<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller; 

use App\Models\RoleFunctionality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleFunctionalityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rolefunctionalities = RoleFunctionality::all();
        if($rolefunctionalities->isEmpty()){
            return response()->json([
                'respuesta' => 'No se encuentran Funcionalidades para Rol']);
        }
        return response($rolefunctionalities, 200);
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
                'ID_funcionalidad' => 'required|integer|exists:functionalities,id',
                'ID_Rol' => 'required|integer|exists:roles,id',
            ],
            [
                'ID_funcionalidad.required' => 'Se debe ingresar el ID de la funcionalidad',
                'ID_funcionalidad.integer' => 'Debe ser un entero',
                'ID_funcionalidad.exists' => 'El ID de la funcionalidad ingresada no existe',

                'ID_Rol.required' => 'Se debe ingresar el ID del rol',
                'ID_Rol.integer' => 'Debe ser un entero',
                'ID_Rol.exists' => 'El ID del rol ingresado no existe',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }

        $newRoleFunctionality = new RoleFunctionality();
        $newRoleFunctionality->ID_funcionalidad = $request->ID_funcionalidad;
        $newRoleFunctionality->ID_Rol = $request->ID_Rol;
        $newRoleFunctionality->save();

        return response()->json([
            'mensaje' => 'La funcionalidad del rol ha sido creada',
            'id' => $newRoleFunctionality->id,
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
        $rolefunctionality = RoleFunctionality::find($id);
        if(empty($rolefunctionality)){
            return response()->json(['mensaje' => 'El ID ingresado no existe']);
        }

        return response($rolefunctionality, 200);
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
                'ID_funcionalidad' => 'nullable|integer|exists:functionalities,id',
                'ID_Rol' => 'nullable|integer|exists:roles,id',
            ],
            [
                'ID_funcionalidad.integer' => 'Debe ser un entero',
                'ID_funcionalidad.exists' => 'El ID de la funcionalidad ingresada no existe',

                'ID_Rol.integer' => 'Debe ser un entero',
                'ID_Rol.exists' => 'El ID del rol ingresado no existe',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }

        $rolefunctionality = RoleFunctionality::find($id);
        if(empty($rolefunctionality)){
            return response()->json(['mensaje' => 'El ID ingresado no existe']);
        }

        if (($request->ID_funcionalidad == $rolefunctionality->ID_funcionalidad && $request->ID_Rol == $rolefunctionality->ID_Rol)|($request->ID_funcionalidad == $rolefunctionality->ID_funcionalidad)|($request->ID_Rol == $rolefunctionality->ID_Rol)){
            return response()->json([
                "mensaje" => "Los datos ingresados son iguales a los actuales."
            ], 404);
        }

        if (!empty($request->ID_funcionalidad)){
            $rolefunctionality->ID_funcionalidad = $request->ID_funcionalidad;
        }

        if (!empty($request->ID_Rol)){
            $rolefunctionality->ID_Rol = $request->ID_Rol;
        }
        
        $rolefunctionality->save();

        if (!empty($request->ID_funcionalidad && $request->ID_Rol)){
            return response()->json([
                'mensaje' => 'La funcionalidad del rol ha sido modificada',
                'id' => $rolefunctionality->id,
            ], 200);       
        }

        if (!empty($request->ID_funcionalidad)){
            return response()->json(['mensaje' => 'El Id de la funcionalidad ha sido actualizada',
            'id' => $rolefunctionality->id,],200);
        }

        return response()->json(['mensaje' => 'El Id del rol ha sido actualizado',
            'id' => $rolefunctionality->id,],200);        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rolefunctionality = RoleFunctionality::find($id);
        if(empty($rolefunctionality)){
            return response()->json(['mensaje' => 'El ID ingresado no existe']);
        }
        $rolefunctionality->delete();
        return response()->json([
            'mensaje' => 'La funcionalidad del rol ha sido eliminada',
            'id' => $rolefunctionality->id,
        ], 200);
        
    }
}
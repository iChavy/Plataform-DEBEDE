<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller; 

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        if($roles->isEmpty()){
            return response()->json([
                'respuesta' => 'No se encuentran roles']);
        }
        return response($roles, 200);
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
                'Nombre' => 'required|min:4|max:15|unique:roles',
            ],
            [
                'Nombre.required' => 'Se debe ingresar el nombre del rol',
                'Nombre.unique' => 'El nombre del rol ya existe',
                'Nombre.min' => 'Debe ser de largo mínimo :min',
                'Nombre.max' => 'Debe ser de largo máximo :max',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }

        $newRole = new Role();
        $newRole->Nombre = $request->Nombre;
        $newRole->save();

        return response()->json([
            'mensaje' => 'El rol ha sido creado',
            'id' => $newRole->id,
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
        $role = Role::find($id);
        if(empty($role)){
            return response()->json(['mensaje' => 'No se encuentra el id ingresado']);
        }

        return response($role, 200);
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
                'Nombre' => 'required|min:4|max:15|unique:roles',
            ],
            [
                'Nombre.required' => 'Se debe ingresar el nombre del rol',
                'Nombre.unique' => 'El nombre del rol ya existe',
                'Nombre.min' => 'Debe ser de largo mínimo :min',
                'Nombre.max' => 'Debe ser de largo máximo :max',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors());
        }

        $role = Role::find($id);
        if(empty($role)){
            return response()->json(['mensaje' => 'No se encuentra el id ingresado']);
        }

        if ($request->Nombre == $role->Nombre){
            return response()->json([
                "message" => "Los datos ingresados son iguales a los actuales."
            ], 404);
        }

        $role->Nombre = $request->Nombre;
        $role->save();
        return response()->json([
            'mensaje' => 'El nombre del rol ha sido actualizado',
            'id' => $role->id,
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
        $role = Role::find($id);
        if(empty($role)){
            return response()->json(['mensaje' => 'El id ingresado no existe']);
        }
        $role->delete();
        return response()->json([
            'mensaje' => 'El pais ha sido eliminado',
            'id' => $role->id,
        ], 200);
        
    }
}

<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller; 

use App\Models\UserPaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserPaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userpaymentmethods = UserPaymentMethod::all();
        if($userpaymentmethods->isEmpty()){
            return response()->json([
                'respuesta' => 'No se encuentran métodos de pago para usuario']);
        }
        return response($userpaymentmethods, 200);
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
                'ID_Metodo' => 'required|integer|exists:payment_methods,id',
                'ID_Usuario' => 'required|integer|exists:users,id',
                'Fecha' => 'required|date:YYYY-MM-DD HH:mm:ss',
            ],
            [
                'ID_Metodo.required' => 'Se debe ingresar el ID de método',
                'ID_Metodo.integer' => 'Debe ser un entero',
                'ID_Metodo.exists' => 'El ID del método ingresado no existe',

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

        $newUserPaymentMethod = new UserPaymentMethod();
        $newUserPaymentMethod->ID_Metodo = $request->ID_Metodo;
        $newUserPaymentMethod->ID_Usuario = $request->ID_Usuario;
        $newUserPaymentMethod->Fecha = $request->Fecha;
        $newUserPaymentMethod->save();

        return response()->json([
            'mensaje' => 'El método de pago de usuario ha sido creado',
            'id' => $newUserPaymentMethod->id,
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
        $userpaymentmethod = UserPaymentMethod::find($id);
        if(empty($userpaymentmethod)){
            return response()->json(['mensaje' => 'El ID ingresado no existe']);
        }

        return response($userpaymentmethod, 200);
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
                'ID_Metodo' => 'nullable|integer|exists:payment_methods,id',
                'ID_Usuario' => 'nullable|integer|exists:users,id',
                'Fecha' => 'nullable|date:YYYY-MM-DD HH:mm:ss',
            ],
            [
                'ID_Metodo.integer' => 'Debe ser un entero',
                'ID_Metodo.exists' => 'El ID del método ingresado no existe',

                'ID_Usuario.integer' => 'Debe ser un entero',
                'ID_Usuario.exists' => 'El ID del usuario ingresado no existe',

                
                'Fecha.exists' => 'La fecha ingresada no existe',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }

        $userpaymentmethod = UserPaymentMethod::find($id);
        if(empty($userpaymentmethod)){
            return response()->json(['mensaje' => 'El ID ingresado no existe']);
        }

        if (($request->ID_Metodo == $userpaymentmethod->ID_Metodo)|
            ($request->ID_Usuario == $userpaymentmethod->ID_Usuario)|
            ($request->Fecha == $userpaymentmethod->Fecha)){
            return response()->json([
                "message" => "Los datos ingresados son iguales a los actuales."
            ], 404);
        }

        if (!empty($request->ID_Metodo)){
            $userpaymentmethod->ID_Metodo = $request->ID_Metodo;
        }

        if (!empty($request->ID_Usuario)){
            $userpaymentmethod->ID_Usuario = $request->ID_Usuario;
        }

        if (!empty($request->Fecha)){
            $userpaymentmethod->Fecha = $request->Fecha;
        }
        
        $userpaymentmethod->save();

        if (!empty($request->ID_Metodo && $request->ID_Usuario && $request->Fecha)){
            return response()->json([
                'mensaje' => 'La transacción ha sido modificada',
                'id' => $userpaymentmethod->id,
            ], 200);       
        }

        if (!empty($request->ID_Metodo)){
            return response()->json(['mensaje' => 'El Id del método ha sido actualizado',
            'id' => $userpaymentmethod->id,],200);
        }

        if (!empty($request->ID_Usuario)){
            return response()->json(['mensaje' => 'El Id del usuario ha sido actualizado',
            'id' => $userpaymentmethod->id,],200);
        }

        return response()->json(['mensaje' => 'la fecha ha sido actualizada',
            'id' => $userpaymentmethod->id,],200);        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userpaymentmethod = UserPaymentMethod::find($id);
        if(empty($userpaymentmethod)){
            return response()->json(['mensaje' => 'El ID ingresado no existe']);
        }
        $userpaymentmethod->delete();
        return response()->json([
            'mensaje' => 'El método de pago de usuario ha sido eliminado',
            'id' => $userpaymentmethod->id,
        ], 200);
    }
}
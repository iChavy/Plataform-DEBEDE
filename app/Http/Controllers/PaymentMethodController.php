<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paymentmethods = PaymentMethod::all();
        if($paymentmethods->isEmpty()){
            return response()->json([
                'respuesta' => 'No se encuentran métodos de pago.']);
        }
        return response($paymentmethods, 200);
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
                'Nro_tarjeta' => 'required|integer',
            ],
            [
                'Nombre.required' => 'Se debe ingresar el nombre del método de pago.',
                'Nombre.min' => 'Debe ser de largo mínimo :min',
                'Nombre.max' => 'Debe ser de largo máximo :max',
                'Nro_tarjeta.required' => 'Se debe ingresar el número de tarjeta del método de pago.',
                'Nro_tarjeta.min' => 'Debe ser un entero.',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        $newPaymentMethod = new PaymentMethod();
        $newPaymentMethod->Nombre = $request->Nombre;
        $newPaymentMethod->Nro_tarjeta = $request->Nro_tarjeta;
        $newPaymentMethod->save();

        return response()->json([
            'msg' => 'El método de pago ha sido creado.',
            'id' => $newPaymentMethod->id,
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
        $paymentmethod = PaymentMethod::find($id);
        if(empty($paymentmethod)){
            return response()->json([]);
        }
        return response($paymentmethod, 200);
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
                'Nombre' => 'required|min:2|max:100',
                'Nro_tarjeta' => 'required|integer',
            ],
            [
                'Nombre.required' => 'Se debe ingresar el nombre del método de pago.',
                'Nombre.min' => 'Debe ser de largo mínimo :min',
                'Nombre.max' => 'Debe ser de largo máximo :max',
                'Nro_tarjeta.required' => 'Se debe ingresar el número de tarjeta del método de pago.',
                'Nro_tarjeta.min' => 'Debe ser un entero.',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        $paymentmethod = PaymentMethod::find($id);
        if(empty($paymentmethod)){
            return response()->json([]);
        }
        if ($request->Nombre == $paymentmethod->Nombre && $request->Nro_tarjeta == $paymentmethod->Nro_tarjeta){
            return response()->json([
                "message" => "Los datos ingresados son iguales a los actuales."
            ], 404);
        }
        if (!empty($request->Nombre)){
            $paymentmethod->Nombre = $request->Nombre;
        }
        if (!empty($request->Nro_tarjeta)){
            $paymentmethod->Nro_tarjeta = $request->Nro_tarjeta;
        }
        $paymentmethod->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $paymentmethod = PaymentMethod::find($id);
        if(empty($paymentmethod)){
            return response()->json([]);
        }
        $paymentmethod->delete();
        return response()->json([
            'msg' => 'El método de pago ha sido eliminado',
            'id' => $paymentmethod->id,
        ], 200);
    }
}

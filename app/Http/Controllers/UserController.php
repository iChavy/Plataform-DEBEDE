<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller; 

use App\Models\User;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('borrado',false)->get();
        if($users->isEmpty()){
            return response()->json([
                'respuesta' => 'No se encuentran usuarios.']);
        }
        return response($users, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $countries = Country::where('borrado',false)->get();
        return view('modificarUser', compact('user','countries')); //no borrar
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
                'Correo_electronico' => 'required|min:6|max:100|unique:users',
                'Contrasenya' => 'required|min:6|max:20',
                'Fecha_Nacimiento' => 'required|date_format:Y-m-d',     
                'ID_Pais' => 'required|integer|exists:countries,id',
            ],
            [
                'Correo_electronico.required' => 'Se debe ingresar un correo electronico.',
                'Correo_electronico.min' => 'Debe ser de largo mínimo :min',
                'Correo_electronico.max' => 'Debe ser de largo máximo :max',
                'Correo_electronico.unique' => 'El correo electrónico ya está utilizado.',
                'Contrasenya.required' => 'Se debe ingresar una contraseña.',
                'Contrasenya.min' => 'Debe ser de largo mínimo :min',
                'Contrasenya.max' => 'Debe ser de largo máximo :max',
                'Fecha_Nacimiento.required' => 'Se debe ingresar una fecha de nacimiento.',
                'Fecha_Nacimiento.date_format' => 'Debe seguir el formato Y-m-d.',
                'ID_Pais.required' => 'Se debe ingresar un ID de país.',
                'ID_Pais.integer' => 'Debe ser un entero.',
                'ID_Pais.exists' => 'El ID de país no existe.',
            ]
        );
        //Caso falla la validación
        $validator->validate();
        /*
        if($validator->fails()){
            return response($validator->errors(), 400);
        }*/
        $newUser = new User();
        $newUser->Correo_electronico = $request->Correo_electronico;
        $newUser->Contrasenya = $request->Contrasenya;
        $newUser->Fecha_Nacimiento = $request->Fecha_Nacimiento;
        $newUser->Saldo_Moneda = 0;
        $newUser->ID_Rol = 1;
        $newUser->ID_Pais = $request->ID_Pais;
        $newUser->borrado = false;
        $newUser->save();
        /*
        return response()->json([
            'msg' => 'El usuario ha sido creado.',
            'id' => $newUser->id,
            
        ], 201);*/
        return view('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        if(empty($user) or $user->borrado == true){
            return response()->json(['mensaje' => 'No se encuentra el id ingresado.']);
        }
        return response($user, 200);
    }

    public function vistaUser($id)
    {
        $users = User::find($id);
        if (empty($users)) {
            return response()->json(['mensaje' => 'El ID ingresado no existe']);
        }

        return view('home', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

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
                'Correo_electronico' => 'nullable|min:6|max:100|unique:users',
                'Contrasenya' => 'nullable|min:6|max:20',
                'Fecha_Nacimiento' => 'nullable|date_format:Y-m-d',     
                'Saldo_Moneda' => 'nullable|integer',  
                'ID_Rol' => 'nullable|integer|exists:roles,id',
                'ID_Pais' => 'nullable|integer|exists:countries,id',
            ],
            [
                'Correo_electronico.min' => 'Debe ser de largo mínimo :min',
                'Correo_electronico.max' => 'Debe ser de largo máximo :max',
                'Correo_electronico.unique' => 'El correo electrónico ya está utilizado.',
                'Contrasenya.min' => 'Debe ser de largo mínimo :min',
                'Contrasenya.max' => 'Debe ser de largo máximo :max',
                'Fecha_Nacimiento.date_format' => 'Debe seguir el formato Y-m-d.',
                'Saldo_Moneda.integer' => 'Debe ser un entero.',
                'ID_Rol.integer' => 'Debe ser un entero.',
                'ID_Rol.exists' => 'El ID de rol no existe.',
                'ID_Pais.integer' => 'Debe ser un entero.',
                'ID_Pais.exists' => 'El ID de país no existe.',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        $user = User::find($id);
        if(empty($user)){
            return response()->json(['mensaje' => 'No se encuentra el id ingresado']);
        }

        if (($request->Correo_electronico == $user->Correo_electronico)|
            ($request->Contrasenya == $user->Contrasenya)|
            ($request->Fecha_Nacimiento == $user->Fecha_Nacimiento)|
            ($request->Saldo_Moneda == $user->Saldo_Moneda)|
            ($request->ID_Rol == $user->ID_Rol)|
            ($request->ID_Pais == $user->ID_Pais)){
            return response()->json([
                "message" => "Los datos ingresados son iguales a los actuales."
            ], 404);
        }
        if (!empty($request->Correo_electronico)){
            $user->Correo_electronico = $request->Correo_electronico;
        }
        if (!empty($request->Contrasenya)){
            $user->Contrasenya = $request->Contrasenya;
        }
        if (!empty($request->Fecha_Nacimiento)){
            $user->Fecha_Nacimiento = $request->Fecha_Nacimiento;
        }
        if (!empty($request->Saldo_Moneda)){
            $user->Saldo_Moneda = $request->Saldo_Moneda;
        }
        if (!empty($request->ID_Rol)){
            $user->ID_Rol = $request->ID_Rol;
        }
        if (!empty($request->ID_Pais)){
            $user->ID_Pais = $request->ID_Pais;
        }
        $user->save();
        /*
        return response()->json([
            'msg' => 'El usuario ha sido modificado.',
            'id' => $user->id,
        ], 200);
        */
        $users = User::all();
        return view('home',compact('users'));
    }

    public function borrado($id)
    {
        $user = User::find($id);
        if(empty($user) or $user->borrado == true){
            return response()->json(['mensaje' => 'No se encuentra el id ingresado']);
        }
        $user->borrado = true;
        $user->save();
        return response()->json([
            'msg' => 'El usuario ha sido eliminado (soft)',
            'id' => $user->id,
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
        $user = User::find($id);
        if(empty($user)){
            return response()->json(['mensaje' => 'No se encuentra el id ingresado.']);
        }
        $user->delete();
        return response()->json([
            'msg' => 'El usuario ha sido eliminado.',
            'id' => $user->id,
        ], 200);
    }
}

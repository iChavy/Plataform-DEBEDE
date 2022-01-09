<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller; 

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $games = Game::where('borrado',false)->get();
        if($games->isEmpty()){
            return response()->json([
                'respuesta' => 'No se encuentran juegos']);
        }
        return response($games, 200);
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
                'ID_Restriccion' => 'required|integer|exists:age_restrictions,id',
                'ID_Usuario' => 'nullable|integer|exists:users,id',
                'Nombre' => 'required|min:2|max:100|unique:games',
                'Precio' => 'required|integer|min:5000|max:70000',
                'Link' => 'required|url|unique:games',
                'Link_Demo' => 'required|url|unique:games',
            ],
            [
                'ID_Restriccion.required' => 'Se debe ingresar el ID de la restricción',
                'ID_Restriccion.integer' => 'Debe ser un entero',
                'ID_Restriccion.exists' => 'El ID del método ingresado no existe',

                'ID_Usuario.required' => 'Se debe ingresar el ID del usuario',
                'ID_Usuario.integer' => 'Debe ser un entero',
                'ID_Usuario.exists' => 'El ID de usuario ingresado no existe',

                'Nombre.unique' => 'El juego ya existe',
                'Nombre.required' => 'Se debe ingresar el nombre del juego',
                'Nombre.min' => 'Debe ser de largo mínimo :min',
                'Nombre.max' => 'Debe ser de largo máximo :max',


                'Precio.required' => 'Se debe ingresar el precio del juego',
                'Precio.integer' => 'Debe ser un entero',
                'Precio.min' => 'Precio mínimo $ :min',
                'Precio.max' => 'Precio máximo $ :max',

                'Link.unique' => 'El link está asociado a otro juego o demo',
                'Link.required' => 'Se debe ingresar el link del juego',
                'Link.url' => 'Debe ser un link',

                'Link_Demo.unique' => 'El link está asociado a otro juego o demo',
                'Link_Demo.required' => 'Se debe ingresar el link del demo del juego',
                'Link_Demo.url' => 'Debe ser un link',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }

        $newGame = new Game();
        $newGame->ID_Restriccion = $request->ID_Restriccion;
        $newGame->ID_Usuario = $request->ID_Usuario;
        $newGame->Nombre = $request->Nombre;
        $newGame->Numero_Ventas = 0;
        $newGame->Precio = $request->Precio;
        $newGame->Link = $request->Link;
        $newGame->Link_Demo = $request->Link_Demo;
        $newGame->borrado = false;
        $newGame->save();

        return response()->json([
            'mensaje' => 'El juego ha sido creado',
            'id' => $newGame->id,
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
        $game = Game::find($id);
        if(empty($game) or $game->borrado == true){
            return response()->json(['mensaje' => 'El ID ingresado no existe']);
        }

        return response($game, 200);
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
                'ID_Restriccion' => 'nullable|integer|exists:age_restrictions,id',
                'ID_Usuario' => 'nullable|integer|exists:users,id',
                'Nombre' => 'nullable|min:2|max:100|unique:games',
                'Numero_Ventas' => 'nullable|integer',
                'Precio' => 'nullable|integer|min:5000|max:70000',
                'Link' => 'nullable|url|unique:games',
                'Link_Demo' => 'nullable|url|unique:games',
            ],
            [
                'ID_Usuario.integer' => 'Debe ser un entero',
                'ID_Usuario.exists' => 'El ID de usuario ingresado no existe',

                'ID_Restriccion.integer' => 'Debe ser un entero',
                'ID_Restriccion.exists' => 'El ID del método ingresado no existe',

                'Nombre.unique' => 'El juego ya existe',
                'Nombre.min' => 'Debe ser de largo mínimo :min',
                'Nombre.max' => 'Debe ser de largo máximo :max',

                'Numero_Ventas.integer' => 'Debe ser un entero',

                'Precio.integer' => 'Debe ser un entero',
                'Precio.min' => 'Precio mínimo $ :min',
                'Precio.max' => 'Precio máximo $ :max',

                'Link.unique' => 'El link está asociado a otro juego o demo',
                'Link.url' => 'Debe ser un link',

                'Link_Demo.unique' => 'El link está asociado a otro juego o demo',
                'Link_Demo.url' => 'Debe ser un link',
            ]


        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }

        $game = Game::find($id);
        if(empty($game)){
            return response()->json(['mensaje' => 'El ID ingresado no existe']);
        }

        if (($request->ID_Restriccion == $game->ID_Restriccion)|
            ($request->ID_Usuario == $game->ID_Usuario)|
            ($request->Nombre == $game->Nombre)|
            ($request->Numero_Ventas == $game->Numero_Ventas)|
            ($request->Precio == $game->Precio)|
            ($request->Link == $game->Link)|
            ($request->Link_Demo == $game->Link_Demo)){
            return response()->json([
                "message" => "Los datos ingresados son iguales a los actuales."
            ], 404);
        }

        if (!empty($request->ID_Restriccion)){
            $game->ID_Restriccion = $request->ID_Restriccion;
        }
        if (!empty($request->ID_Usuario)){
            $game->ID_Usuario = $request->ID_Usuario;
        }
        if (!empty($request->Nombre)){
            $game->Nombre = $request->Nombre;
        }
        if (!empty($request->Numero_Ventas)){
            $game->Numero_Ventas = $request->Numero_Ventas;
        }
        if (!empty($request->Precio)){
            $game->Precio = $request->Precio;
        }
        if (!empty($request->Link)){
            $game->Link = $request->Link;
        }
        if (!empty($request->Link_Demo)){
            $game->Link_Demo = $request->Link_Demo;
        }
        $game->save();
        return response()->json([
            'msg' => 'El juego ha sido modificado.',
            'id' => $game->id,
        ], 200);     
        
    }

    public function borrado($id)
    {
        $game = Game::find($id);
        if(empty($game) or $game->borrado == true){
            return response()->json(['mensaje' => 'No se encuentra el id ingresado']);
        }
        $game->borrado = true;
        $game->save();
        return response()->json([
            'msg' => 'El juego ha sido eliminado (soft)',
            'id' => $game->id,
        ], 200);
    }
    
    public function destroy($id)
    {
        $game = Game::find($id);
        if(empty($game)){
            return response()->json(['mensaje' => 'El ID ingresado no existe']);
        }
        $game->delete();
        return response()->json([
            'mensaje' => 'El método de pago de usuario ha sido eliminado',
            'id' => $game->id,
        ], 200);
    }
}
<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller; 

use App\Models\Library;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LibraryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $libraries = Library::where('borrado',false)->get();
        if($libraries->isEmpty()){
            return response()->json([
                'respuesta' => 'No se encuentran bibliotecas.']);
        }
        return response($libraries, 200);
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
                'ID_Usuario' => 'required|integer|exists:users,id',
                'Codigo_Juego' => 'required|integer|exists:games,id',
            ],
            [
                'ID_Usuario.required' => 'Se debe ingresar un ID de usuario.',
                'ID_Usuario.integer' => 'Debe ser un entero.',
                'ID_Usuario.exists' => 'El ID de usuario no existe.',
                'Codigo_Juego.required' => 'Se debe ingresar un juego.',
                'Codigo_Juego.integer' => 'Debe ser un entero.',
                'Codigo_Juego.exists' => 'El código de juego no existe.',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        $newLibrary = new Library();
        $newLibrary->ID_Usuario = $request->ID_Usuario;
        $newLibrary->Codigo_Juego = $request->Codigo_Juego;
        $newLibrary->borrado = false;
        $newLibrary->save();

        return response()->json([
            'msg' => 'La biblioteca ha sido creada.',
            'id' => $newLibrary->id,
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
        $library = Library::find($id);
        if(empty($library) or $library->borrado == true){
            return response()->json(['mensaje' => 'No se encuentra el id ingresado']);
        }
        return response($library, 200);
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
                'ID_Usuario' => 'nullable|integer|exists:users,id',
                'Codigo_Juego' => 'nullable|integer|exists:games,id',
            ],
            [
                'ID_Usuario.integer' => 'Debe ser un entero.',
                'ID_Usuario.exists' => 'El ID de usuario no existe.',
                'Codigo_Juego.integer' => 'Debe ser un entero.',
                'Codigo_Juego.exists' => 'El código de juego no existe.',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        $library = Library::find($id);
        if(empty($library)){
            return response()->json(['mensaje' => 'No se encuentra el id ingresado']);
        }

        if (($request->ID_Usuario == $library->ID_Usuario && $request->Codigo_Juego == $library->Codigo_Juego)|($request->ID_Usuario == $library->ID_Usuario)|($request->Codigo_Juego == $library->Codigo_Juego)){
            return response()->json([
                "message" => "Los datos ingresados son iguales a los actuales."
            ], 404);
        }
        if (!empty($request->ID_Usuario)){
            $library->ID_Usuario = $request->ID_Usuario;
        }
        if (!empty($request->Codigo_Juego)){
            $library->Codigo_Juego = $request->Codigo_Juego;
        }
        $library->save();

        if (!empty($request->ID_Usuario && $request->Codigo_Juego)){
            return response()->json([
                'msg' => 'La biblioteca ha sido modificada.',
                'id' => $library->id,
            ], 200);       
        }
      
        if (!empty($request->ID_Usuario)){
            return response()->json(['mensaje' => 'El ID de usuario ha sido actualizado',
            'id' => $library->id,],200);
        }

        return response()->json(['mensaje' => 'El código de juego ha sido actualizado',
        'id' => $library->id,],200);
    }

    public function borrado($id)
    {
        $library = Library::find($id);
        if(empty($library) or $library->borrado == true){
            return response()->json(['mensaje' => 'No se encuentra el id ingresado']);
        }
        $library->borrado = true;
        $library->save();
        return response()->json([
            'msg' => 'La biblioteca ha sido eliminada (soft)',
            'id' => $library->id,
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
        $library = Library::find($id);
        if(empty($library)){
            return response()->json(['mensaje' => 'No se encuentra el id ingresado']);
        }
        $library->delete();
        return response()->json([
            'msg' => 'La biblioteca ha sido eliminada',
            'id' => $library->id,
        ], 200);
    }
}

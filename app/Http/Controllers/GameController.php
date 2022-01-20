<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Game;
use App\Models\User;
use App\Models\AgeRestriction;
use App\Models\Library;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id) //poner param edad $
    {
        if ($request) {
            // Calcula edad de usuario
            $users = User::find($id);
            $born = date('Y', strtotime($users->Fecha_Nacimiento));
            $fecha = date('Y');
            $edad = $fecha - $born;


            $agerestrictions = AgeRestriction::where('borrado', false)->get();
            $users = User::where('borrado', false)->where('ID_Rol', 2)->get();
            $games = Game::join("age_restrictions", "age_restrictions.id", "=", "games.ID_Restriccion")
                ->select("games.id", "games.Nombre", "games.Precio", "games.Link", "games.Link_Demo", "games.imagen", "games.Descripcion", "games.ID_Usuario", "games.ID_Restriccion", "games.Numero_Ventas", "age_restrictions.Edad")
                ->where('Edad', '<', $edad)->where('games.borrado', false)->where('age_restrictions.borrado', false)->orderBy('Numero_Ventas', 'desc')->get();
            if ($request) {
                $Nombre = $request->get('buscarpor');
                $Categoria = $request->get('buscarC');
                $Desarrollador = $request->get('buscarD');
                $PrecioMin = $request->get('buscarPmin');
                $PrecioMax = $request->get('buscarPmax');

                if ($Categoria) {
                    $games = Game::join("age_restrictions", "age_restrictions.id", "=", "games.ID_Restriccion")
                        ->select("games.id", "games.Nombre", "games.Precio", "games.Link", "games.Link_Demo", "games.imagen", "games.Descripcion", "games.ID_Usuario", "games.ID_Restriccion", "games.Numero_Ventas", "age_restrictions.Edad")
                        ->where('Edad', '<', $edad)->where('ID_Restriccion', 'like', "%$Categoria%")->where('games.borrado', false)->where('age_restrictions.borrado', false)
                        ->orderBy('Numero_Ventas', 'desc')->get();
                    return view('juegos', ['games' => $games, 'buscarC' => $Categoria], compact('agerestrictions', 'users'));
                }

                if ($Nombre) {
                    $games = Game::join("age_restrictions", "age_restrictions.id", "=", "games.ID_Restriccion")
                        ->select("games.id", "games.Nombre", "games.Precio", "games.Link", "games.Link_Demo", "games.imagen", "games.Descripcion", "games.ID_Usuario", "games.ID_Restriccion", "games.Numero_Ventas", "age_restrictions.Edad")
                        ->where('Edad', '<', $edad)->where('games.borrado', false)->where('age_restrictions.borrado', false)->where('Nombre', 'like', "%$Nombre%")
                        ->orderBy('Numero_Ventas', 'desc')->get();
                    return view('juegos', ['games' => $games, 'buscarpor' => $Nombre], compact('agerestrictions', 'users'));
                }

                if ($Desarrollador) {
                    $games = Game::join("age_restrictions", "age_restrictions.id", "=", "games.ID_Restriccion")
                        ->select("games.id", "games.Nombre", "games.Precio", "games.Link", "games.Link_Demo", "games.imagen", "games.Descripcion", "games.ID_Usuario", "games.ID_Restriccion", "games.Numero_Ventas", "age_restrictions.Edad")
                        ->where('Edad', '<', $edad)->where('games.borrado', false)->where('age_restrictions.borrado', false)->where('ID_Usuario', 'like', "%$Desarrollador%")
                        ->orderBy('Numero_Ventas', 'desc')->get();
                    return view('juegos', ['games' => $games, 'buscarD' => $Desarrollador], compact('agerestrictions', 'users'));
                }

                if ($PrecioMin and $PrecioMax) {
                    $games = Game::join("age_restrictions", "age_restrictions.id", "=", "games.ID_Restriccion")
                        ->select("games.id", "games.Nombre", "games.Precio", "games.Link", "games.Link_Demo", "games.imagen", "games.Descripcion", "games.ID_Usuario", "games.ID_Restriccion", "games.Numero_Ventas", "age_restrictions.Edad")
                        ->where('Edad', '<', $edad)->where('games.borrado', false)->where('age_restrictions.borrado', false)->where('Precio', '>', "$PrecioMin")->where('Precio', '<', "$PrecioMax")
                        ->orderBy('Numero_Ventas', 'desc')->get();
                    return view('juegos', ['games' => $games, 'buscarPmin' => $PrecioMin, 'buscarPmax' => $PrecioMax], compact('agerestrictions', 'users'));
                }
            }

            return view('juegos', compact('agerestrictions', 'users', 'games'));
        }
    }

    public function indexInicio(Request $request)
    {

        if ($request) {
            $agerestrictions = AgeRestriction::where('borrado', false)->get();
            $users = User::where('borrado', false)->where('ID_Rol', 2)->get();
            $games = Game::where('borrado', false)->orderBy('Numero_Ventas', 'desc')->get();
            if ($request) {
                $Nombre = $request->get('buscarpor');
                $Categoria = $request->get('buscarC');
                $Desarrollador = $request->get('buscarD');
                $PrecioMin = $request->get('buscarPmin');
                $PrecioMax = $request->get('buscarPmax');

                if ($Categoria) {
                    $games = Game::where('ID_Restriccion', 'like', "%$Categoria%")->where('borrado', false)->orderBy('Numero_Ventas', 'desc')->get();
                    return view('inicio', ['games' => $games, 'buscarC' => $Categoria], compact('agerestrictions', 'users'));
                }

                if ($Nombre) {
                    $games = Game::where('Nombre', 'like', "%$Nombre%")->where('borrado', false)->orderBy('Numero_Ventas', 'desc')->get();
                    return view('inicio', ['games' => $games, 'buscarpor' => $Nombre], compact('agerestrictions', 'users'));
                }

                if ($Desarrollador) {
                    $games = Game::where('ID_Usuario', 'like', "%$Desarrollador%")->where('borrado', false)->orderBy('Numero_Ventas', 'desc')->get();
                    return view('inicio', ['games' => $games, 'buscarD' => $Desarrollador], compact('agerestrictions', 'users'));
                }

                if ($PrecioMin and $PrecioMax) {
                    $games = Game::where('Precio', '>', "$PrecioMin")->where('Precio', '<', "$PrecioMax")->where('borrado', false)->orderBy('Numero_Ventas', 'desc')->get();
                    return view('inicio', ['games' => $games, 'buscarPmin' => $PrecioMin, 'buscarPmax' => $PrecioMax], compact('agerestrictions', 'users'));
                }
            }

            return view('inicio', compact('agerestrictions', 'users', 'games'));
        }
    }

    public function indexAdmin(Request $request)
    {
        if ($request) {
            $agerestrictions = AgeRestriction::where('borrado', false)->get();
            $users = User::where('borrado', false)->where('ID_Rol', 2)->get();
            $games = Game::where('borrado', false)->orderBy('Numero_Ventas', 'desc')->get();
            if ($request) {
                $Nombre = $request->get('buscarpor');
                $Categoria = $request->get('buscarC');
                $Desarrollador = $request->get('buscarD');
                $PrecioMin = $request->get('buscarPmin');
                $PrecioMax = $request->get('buscarPmax');

                if ($Categoria) {
                    $games = Game::where('ID_Restriccion', 'like', "%$Categoria%")->where('borrado', false)->orderBy('Numero_Ventas', 'desc')->get();
                    return view('juegosAdmin', ['games' => $games, 'buscarC' => $Categoria], compact('agerestrictions', 'users'));
                }

                if ($Nombre) {
                    $games = Game::where('Nombre', 'like', "%$Nombre%")->where('borrado', false)->orderBy('Numero_Ventas', 'desc')->get();
                    return view('juegosAdmin', ['games' => $games, 'buscarpor' => $Nombre], compact('agerestrictions', 'users'));
                }

                if ($Desarrollador) {
                    $games = Game::where('ID_Usuario', 'like', "%$Desarrollador%")->where('borrado', false)->orderBy('Numero_Ventas', 'desc')->get();
                    return view('juegosAdmin', ['games' => $games, 'buscarD' => $Desarrollador], compact('agerestrictions', 'users'));
                }

                if ($PrecioMin and $PrecioMax) {
                    $games = Game::where('Precio', '>', "$PrecioMin")->where('Precio', '<', "$PrecioMax")->where('borrado', false)->orderBy('Numero_Ventas', 'desc')->get();
                    return view('juegosAdmin', ['games' => $games, 'buscarPmin' => $PrecioMin, 'buscarPmax' => $PrecioMax], compact('agerestrictions', 'users'));
                }
            }

            return view('juegosAdmin', compact('agerestrictions', 'users', 'games'));
        }
    }
    public function indexBiblioteca($id)
    {
        $resultados = Game::join("libraries", "libraries.Codigo_Juego", "=", "games.id")
            ->select("libraries.Codigo_Juego", "games.Nombre", "libraries.ID_Usuario", "games.Descripcion", "games.imagen")->where('libraries.ID_Usuario', $id)
            ->get();

        return view('biblioteca', compact('resultados'));
    }

    public function vistaCarro($id)
    {
        $games = Game::find($id);
        if (empty($games)) {
            return response()->json(['mensaje' => 'El ID ingresado no existe']);
        }

        return view('carro', compact('games'));
    }

    public function vistaJuegoAd($id)
    {
        $agerestrictions = AgeRestriction::where('borrado', false)->get();
        $games = Game::find($id);
        if (empty($games)) {
            return response()->json(['mensaje' => 'El ID ingresado no existe']);
        }

        return view('modificarJuego', compact('games', 'agerestrictions'));
    }

    // vista scroll bar restriccion de edad
    public function edit(Game $game)
    {
        $agerestrictions = AgeRestriction::where('borrado', false)->get();
        return view('modificarJuego', compact('game', 'agerestrictions'));
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
    public function store(Request $request, $id) //request, id_user
    {
        $agerestrictions = AgeRestriction::where('borrado', false)->get();
        $validator = Validator::make(
            $request->all(),
            [
                'ID_Restriccion' => 'required|integer|exists:age_restrictions,id',
                //'ID_Usuario' => 'nullable|integer|exists:users,id',
                'Nombre' => 'required|min:2|max:100|unique:games',
                'Precio' => 'required|integer|min:5000|max:70000',
                'Link' => 'required|url|unique:games',
                'Link_Demo' => 'required|url|unique:games',
                'imagen' => 'required|min:2|max:255',
                'Descripcion' => 'required|min:2|max:50',
            ],
            [
                'ID_Restriccion.required' => 'Se debe ingresar el ID de la restricción',
                'ID_Restriccion.integer' => 'Debe ser un entero',
                'ID_Restriccion.exists' => 'El ID del método ingresado no existe',

                //'ID_Usuario.required' => 'Se debe ingresar el ID del usuario',
                //'ID_Usuario.integer' => 'Debe ser un entero',
                //'ID_Usuario.exists' => 'El ID de usuario ingresado no existe',

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

                'imagen.required' => 'Debes ingresar un link de imagen',
                'imagen.min' => 'Debe ser de largo mínimo :min',
                'imagen.max' => 'Debe ser de largo máximo :max',

                'Descripcion.required' => 'Se debe la descripción del juego',
                'Descripcion.min' => 'Debe ser de largo mínimo :min',
                'Descripcion.max' => 'Debe ser de largo máximo :max',
            ]
        );

        $validator->validate();
        //Caso falla la validación
        /**if ($validator->fails()) {
            return response($validator->errors(), 400);
        }**/

        $newGame = new Game();
        $newGame->ID_Restriccion = $request->ID_Restriccion;
        $newGame->ID_Usuario = $id;
        $newGame->Nombre = $request->Nombre;
        $newGame->Numero_Ventas = 0;
        $newGame->Precio = $request->Precio;
        $newGame->Link = $request->Link;
        $newGame->Link_Demo = $request->Link_Demo;
        $newGame->borrado = false;
        $newGame->imagen = $request->imagen;
        $newGame->Descripcion = $request->Descripcion;
        $newGame->save();

        return view('/crearJuego', compact('agerestrictions'));
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
        if (empty($game) or $game->borrado == true) {
            return response()->json(['mensaje' => 'El ID ingresado no existe']);
        }

        return response($game, 200);
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
                'imagen' => 'nullable|min:2|max:255',
                'Descripcion' => 'nullable|min:2|max:50',
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

                'imagen.min' => 'Debe ser de largo mínimo :min',
                'imagen.max' => 'Debe ser de largo máximo :max',

                'Descripcion.min' => 'Debe ser de largo mínimo :min',
                'Descripcion.max' => 'Debe ser de largo máximo :max',
            ]


        );
        //Caso falla la validación
        $validator->validate();

        /*if ($validator->fails()) {
            return response($validator->errors(), 400);
        }*/

        $game = Game::find($id);
        if (empty($game)) {
            return response()->json(['mensaje' => 'El ID ingresado no existe']);
        }

        if (!empty($request->ID_Restriccion)) {
            $game->ID_Restriccion = $request->ID_Restriccion;
        }
        if (!empty($request->ID_Usuario)) {
            $game->ID_Usuario = $request->ID_Usuario;
        }
        if (!empty($request->Nombre)) {
            $game->Nombre = $request->Nombre;
        }
        if (!empty($request->Numero_Ventas)) {
            $game->Numero_Ventas = $request->Numero_Ventas;
        }
        if (!empty($request->Precio)) {
            $game->Precio = $request->Precio;
        }
        if (!empty($request->Link)) {
            $game->Link = $request->Link;
        }
        if (!empty($request->Link_Demo)) {
            $game->Link_Demo = $request->Link_Demo;
        }

        if (!empty($request->imagen)) {
            $game->imagen = $request->imagen;
        }

        if (!empty($request->Descripcion)) {
            $game->Descripcion = $request->Descripcion;
        }
        $game->save();
        $agerestrictions = AgeRestriction::where('borrado', false)->get();
        $users = User::where('borrado', false)->where('ID_Rol', 2)->get();
        $games = Game::where('borrado', false)->orderBy('Numero_Ventas', 'desc')->get();
        return view('/juegosAdmin', compact('users', 'agerestrictions', 'games'));
        /*
        return response()->json([
            'msg' => 'El juego ha sido modificado.',
            'id' => $game->id,
        ], 200);*/
    }

    public function borrado($id)
    {
        $game = Game::find($id);
        if (empty($game) or $game->borrado == true) {
            return response()->json(['mensaje' => 'No se encuentra el id ingresado']);
        }
        $game->borrado = true;
        $game->save();
        $agerestrictions = AgeRestriction::where('borrado', false)->get();
        $users = User::where('borrado', false)->where('ID_Rol', 2)->get();
        $games = Game::where('borrado', false)->orderBy('Numero_Ventas', 'desc')->get();
        return view('/juegosAdmin', compact('users', 'agerestrictions', 'games'));
    }

    public function destroy($id)
    {
        $game = Game::find($id);
        if (empty($game)) {
            return response()->json(['mensaje' => 'El ID ingresado no existe']);
        }
        $game->delete();
        return response()->json([
            'mensaje' => 'El método de pago de usuario ha sido eliminado',
            'id' => $game->id,
        ], 200);
    }

    public function vistaEliminar($id)
    {
        $games = Game::find($id);
        if (empty($games)) {
            return response()->json(['mensaje' => 'El ID ingresado no existe']);
        }

        return view('eliminarJuego', compact('games'));
    }
}

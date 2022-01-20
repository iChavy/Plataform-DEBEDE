<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('../css/app.css') }}">
    <!-- Importación de boostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Juegos</title>
</head>

<body>
    @include('includes.navbar')
    <ul class="nav justify-content-center">

        <br>
        <div class="col-md-4">
            Filtrar por título:
            <form class="d-flex">
                <input name="buscarpor" class="form-control mr-sm-2" type="search" placeholder="Ingrese un título" aria-label="Search">
                <div class="pull-left" style="margin-right:5px">
                <button class="btn btn-dark" type="submit">Filtrar</button>
                </div>
            </form>
            <br>
            Filtrar por rango de precio:
            <form class="d-flex">
                <input name="buscarPmin" class="form-control mr-sm-2" type="search" placeholder="Ingrese precio minimo" aria-label="Search">
                <input name="buscarPmax" class="form-control mr-sm-2" type="search" placeholder="Ingrese precio maximo" aria-label="Search">
                <div class="pull-left" style="margin-right:5px">
                <button class="btn btn-dark" type="submit">Filtrar</button>
                </div>
            </form>
            <br>

            Filtrar por categoría:
            <form class="d-flex">
                <label for="ID_Restriccion" class="form-label"></label>
                <select name="buscarC" class="form-select mb-4" type="search" aria-label="Search" name="ID_Restriccion" id="ID_Restriccion">
                    @foreach ($agerestrictions as $agerestriction)
                    <option value="{{$agerestriction->id}}">{{$agerestriction->Tipo_restriccion}}</option>
                    @endforeach

                </select>
                <div class="pull-left" style="margin-right:5px">
                <button class="btn btn-dark" type="submit">Filtrar</button>
                </div>
            </form>
            <br>

            Filtrar por desarrollador:
            <form class="d-flex">
                <label for="ID_Usuario" class="form-label"></label>
                <select name="buscarD" class="form-select mb-4" type="search" aria-label="Search" name="ID_Usuario" id="ID_Usuario">
                    @foreach ($users as $user)
                    <option value="{{$user->id}}">{{$user->Correo_electronico}}</option>
                    @endforeach

                </select>
                <div class="pull-left" style="margin-right:5px">
                <button class="btn btn-dark" type="submit">Filtrar</button>
                </div>
            </form>

            <br>
        </div>
    </ul>
    <hr />
    <section class="mt-5">
        <div class="container ">
            <h4 class="mb-5">Ranking de juegos más comprados:</h4>
            <div class="row text-center mb-4">
                @foreach ($games as $game)
                <div class="col-4 d-flex justify-content-center my-3">
                    <div class="card" style="width: 18rem;">
                        <img src="{{$game->imagen}}" class="card-img-top" alt="Imagen de juego">
                        <div class="card-body">
                            <h5 class="card-title">{{$game->Nombre}}</h5>
                            <ul class="list-group list-group-flush">
                            <p class="list-group-item"><strong>Descripción: </strong>{{$game->Descripcion}}</p>
                            <p class="list-group-item"><strong>Precio: </strong>${{$game->Precio}}</p>
                            <p class="list-group-item"><strong>Número de ventas: </strong>{{$game->Numero_Ventas}}</p>
                            </ul>
                            <a href="/game/vistacarro/{{ $game->id }}" class="btn btn-dark">Comprar</a>
                        </div>
                    </div>
                </div>
                @endforeach


            </div>
        </div>
    </section>
    @include('includes.footer')
</body>

</html>
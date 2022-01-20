<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('../css/app.css') }}">
    <!-- Importación de boostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Inicio</title>
</head>

<body>
    @include('includes.navbar')
    <!-- Añadir título -->
    Bienvenido
    <ul class="nav justify-content-center">

        <br>
        <div class="col-md-4">
            Filtrar por título:
            <form class="d-flex">
                <input name="buscarpor" class="form-control mr-sm-2" type="search" placeholder="Ingrese un título" aria-label="Search">
                <button class="btn btn-primary" type="submit">Filtrar</button>
            </form>
            <br>
            Filtrar por rango de precio:
            <form class="d-flex">
                <input name="buscarPmin" class="form-control mr-sm-2" type="search" placeholder="Ingrese precio minimo" aria-label="Search">
                <input name="buscarPmax" class="form-control mr-sm-2" type="search" placeholder="Ingrese precio maximo" aria-label="Search">
                <button class="btn btn-primary" type="submit">Filtrar</button>
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
                <button class="btn btn-primary" type="submit">Filtrar</button>
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
                <button class="btn btn-primary" type="submit">Filtrar</button>
            </form>

            <br>
        </div>
    </ul>

    <section class="mt-5">
        <div class="container ">
            <h4 class="mb-5">Ranking de juegos más comprados:</h4>
            <div class="row text-center mb-4">
                @foreach ($games as $game)
                <div class="col-4 d-flex justify-content-center my-3">
                    <div class="card" style="width: 18rem;">
                        <img src="{{$game->imagen}}" class="card-img-top" alt="Imagen de curso">
                        <div class="card-body">
                            <h5 class="card-title">Nombre: {{$game->Nombre}}</h5>
                            <p class="card-text">Descripción: {{$game->Descripcion}}</p>
                            <p class="card-text">Precio: ${{$game->Precio}}</p>
                            <p class="card-text">Número de ventas: {{$game->Numero_Ventas}}</p>
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
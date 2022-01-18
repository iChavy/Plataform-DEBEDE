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
    <nav class="navbar navbar-light bg-light">
        <form class="d-flex">
            <input name="buscarpor" class="form-control mr-sm-2" type="search" placeholder="Buscar por título" aria-label="Search">
            <button class="btn btn-primary" type="submit">Filtrar</button>
        </form>
    </nav>

    <section class="mt-5">
        <div class="container ">
            <h4 class="mb-5">Ranking de juegos más comprados:</h4>
            <div class="row text-center mb-4">
                @foreach ($games as $game)
                <div class="col-4 d-flex justify-content-center my-3">
                    <div class="card" style="width: 18rem;">
                        <img src="{https://image.freepik.com/free-vector/play-vibrant-gradient-typography_53876-93868.jpg}" class="card-img-top" alt="Imagen del juego">
                        <div class="card-body">
                            <h5 class="card-title">{{$game->Nombre}}</h5>
                            <p class="card-text">{{$game->Precio}}</p>
                            <a href="/game/{{ $game->id }}" class="btn btn-primary">Ver Juego</a>
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
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('../css/app.css') }}">
    <!-- Importación de boostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Página Principal</title>
</head>

<body>
    @include('includes.navbar')
    <section>
        <div class="container">
            <div class="row mt-5">
                <div class="col d-flex justify-content-end">
                    <div class="card text-white bg-dark mb-3 position-absolute top-50 start-50 translate-middle" style="max-width: 21rem;">
                        <div class="card-body">
                            <h5 class="card-title fw-bold position-absolute top-0 start-50 translate-middle-x">Datos del usuario</h5>
                            <br>
                            <p class="card-text "><strong>ID: </strong>{{$users->id}}</p>
                            <p class="card-text"><strong>Correo electrónico: </strong>{{$users->Correo_electronico}}</p>
                            <p class="card-text"><strong>Fecha de nacimiento: </strong>{{$users->Fecha_Nacimiento}}</p>
                            <p class="card-text"><strong>País: </strong>{{$countries->Nombre}}</p>
                            <p class="card-text"><strong>Rol: </strong>{{$roles->Nombre}}</p>
                            <p class="card-text"><strong>Edad: </strong>{{$edad}}</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    @include('includes.footerFinal')
</body>

</html>
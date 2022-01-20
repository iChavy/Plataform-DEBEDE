<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Importación de boostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Modificar Usuario</title>
</head>

<body>
    @include('includes.navbar')
    <section>
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="position-absolute top-50 start-50 translate-middle " style="width: 30rem;">
                        <h4 class="mb-3 text-center">Modificar usuario</h4>
                        <form action="" method='POST'>
                            @method('PUT')
                            <div class="mb-3">
                                <label for="Contrasenya" class="form-label">Contraseña</label>
                                <input type="text" placeholder="Debe tener entre 6 y 20 caracteres" class="form-control @error('Contrasenya') is-invalid @enderror" id="Contrasenya" name="Contrasenya" value="" placeholder="{{$user->Contrasenya}}">
                                @error('Contrasenya')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="ID_Pais" class="form-label">País</label>
                                <select class="form-select mb-4" aria-label="Seleccione un país:" name="ID_Pais" id="ID_Pais">
                                    @foreach ($countries as $country)
                                    <option value="{{$country->id}}">{{$country->Nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="d-grid gap-2 col-6 mx-auto">
                                <button type="submit" class="btn btn-dark mb-5">Realizar cambios</button>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('includes.footerFinal')
</body>

</html>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Importación de boostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Modificar Juego</title>
</head>

<body>
    @include('includes.navbar')
    <section>
        <div class="container">
            <h4 class="mb-3">¿Estás seguro que quieres eliminar este juego?</h4>
            <form action="" method='POST'>
                @method('PUT')
                <br>
                <button type="submit" class="btn btn-danger regular-button">Borrar</button>
                <a href="/juegosAdmin" class="btn btn-primary">Regresar</a>
            </form>
        </div>
    </section>
    @include('includes.footerFinal')
</body>
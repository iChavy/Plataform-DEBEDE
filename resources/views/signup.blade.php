<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Importación de boostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Home</title>
</head>

<body>
    @include('includes.navbar')
    <section>
        <div class="container">
            <div class="row">
                <div class="col">
                    <h4 class="mb-3">Registrarse</h4>
                    <form action="{{action('UserController@store')}}" method='POST'>
                        <div class="mb-3">
                            <label for="Correo_electronico" class="form-label">Correo electrónico</label>
                            <input type="text" class="form-control" id="name" name="Correo_electronico" value="">
                        </div>
                        <div class="mb-3">
                            <label for="Contrasenya" class="form-label">Contraseña</label>
                            <input type="text" class="form-control" id="name" name="Contrasenya" value="">
                        </div>
                        <div class="mb-3">
                            <label for="Fecha_Nacimiento" class="form-label">Fecha de nacimiento</label>
                            <input type="date_format" class="form-control" id="name" name="Fecha_Nacimiento" value="">
                        </div>
                        <div class="mb-3">
                            <label for="ID_Pais" class="form-label">País</label>
                            <input type="integer" class="form-control" id="name" name="ID_Pais" value="">
                        </div>
                        </select>
                </div>
                <button type="submit" class="btn btn-primary">Enviar</button>
                </form>
            </div>
        </div>
        </div>
    </section>
    @include('includes.footer')
</body>

</html>
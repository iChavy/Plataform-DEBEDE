<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Importación de boostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Cambios</title>
</head>

<body>
    @include('includes.navbar')
    <section>
    <div class="position-absolute top-50 start-50 translate-middle " style="width: 30rem;">
        <div class="alert alert-success text-center" role="alert">
            Los cambios se han guardado
        </div>
        </div>
    </section>
    @include('includes.footer')
</body>

</html>
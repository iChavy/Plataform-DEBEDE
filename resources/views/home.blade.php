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
                    <div class="card" style="width: 18rem;">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Prueba</h5>
                            <p class="card-text">Descripción.</p>
                            <a href="#" class="btn btn-primary">Ir a Prueba</a>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
    @include('includes.footer')

</body>

</html>
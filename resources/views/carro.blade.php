<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Importación de boostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Carro</title>
</head>

<body>
    @include('includes.navbar')
    <section>
        <div class="container">
            <div class="row">
                <div class="col">
                    <h4 class="mb-3">Carro de compras</h4>
                    <form action="" method='POST'>
                        <fieldset disabled>
                            <samp>Nombre: {{$games->Nombre}}</samp>
                        </fieldset>
                        <fieldset disabled>
                            <samp>Precio: ${{$games->Precio}}</samp>
                        </fieldset>
                        <a href="/tarjeta" class="btn btn-primary">Pagar con tarjeta</a>
                        <a href="/moneda" class="btn btn-primary">Pagar con moneda</a>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </section>
    @include('includes.footer')
</body>

</html>
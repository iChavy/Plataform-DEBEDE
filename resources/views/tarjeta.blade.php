<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Importación de boostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Pagar</title>
</head>

<body>
    @include('includes.navbar')
    <section>
        <div class="container">
            <div class="row">
                <div class="col">
                    <h4 class="mb-3"></h4>
                    <form action="{{action('PaymentMethodController@store')}}" method='POST'>
                        <div class="mb-3">
                            <label for="Nombre" class="form-label">Nombre de la tarjeta</label>
                            <select class="form-select mb-4" aria-label="Seleccione el tipo de tarjeta:" name="Nombre" id="Nombre">
                                @foreach ($paymentmethods as $paymentmethod)
                                <option value="{{$paymentmethod->id}}">{{$paymentmethod->Nombre}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="Nro_tarjeta" class="form-label">Número de la tarjeta</label>
                            <input type="text" placeholder="123456789" class="form-control @error('Nro_tarjeta') is-invalid @enderror" id="nro" name="nro" value="">
                            @error('nro')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                </div>
                <!--<button type="submit" class="btn btn-primary">Enviar</button>-->
                <a href="/tarjeta" class="btn btn-primary">no hace nada</a>
                </form>
            </div>
        </div>
        </div>
    </section>
    @include('includes.footerFinal')
</body>

</html>
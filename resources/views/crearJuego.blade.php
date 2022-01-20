<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Importación de boostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Crear Juego</title>
</head>

<body>
    @include('includes.navbar')
    <section>
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="position-absolute top-50 start-50 translate-middle " style="width: 30rem;">
                        <h4 class="mb-3 text-center">Crea un Juego</h4>
                        <form action="/game/crearJuego/{{$_COOKIE['id']}}" method='POST'>

                            <div class="mb-3">
                                <label for="ID_Restriccion" class="form-label">Restricción de edad</label>
                                <select class="form-select mb-4" aria-label="Seleccione un tipo de restricción de edad:" name="ID_Restriccion" id="ID_Restriccion">
                                    @foreach ($agerestrictions as $agerestriction)
                                    <option value="{{$agerestriction->id}}">{{$agerestriction->Tipo_restriccion}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="Nombre" class="form-label">Nombre del juego</label>
                                <input type="text" placeholder="Ingrese el nombre del juego" class="form-control @error('Nombre') is-invalid @enderror" id="name" name="Nombre" value="">
                                @error('Nombre')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="Descripcion" class="form-label">Descripcion del juego</label>
                                <input type="text" placeholder="Ingrese la descripción del juego" class="form-control @error('Descripcion') is-invalid @enderror" id="name" name="Descripcion" value="">
                                @error('Descripcion')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="Precio" class="form-label">Ingrese el valor del juego</label>
                                <input type="integer" placeholder="El rango de precio varia entre 5000 y 70000" class="form-control @error('Precio') is-invalid @enderror" id="name" name="Precio" value="">
                                @error('Precio')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="Link" class="form-label">Link del juego</label>
                                <input type="url" placeholder="Ingrese el link del juego" class="form-control @error('Link') is-invalid @enderror" id="name" name="Link" value="">
                                @error('Link')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="Link_Demo" class="form-label">Link demo del juego</label>
                                <input type="date_format" placeholder="Ingrese el link demo del juego" class="form-control @error('Link_Demo') is-invalid @enderror" id="name" name="Link_Demo" value="">
                                @error('Link_Demo')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="imagen" class="form-label">Imagen del juego</label>
                                <input type="url" placeholder="Ingrese el link de la imagen" class="form-control @error('imagen') is-invalid @enderror" id="name" name="imagen" value="">
                                @error('imagen')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="d-grid gap-2 col-6 mx-auto">
                                <button type="submit" class="btn btn-dark">Enviar</button>
                            </div>
                    </div>

                    </form>
                </div>
            </div>
        </div>
        </div>
    </section>
    @include('includes.footerFinal')
</body>

</html>
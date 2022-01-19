<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Importación de boostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Login</title>
</head>

<body>
    @include('includes.navbar')
    <section>
        <div class="container">
            <div class="row">
                <div class="col">
                    <h4 class="mb-3">Ingresar</h4>
                    <form action="" method='POST'>
                        <div class="mb-3">
                            <label for="Correo_electronico" class="form-label">Correo electrónico</label>
                            <input type="text" placeholder="email@example.com" class="form-control @error('Correo_electronico') is-invalid @enderror" id="email" name="email" value="">
                            @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="Contrasenya" class="form-label">Contraseña</label>
                            <input type="text" placeholder="Debe tener entre 6 y 8 caracteres" class="form-control @error('Contrasenya') is-invalid @enderror" id="Contrasenya" name="Contrasenya" value="">
                            @error('Contrasenya')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    
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
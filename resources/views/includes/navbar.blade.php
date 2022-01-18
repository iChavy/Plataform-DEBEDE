<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">DEBEDE</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Inicio</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/juegos">Juegos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/crearJuego">Crear Juego</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/signup">Registrarse</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/modificarUser">Modificar usuario</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active"  aria-current="page" href="/login">LOG IN</a>
                    </li>
                    @if(isset($_COOKIE['user']))
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/home">{{$_COOKIE['user']}}</a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link active"  aria-current="page" href="/logout">LOG OUT</a>
                    </li>
                </ul>
                
                
            </div>
        </div>
    </nav>
</header>
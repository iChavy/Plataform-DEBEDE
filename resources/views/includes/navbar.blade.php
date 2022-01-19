<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">DEBEDE</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @if(isset($_COOKIE['user']) === null)
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/inicio">Inicio</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/signup">Registrarse</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/login">LOG IN</a>
                    </li>
                    @elseif(isset($_COOKIE['user']))  <!-- == 1, ==2, desaroolador-->

                    <li class="nav-item">
                        <a class="nav-link" href="/juegos">Juegos</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/crearJuego">Crear Juego</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/modificarJuego">Modificar Juego</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/user/edit/{{$_COOKIE['id']}}">Modificar usuario</a>
                    </li>                   

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/user/vistaUser/{{$_COOKIE['id']}}">Perfil: {{$_COOKIE['user']}}</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/logout">LOG OUT</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/inicio">Inicio</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/signup">Registrarse</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/login">LOG IN</a>
                    </li>
                    @endif

                </ul>


            </div>
        </div>
    </nav>
</header>
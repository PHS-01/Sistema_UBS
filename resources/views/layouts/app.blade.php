<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Title Default')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    @yield('style')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Meu Projeto</a>
            {{-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Sobre</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contato</a>
                    </li>
                </ul>
            </div> --}}
            @guest
                <div class="justify-content-end">
                    <a href="{{url('/login')}}" class="btn btn-primary">Login</a>
                    <a href="{{url('/register')}}" class="btn btn-outline-primary">Registrar</a>
                </div>
            @endguest
            @auth
                <div class="justify-content-end d-flex">
                    <form action="{{url('/logout')}}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger">logout</button>
                    </form>
                    <a href="{{url('/profile')}}" class="btn btn-info ms-2">Profile</a>
                </div>
            @endauth
        </div>
    </nav>

    <div class="container text-center mt-5">
        @yield('container', 'Aqui vai ficar todo o conteudo da pagina.')
    </div>

    <footer class="text-center mt-5 mb-3">
        <p>&copy; {{ date('Y') }} Meu Projeto. Todos os direitos reservados.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    @yield('script')
</body>
</html>
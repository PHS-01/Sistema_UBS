<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Title Default')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Estilo do Alerta de Sucesso */
        #success-alert {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            width: 40vh; /* Define uma largura fixa */
            z-index: 1050; /* Mantém o alerta sobre outros elementos */
            opacity: 0.95; /* Leve transparência para dar um toque mais suave */
            background-color: white; /* Cor de fundo neutra */
            color: #333; /* Cor do texto */
            border: 1px solid #ddd; /* Borda leve */
            border-radius: 8px; /* Bordas arredondadas */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Sombra suave */
            padding: 15px; /* Espaçamento interno */
            animation: slideDown 0.5s ease-out; /* Animação de entrada */
        }

        /* Animações de entrada e saída */
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translate(-50%, -20px);
            }
            to {
                opacity: 0.95;
                transform: translate(-50%, 0);
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0.95;
                transform: translate(-50%, 0);
            }
            to {
                opacity: 0;
                transform: translate(-50%, -20px);
            }
        }

        /* Alinha o botão de fechar */
        #success-alert .btn-close {
            position: absolute;
            top: 10px;
            right: 10px;
        }
    </style>
    @yield('style')
</head>
<body>

    <!-- Alerta de Sucesso -->
    @if(session('success'))
        <div id="success-alert" class="alert alert-dismissible fade show text-center" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Meu Projeto</a>
            @guest
                <div class="justify-content-end">
                    <a href="{{ url('/login') }}" class="btn btn-primary">Login</a>
                    <a href="{{ url('/register') }}" class="btn btn-outline-primary">Registrar</a>
                </div>
            @endguest
            @auth
                <div class="justify-content-end d-flex">
                    <form action="{{ url('/logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger">Logout</button>
                    </form>
                    <a href="{{ url('/profile') }}" class="btn btn-info ms-2">Perfil</a>
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
    <script>
        // Função para ocultar o alerta automaticamente após 5 segundos
        setTimeout(() => {
            const alert = document.getElementById('success-alert');
            if (alert) {
                alert.style.animation = "slideUp 0.5s ease-out forwards"; // Adiciona animação de saída
                
                setTimeout(() => {
                    alert.remove(); // Remove o alerta do DOM depois que o fade-out completa
                }, 500); // 500ms para esperar a animação terminar
            }
        }, 2500); // 5000ms = 5 segundos
    </script>
    @yield('script')
</body>
</html>
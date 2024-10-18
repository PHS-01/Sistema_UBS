<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulários Centralizados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        #container_form {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Altura da tela */
        }
        .form-section { display: none; }
    </style>
</head>
<body>
    <nav class="fixed-top">
        <a href="{{url('/')}}" class="btn btn-outline-primary">Voltar</a>
    </nav>
    <div class="container" id="container_form">
        <div class="card text-center mx-auto" id="form_card" style="width: 50%;">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" onclick="showForm('Paciente')" href="#">Paciente</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" onclick="showForm('Recepcionista')" href="#">Recepcionista</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" onclick="showForm('Medico')" href="#">Médico</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <!-- Formulário de Login de Paciente -->
                <div id="Paciente" class="form-section">
                    <h2>Login de Paciente</h2>
                    <form>
                        <div class="mb-3">
                            <label for="login-email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="login-email" placeholder="Digite o email" required>
                        </div>
                        <div class="mb-3">
                            <label for="login-password" class="form-label">Senha</label>
                            <input type="password" class="form-control" id="login-password" placeholder="Digite a senha" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Entrar</button>
                    </form>
                </div>
        
                <!-- Formulário de Login de Recepcionista -->
                <div id="Recepcionista" class="form-section">
                    <h2>Login de Recepcionista</h2>
                    <form>
                        <div class="mb-3">
                            <label for="recepcionista-email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="recepcionista-email" placeholder="Digite o email" required>
                        </div>
                        <div class="mb-3">
                            <label for="recepcionista-password" class="form-label">Senha</label>
                            <input type="password" class="form-control" id="recepcionista-password" placeholder="Digite a senha" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Entrar</button>
                    </form>
                </div>
        
                <!-- Formulário de Login de Médico -->
                <div id="Medico" class="form-section">
                    <h2>Login de Médico</h2>
                    <form>
                        <div class="mb-3">
                            <label for="login-cm" class="form-label">CM</label>
                            <input type="number" class="form-control" id="login-cm" placeholder="Digite o CM" required>
                        </div>
                        <div class="mb-3">
                            <label for="medico-email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="medico-email" placeholder="Digite o email" required>
                        </div>
                        <div class="mb-3">
                            <label for="medico-password" class="form-label">Senha</label>
                            <input type="password" class="form-control" id="medico-password" placeholder="Digite a senha" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Entrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showForm(formId) {
            // Oculta todos os formulários
            const forms = document.querySelectorAll('.form-section');
            forms.forEach(form => form.style.display = 'none');
            
            // Exibe o formulário selecionado
            document.getElementById(formId).style.display = 'block';
        }

        // Exibir o formulário de paciente por padrão
        document.addEventListener("DOMContentLoaded", function() {
            showForm('Paciente');
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

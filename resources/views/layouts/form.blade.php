<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Title Default')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        #container_form {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .form-section { display: none; }
    </style>
    @yield('style')
</head>
<body>
    <nav class="fixed-top">
        <a href="{{url()->previous()}}" class="btn btn-outline-primary m-3">Voltar</a>
    </nav>

    <div class="container" id="container_form">
        @yield('content_form' , 'Aqui se encontra o conteudo do formulario')
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
            showForm('Admin');
        });

    </script>
    
    @yield('script')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

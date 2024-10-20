@extends('layouts.form')

@section('title', 'Profile')

@section('style')
    <style>
        #container_form { height: 100vh; }

        #overlay {
            display: none; /* Oculta o fundo escurecido inicialmente */
            position: fixed; /* Fixa o overlay */
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5); /* Cor de fundo escurecido */
            z-index: 999; /* Abaixo do card, mas acima do resto */
            transition: display 0.3s ease; /* Transição para aparecer/desaparecer */
        }

        #deleteAccountForm {
            display: none; /* Oculta o formulário inicialmente */
            position: fixed; /* Fixa o formulário */
            top: 20%; /* Distância do topo */
            left: 50%; /* Centraliza horizontalmente */
            transform: translate(-50%, -50%); /* Centraliza verticalmente */
            width: 300px; /* Largura do card */
            z-index: 1000; /* Certifica que está acima de outros elementos */
            transition: all 0.3s ease; /* Transição suave */
        }
    </style>
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#deleteAccountBtn').click(function() {
                $('#overlay').fadeIn(); // Mostra o fundo escurecido
                $('#deleteAccountForm').fadeIn(); // Mostra o formulário
            });

            $('#cancelDeleteBtn').click(function() {
                $('#overlay').fadeOut(); // Esconde o fundo escurecido
                $('#deleteAccountForm').fadeOut(); // Esconde o formulário
            });
        });
    </script>
@endsection

@section('content_form')
    <div id="overlay"></div> <!-- Fundo escurecido -->

    <div id="deleteAccountForm" class="card mt-3 w-50">
        <div class="card-body">
            <h5 class="card-title">Confirme sua senha para deletar sua conta</h5>
            <form action="{{ route('profile.destroy', ['user' => Auth::user()]) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="form-group">
                    <label for="password">Senha:</label>
                    <input type="password" name="password" class="form-control" id="password" required placeholder="Digite a senha">
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="d-flex justify-content-between mt-3">
                    <button type="button" class="btn btn-secondary" id="cancelDeleteBtn">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Deletar Perfil</button>
                </div>
            </form>
        </div>
    </div>
    
    <div class="card w-100">
        <div class="card-header text-center">
            <h2>Perfil do Usuário</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center">
                    <h3>{{ Auth::user()->name }}</h3>
                    <p>{{ Auth::user()->type }}</p>
                </div>
                <div class="col-md-8">
                    <h5>Informações Pessoais</h5>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Email:</strong> {{ Auth::user()->email }}</li>
                        @switch(Auth::user()->type)
                            @case('admin')
                                {{-- @foreach ([] as $field => $label)
                                    <li class="list-group-item"><strong>{{$label}}:</strong> {{ Auth::user()->profile->$field }}</li>
                                @endforeach --}}
                                @break
                            @case('receptionist')
                                {{-- Informações da recepcionista --}}
                                @break
                            @case('doctor')
                                @foreach (['cm' => 'CM', 'birth_date' => 'Data de Nascimento', 'address' => 'Endereço', 'status' => 'Status', 'education' => 'Educação', 'hiring_date' => 'Data de Contratação', 'opening_time' => 'Horario de Atendimento','closing_time' => 'Horario de Encerramento'] as $field => $label)
                                    <li class="list-group-item"><strong>{{$label}}:</strong> {{ Auth::user()->profile->$field }}</li>
                                @endforeach
                                @break
                            @default
                        @endswitch
                    </ul>
                    <div class="d-flex mt-3">
                        <a href="#" class="btn btn-outline-primary btn-lg">Editar Perfil</a>
                        <button class="btn btn-outline-danger btn-lg ms-auto" id="deleteAccountBtn">Deletar Conta</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

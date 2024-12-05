@extends('layouts.form')

@section('title', 'Register')

@section('style')
<style>
    /* #container_form { height: 150vh; } */
    .container {
        padding-top: 6rem;
        padding-bottom: 6rem;
    }
</style>
@endsection

@section('content_form')
<div class="card text-center mx-auto" id="form_card" style="width: 50%;">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item">
                <a class="nav-link active" onclick="showForm('Admin')" href="#">Admin</a>
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
        <!-- Formulário de Cadastro de Admin -->
        <div id="Admin" class="form-section">
            <h2>Cadastro de Admin</h2>
            <form action="{{url('/register')}}" method="POST">
                @csrf
                <input type="hidden" name="type" value="admin">
                @foreach(['name' => 'Nome', 'email' => 'Email', 'password' => 'Senha', 'password_confirmation' => 'Confirmação da Senha'] as $field => $label)
                    <div class="mb-3">
                        <label for="register-{{ $field }}" class="form-label">{{ $label }}</label>
                        <input
                            type="{{ $field == 'email' ? 'email' : ($field == 'password_confirmation' || $field == 'password' ? 'password' : 'text') }}"
                            name="{{ $field }}" class="form-control" id="register-{{ $field }}"
                            placeholder="Digite o seu {{ strtolower($label) }}" required value="{{ old($field) }}">
                        @error($field)
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                @endforeach
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </form>
        </div>

        <!-- Formulário de Login de Recepcionista -->
        <div id="Recepcionista" class="form-section">
            <h2>Login de Recepcionista</h2>
            <form action="{{url('/register')}}" method="POST">
                @csrf
                <input type="hidden" name="type" value="receptionist">
                @foreach(['name' => 'Nome', 'email' => 'Email', 'password' => 'Senha', 'password_confirmation' => 'Confirmação da Senha'] as $field => $label)
                    <div class="mb-3">
                        <label for="register-{{ $field }}" class="form-label">{{ $label }}</label>
                        <input
                            type="{{ $field == 'email' ? 'email' : ($field == 'password_confirmation' || $field == 'password' ? 'password' : 'text') }}"
                            name="{{ $field }}" class="form-control" id="register-{{ $field }}"
                            placeholder="Digite o seu {{ strtolower($label) }}" required value="{{ old($field) }}">
                        @error($field)
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                @endforeach
                <button type="submit" class="btn btn-primary">Entrar</button>
            </form>
        </div>

        <!-- Formulário de Login de Médico -->
        <div id="Medico" class="form-section">
            <h2>Login de Médico</h2>
            <form action="{{url('/register')}}" method="POST">
                @csrf
                <input type="hidden" name="type" value="doctor">
                @foreach(['name' => 'Nome', 'email' => 'Email', 'password' => 'Senha', 'password_confirmation' => 'Confirmação da Senha'] as $field => $label)
                    <div class="mb-3">
                        <label for="register-{{ $field }}" class="form-label">{{ $label }}</label>
                        <input
                            type="{{ $field == 'email' ? 'email' : ($field == 'password_confirmation' || $field == 'password' ? 'password' : 'text') }}"
                            name="{{ $field }}" class="form-control" id="register-{{ $field }}"
                            placeholder="Digite o seu {{ strtolower($label) }}" required value="{{ old($field) }}">
                        @error($field)
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                @endforeach

                <!-- Campos adicionais para médico -->
                @foreach(['cm' => 'CM', 'birth_date' => 'Data de Nascimento', 'address' => 'Endereço', 'status' => 'Status', 'education' => 'Educação', 'hiring_date' => 'Data de Contratação', 'opening_time' => 'Previsão de Atendimento', 'closing_time' => 'Previsão de Encerramento'] as $field => $label)
                    <div class="mb-3">
                        <label for="{{ $field }}" class="form-label">{{ $label }}</label>
                        <input
                            type="{{ $field == 'birth_date' || $field == 'hiring_date' ? 'date' : ($field == 'opening_time' || $field == 'closing_time' ? 'time' : 'text') }}"
                            name="{{ $field }}" class="form-control" id="{{ $field }}"
                            placeholder="Digite o(a) {{ strtolower($label) }}" required>
                        @error($field)
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                @endforeach

                <button type="submit" class="btn btn-primary">Entrar</button>
            </form>
        </div>
    </div>
</div>
@endsection

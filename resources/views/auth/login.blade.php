@extends('layouts.form')

@section('title', 'Login')

@section('style')
    <style>
        #container_form { height: 100vh;}
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
        <!-- Formulário de Login de Admin -->
        <div id="Admin" class="form-section">
            <h2>Login de Admin</h2>
            <input type="hidden" name="type" value="admin">
            <form action="{{url('/login')}}" method="POST">
                @csrf
                @foreach(['email' => 'Email', 'password' => 'Senha'] as $field => $label)
                    <div class="mb-3">
                        <label for="register-{{ $field }}" class="form-label">{{ $label }}</label>
                        <input type="{{  $field == 'email' ? 'email' : ($field == 'password' ? 'password' : 'text') }}" name="{{ $field }}" class="form-control" id="register-{{ $field }}" placeholder="Digite o seu {{ strtolower($label) }}" required value="{{ old($field) }}">
                        @error($field)
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                @endforeach
                <button type="submit" class="btn btn-primary">Entrar</button>
            </form>
        </div>

        <!-- Formulário de Login de Recepcionista -->
        <div id="Recepcionista" class="form-section">
            <h2>Login de Recepcionista</h2>
            <form action="{{url('/login')}}" method="POST">
                @csrf
                @foreach(['email' => 'Email', 'password' => 'Senha'] as $field => $label)
                    <div class="mb-3">
                        <label for="register-{{ $field }}" class="form-label">{{ $label }}</label>
                        <input type="{{  $field == 'email' ? 'email' : ($field == 'password' ? 'password' : 'text')}}" name="{{ $field }}" class="form-control" id="register-{{ $field }}" placeholder="Digite o seu {{ strtolower($label) }}" required value="{{ old($field) }}">
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
            <form action="{{url('/login')}}" method="POST">
                @csrf
                @foreach(['cm' => 'CM', 'email' => 'Email', 'password' => 'Senha'] as $field => $label)
                    <div class="mb-3">
                        <label for="register-{{ $field }}" class="form-label">{{ $label }}</label>
                        <input type="{{ $field == 'email' ? 'email' : ($field == 'password' ? 'password' : 'number') }}" name="{{ $field }}" class="form-control" id="register-{{ $field }}" placeholder="Digite o seu {{ strtolower($label) }}" required value="{{ old($field) }}">
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
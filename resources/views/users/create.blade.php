@extends('layouts.form')

@section('title', 'Register')

@section('style')
    <style>
        #container_form { height: 150vh; }
    </style>
@endsection

@section('content_form')
    <div class="card text-center mx-auto" style="width: 50%;">
        <div class="card-body">
            <h2>Create de {{$type}}</h2>
            <form action="{{url('/admin/create')}}" method="POST">
                @csrf
                <input type="hidden" name="type" value="{{$type}}">
                @if ($type == 'receptionist')
                    @foreach(['name' => 'Nome', 'email' => 'Email', 'password' => 'Senha', 'password_confirmation' => 'Confirmação da Senha'] as $field => $label)
                        <div class="mb-3">
                            <label for="register-{{ $field }}" class="form-label">{{ $label }}</label>
                            <input type="{{ $field == 'email' ? 'email' : ( $field == 'password_confirmation'|| $field == 'password' ? 'password' :'text') }}" name="{{ $field }}" class="form-control" id="register-{{ $field }}" placeholder="Digite o seu {{ strtolower($label) }}" required value="{{ old($field) }}">
                            @error($field)
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    @endforeach      
                @else
                    @foreach(['name' => 'Nome', 'email' => 'Email', 'password' => 'Senha', 'password_confirmation' => 'Confirmação da Senha'] as $field => $label)
                        <div class="mb-3">
                            <label for="register-{{ $field }}" class="form-label">{{ $label }}</label>
                            <input type="{{ $field == 'email' ? 'email' : ($field == 'password_confirmation' || $field == 'password' ? 'password' : 'text') }}" name="{{ $field }}" class="form-control" id="register-{{ $field }}" placeholder="Digite o seu {{ strtolower($label) }}" required value="{{ old($field) }}">
                            @error($field)
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    @endforeach

                    <!-- Campos adicionais para médico -->
                    @foreach(['cm' => 'CM', 'birth_date' => 'Data de Nascimento', 'address' => 'Endereço', 'status' => 'Status', 'education' => 'Educação', 'hiring_date' => 'Data de Contratação', 'opening_time' => 'Previsão de Atendimento', 'closing_time' => 'Previsão de Encerramento'] as $field => $label)
                        <div class="mb-3">
                            <label for="{{ $field }}" class="form-label">{{ $label }}</label>
                            <input type="{{ $field == 'birth_date' || $field == 'hiring_date' ? 'date' : ($field == 'opening_time' || $field == 'closing_time' ? 'time' : 'text') }}" name="{{ $field }}" class="form-control" id="{{ $field }}" placeholder="Digite o(a) {{ strtolower($label) }}" required>
                            @error($field)
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    @endforeach
                @endif
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
@endsection
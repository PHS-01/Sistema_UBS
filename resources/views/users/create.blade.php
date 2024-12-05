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
    <div class="card text-center mx-auto" style="width: 50%;">
        <div class="card-body">
            <h2>Criar {{$type == 'receptionist' ? "Recepcionista" : ($type == 'doctor' ? "Doutor" : 'Paciente')}}</h2>
            <form action="{{ $type != 'patient' ? url('/admin/create') : url('/receptionist/create') }}" method="POST">
                @csrf
                <input type="hidden" name="type" value="{{$type}}">
                @switch($type)
                    @case('receptionist')
                        @foreach(['name' => 'Nome', 'email' => 'Email', 'password' => 'Senha', 'password_confirmation' => 'Confirmação da Senha'] as $field => $label)
                            <div class="mb-3">
                                <label for="register-{{ $field }}" class="form-label">{{ $label }}</label>
                                <input type="{{ $field == 'email' ? 'email' : ( $field == 'password_confirmation'|| $field == 'password' ? 'password' :'text') }}" name="{{ $field }}" class="form-control" id="register-{{ $field }}" placeholder="Digite o seu {{ strtolower($label) }}" required value="{{ old($field) }}">
                                @error($field)
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        @endforeach
                        @break
                    @case('admin')

                        @break
                    @case('patient')
                        @foreach ([
                            'name' => 'Nome',
                            'sus_number' => 'Número do cartão do SUS',
                            'birth_date' => 'Data de nacimento',
                            'phone' => 'Número de telefone',
                            'address' => 'Endereço'
                        ] as $field => $label)
                            <div class="mb-3">
                                <label for="register-{{ $field }}" class="form-label">{{ $label }}</label>
                                <input
                                    type="{{ $field === 'sus_number' ? 'number' : ($field === 'birth_date' ? 'date' : 'text') }}"
                                    name="{{ $field }}"
                                    class="form-control"
                                    id="register-{{ $field }}"
                                    placeholder="Digite o seu {{ strtolower($label) }}"
                                    required
                                    value="{{ old($field) }}"
                                >
                                @error($field)
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        @endforeach

                        <!-- Campo de seleção de gênero -->
                        <div class="mb-3">
                            <label for="register-gender" class="form-label">Gênero</label>
                            <select name="gender" id="register-gender" class="form-select" required>
                                <option value="" disabled selected>Selecione o seu gênero</option>
                                <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Masculino</option>
                                <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Feminino</option>
                            </select>
                            @error('gender')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Campo para anotações -->
                        <div class="mb-3">
                            <label for="register-notes" class="form-label">Anotações</label>
                            <textarea
                                name="notes"
                                id="register-notes"
                                class="form-control"
                                cols="15"
                                rows="5"
                            >{{ old('notes') }}</textarea>
                            @error('notes')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        @break
                    @case('doctor')
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
                        @break
                    @default
                @endswitch
                <button type="submit" class="btn btn-primary">Criar</button>
            </form>
        </div>
    </div>
@endsection

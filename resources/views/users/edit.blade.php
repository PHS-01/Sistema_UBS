@extends('layouts.form')

@section('title', 'Edit')

@section('style')
    <style>
        #container_form { height: 100vh;}
    </style>
@endsection

@section('content_form')
    <div class="card w-100">  
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center">
                    <h3>{{ $user->name }}</h3>
                    <p>{{ $user->type }}</p>
                </div>
                <div class="col-md-8">
                    <h5>Informações Pessoais</h5>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <strong>Email:</strong> {{ $user->email }}
                            <button class="btn btn-outline-warning float-end" data-bs-toggle="modal" data-bs-target="#editEmailModal">Editar</button>
                        </li>
                        @switch($user->type)
                            @case('admin')
                                {{-- Informações específicas do admin --}}
                                @break
                            @case('receptionist')
                                {{-- Informações da recepcionista --}}
                                @break
                            @case('doctor')
                                @foreach (['cm' => 'CM', 'birth_date' => 'Data de Nascimento', 'address' => 'Endereço', 'status' => 'Status', 'education' => 'Educação', 'hiring_date' => 'Data de Contratação', 'opening_time' => 'Horario de Atendimento', 'closing_time' => 'Horario de Encerramento'] as $field => $label)
                                    <li class="list-group-item">
                                        <strong>{{$label}}:</strong> {{ $user->profile->$field }}
                                        <button class="btn btn-outline-warning float-end" data-bs-toggle="modal" data-bs-target="#edit{{ ucfirst($field) }}Modal">Editar</button>
                                    </li>
                                @endforeach
                                @break
                            @default
                        @endswitch
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para editar o email -->
    <div class="modal fade" id="editEmailModal" tabindex="-1" aria-labelledby="editEmailLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{url('/admin/update/'.$user->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editEmailLabel">Editar Email</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary me-auto" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal para editar os campos do médico -->
    @foreach (['cm' => 'CM', 'birth_date' => 'Data de Nascimento', 'address' => 'Endereço', 'status' => 'Status', 'education' => 'Educação', 'hiring_date' => 'Data de Contratação', 'opening_time' => 'Horario de Atendimento', 'closing_time' => 'Horario de Encerramento'] as $field => $label)
        <div class="modal fade" id="edit{{ ucfirst($field) }}Modal" tabindex="-1" aria-labelledby="edit{{ ucfirst($field) }}Label" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{url('/admin/update/'.$user->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="edit{{ ucfirst($field) }}Label">Editar {{ $label }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="{{ $field }}" class="form-label">{{ $label }}</label>
                                <input type="text" class="form-control" id="{{ $field }}" name="{{ $field }}" value="{{ $user->profile->$field }}" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary me-auto" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
@endsection
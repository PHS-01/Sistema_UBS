@extends('layouts.app')

@section('title', 'Admin')

@section('style')
    <style>
        /* Estilo do Card */
        .user-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            border-radius: 10px;
            overflow: hidden;
            background-color: #f8f9fa;
        }
        
        /* Estilo para as colunas */
        .col-md-4 {
            border: 1px solid #e0e0e0; /* Bordas das colunas */
            border-radius: 10px; /* Bordas arredondadas */
            padding: 0; /* Removido o padding, será adicionado em containers internos */
            background-color: #ffffff; /* Cor de fundo */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra das colunas */
            height: 80vh; /* Altura fixa da coluna */
            display: flex;
            flex-direction: column; /* Permite o layout em coluna */
        }

        /* Estilo do cabeçalho da coluna */
        .column-header {
            padding: 20px; /* Espaçamento interno */
            background-color: #f8f9fa; /* Cor de fundo do cabeçalho */
            border-bottom: 1px solid #e0e0e0; /* Linha separadora */
            display: flex; /* Flexbox para o título e o botão */
            align-items: center; /* Alinha verticalmente */
        }

        /* Estilo da área de conteúdo da coluna */
        .column-content {
            overflow: hidden;
            overflow-y: auto; /* Rolagem vertical */
            padding: 20px; /* Espaçamento interno */
            flex-grow: 1; /* Permite que a área cresça para ocupar o espaço restante */
        }

        /* Animação ao passar o mouse */
        .user-card:hover {
            transform: scale(1.05); /* Leve crescimento */
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1); /* Sombra suave */
        }

        /* Estilo dos textos */
        .user-info h6 {
            font-weight: 600;
            margin: 0;
        }

        .user-info small {
            color: #6c757d;
        }

        /* Botões ajustados */
        .card-body a {
            border-radius: 5px;
            font-size: 0.875rem; /* Botões pequenos */
            padding: 6px 12px;
        }

    </style>
@endsection

@section('container')
    <h1 class="m-5">Bem-vindo, administrador {{ Auth::user()->name }}!</h1>
    <div class="row">
        <!-- Coluna 1: Recepcionistas -->
        <div class="col-md-4">
            <div class="column-header">
                <h2>Recepcionistas</h2>
                <a href="{{url('/admin/create/receptionist')}}" class="btn btn-success me-2 ms-auto btn-lg">Create</a>
            </div>
            <div class="column-content">
                @foreach($receptionists as $receptionist)
                    <div class="user-card card mb-3">
                        <div class="card-body d-flex align-items-center">
                            <div class="user-info">
                                <h3 class="mb-1">{{ $receptionist->name }}</h3>
                                <small class="text-muted">Recepcionista</small>
                            </div>
                            <div class="d-flex ms-auto">
                                <a href="{{url('/admin/show/'.$receptionist->id)}}" class="btn btn-sm btn-info me-2">Show</a>
                                <a href="{{url('/admin/edit/'.$receptionist->id)}}" class="btn btn-sm btn-warning me-2">Edit</a>
                                <form action="{{ route('profile.destroy', ['user' => $receptionist->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Coluna 2: Médicos -->
        <div class="col-md-4">
            <div class="column-header">
                <h2>Médicos</h2>
                <a href="{{url('/admin/create/doctor')}}" class="btn btn-success me-2 ms-auto btn-lg">Create</a>
            </div>
            <div class="column-content">
                @foreach($doctors as $doctor)
                    <div class="user-card card mb-3">
                        <div class="card-body d-flex align-items-center">
                            <div class="user-info">
                                <h3 class="mb-1">{{ $doctor->name }}</h3>
                                <small class="text-muted">Médico</small>
                            </div>
                            <div class="d-flex ms-auto">
                                <a href="{{url('/admin/show/'.$doctor->id)}}" class="btn btn-sm btn-info me-2">Show</a>
                                <a href="{{url('/admin/edit/'.$doctor->id)}}" class="btn btn-sm btn-warning me-2">Edit</a>
                                <form action="{{ route('profile.destroy', ['user' => $doctor->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Coluna 3: Pacientes -->
        <div class="col-md-4">
            <div class="column-header">
                <h2>Pacientes</h2>
                <a href="{{url('/admin/create/patient')}}" class="btn btn-success me-2 ms-auto btn-lg">Create</a>
            </div>
            <div class="column-content">
                @foreach($patients as $patient)
                    <div class="user-card card mb-3">
                        <div class="card-body d-flex align-items-center">
                            <div class="user-info">
                                <h3 class="mb-1">{{ $patient->name }}</h3>
                                <small class="text-muted">Paciente</small>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
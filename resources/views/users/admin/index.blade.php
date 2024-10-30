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
            padding: 20px; /* Espaçamento interno */
            background-color: #ffffff; /* Cor de fundo */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra das colunas */
        }

        #card_row{
            border: 1px solid #e0e0e0; /* Bordas das colunas */
            border-radius: 10px; /* Bordas arredondadas */
            padding: 20px; /* Espaçamento interno */
            background-color: #ffffff; /* Cor de fundo */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra das colunas */
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
        <!-- Coluna 1: Recepcionistas -->
    <div class="row">
        <div class="col-md-4">
            <div class="d-flex mb-4">
                <h2>Recepcionistas</h2>
                <a href="{{url('/admin/create/receptionist')}}" class="btn btn-success me-2 ms-auto btn-lg">Create</a>
            </div>
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

        <!-- Coluna 2: Médicos -->
        <div class="col-md-4 mx-5">
            <div class="d-flex mb-4">
                <h2>Médicos</h2>
                <a href="{{url('/admin/create/doctor')}}" class="btn btn-success me-2 ms-auto btn-lg">Create</a>
            </div>
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

        <!-- Coluna 3: Espaços Reservados -->
        <div class="col-md-3">
            <h5 class="mb-3">Espaços Reservados</h5>
            <div class="card mb-3">
                <div class="card-body">
                    <p>Espaço reservado 1</p>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-body">
                    <p>Espaço reservado 2</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row my-5" id="card_row">
        <div class="d-flex mb-4">
            <h2>Pacientes</h2>
            <a href="{{url('/admin/create/patient')}}" class="btn btn-success me-2 ms-auto btn-lg">Create</a>
        </div>
        @foreach($patients as $patient)
            <div class="user-card card mb-3">
                <div class="card-body d-flex align-items-center">
                    <div class="user-info">
                        <h3 class="mb-1">{{ $patient->name }}</h3>
                        <small class="text-muted">Paciente</small>
                    </div>
                    {{-- <div class="d-flex ms-auto">
                        <a href="{{url('/admin/show/'.$patient->id)}}" class="btn btn-sm btn-info me-2">Show</a>
                        <a href="{{url('/admin/edit/'.$patient->id)}}" class="btn btn-sm btn-warning me-2">Edit</a>
                        <form action="{{ route('profile.destroy', ['user' => $patient->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </div> --}}
                </div>
            </div>
        @endforeach
    </div>
@endsection
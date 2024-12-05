@extends('layouts.app')

@section('title', 'Dashboard')

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
        .col-md-4, .col-lg-8 {
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
    <h1 class="m-5">Bem-vindo, {{ Auth::user()->type == 'doctor' ? 'Doutor' : 'Recepcionista' }} {{ Auth::user()->name }}!</h1>
    <div class="row">
        <!-- Coluna: Agendamentos -->
        <div class="col-lg-8 col-md-7 col-sm-12 mb-3">
            <div class="column-header">
                <h2>Agendamentos</h2>
                @if (Auth::user()->type != 'doctor')
                    <a href="{{ url('/scheduling') }}" class="btn btn-success me-2 ms-auto btn-lg">Criar</a>
                @else
                    <a href="{{ url('') }}" class="btn btn-success me-2 ms-auto btn-lg">Lista</a>
                @endif
            </div>
            <div class="column-content">
                @foreach($schedulings as $scheduling)
                    <div class="user-card card mb-3">
                        <div class="card-body d-flex align-items-center">
                            <div class="user-info">
                                <h3 class="mb-1">{{ $scheduling->status }}</h3>
                                <small class="text-muted">{{ $scheduling->scheduled_at->format('d/m/Y') }}</small>
                            </div>
                            <a href="{{url('/scheduling/show/'.$scheduling->id)}}" class="btn btn-sm btn-info ms-auto me-1">Ver</a>
                            @if (Auth::user()->type == 'doctor' && $scheduling->doctor_id == Auth::user()->profile->id && $scheduling->status != "Completed")
                                <a href="{{url('/anamnese/create/'.$scheduling->id)}}" class="btn btn-sm btn-info">Anamnese</a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Coluna: Espaços Reservados -->
        <div class="col-lg-4 col-md-5 col-sm-12">
            <div class="column-header">
                <h2>Cadastrar Paciente</h2>
                <a href="{{ url('/admin/create/patient') }}" class="btn btn-success me-2 ms-auto btn-lg">Criar</a>
            </div>
            {{-- <div class="column-content">
                <div class="card mb-3">
                    <div class="card-body">
                        <p>Espaço reservado 1</p>
                    </div>
                </div>
                <div class="p-3 border bg-light">
                    <h5>Vazio</h5>
                </div>
            </div> --}}
        </div>
    </div>
@endsection
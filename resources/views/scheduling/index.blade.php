@extends('layouts.form')

@section('title', 'Agendamentos')

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
        .col {
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

@section('content_form')
    <div class="row" style="margin-top: 5rem ">
        <!-- Coluna: Agendamentos -->
        <div class="col">
            <div class="column-header">
                <h2>Lista de agendamentos</h2>
            </div>
            <div class="column-content">
                @foreach($schedulings as $scheduling)
                    <div class="user-card card mb-3" style="width: 150vh" >
                        <div class="card-body d-flex align-items-center">
                            <div class="user-info">
                                <h3 class="mb-1">{{ $scheduling->status == 'Completed' ? 'Completo' : ($scheduling->status == 'Pending' ? 'Em espera' : ($scheduling->status == 'In Progress' ? ' Em andamento' : 'Cancelado')) }}</h3>
                                <small class="text-muted">{{ $scheduling->scheduled_at->format('d/m/Y') }}</small>
                            </div>
                            <a href="{{url('/scheduling/show/'.$scheduling->id)}}" class="btn btn-sm btn-info ms-auto me-1">Ver</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
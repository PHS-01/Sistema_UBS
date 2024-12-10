@extends('layouts.app')

@section('title', 'Bem-vindo')

@section('style')
    <style>
        /* Estilo do container principal */
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        /* Estilo para a área de boas-vindas */
        #div-infor {
            text-align: center;
        }

        /* Estilo do Card */
        .user-card {
            padding: 10px;
            margin-bottom: 15px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 10px;
            background: #ffffff;
            border: 1px solid #ddd;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        }

        .user-card h3 {
            font-size: 1.2rem;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
        }

        .user-card small {
            font-size: 0.85rem;
        }

        /* Estilo para as colunas */
        .col {
            height: 60vh;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            padding: 0;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            border-radius: 5%; 
        }

        /* Estilo do cabeçalho da coluna */
        .column-header {
            border-radius: 5%; 
            padding: 20px;
            background-color: rgb(224, 224, 224);
            color: black;
            font-size: 1.25rem;
            font-weight: bold;
            border-bottom: 2px solid gray;
        }

        /* Estilo da área de conteúdo da coluna */
        .column-content {
            overflow: hidden;
            overflow-y: auto;
            padding: 20px;
            flex-grow: 1;
        }

        /* Animação ao passar o mouse */
        .user-card:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .col {
                margin-bottom: 20px;
            }

            .column-header {
                font-size: 1rem;
            }

            .user-card h3 {
                font-size: 1rem;
            }

            .user-card small {
                font-size: 0.75rem;
            }
        }
    </style>
@endsection

@section('container')
    <section class="mb-5">
        <div id="div-infor mt-auto">
            <h1>Bem-vindo ao Sistema UBS!</h1>
        </div>
    </section>
    <section>
        <div class="row">
            <!-- Coluna: Agendamentos -->
            <div class="col">
                <div class="column-header">
                    <h2>Agendamentos do dia</h2>
                </div>
                <div class="column-content">
                    @if ($schedulings->isNotEmpty())
                        @foreach($schedulings as $scheduling)
                            <div class="user-card">
                                <div class="card-body d-flex align-items-center">
                                    <div class="user-info">
                                        <h3>
                                            @if ($scheduling->status == 'Completed')
                                                <i class="fas fa-check-circle text-success"></i>
                                            @elseif ($scheduling->status == 'Pending')
                                                <i class="fas fa-clock text-warning"></i>
                                            @elseif ($scheduling->status == 'In Progress')
                                                <i class="fas fa-spinner text-primary"></i>
                                            @else
                                                <i class="fas fa-times-circle text-danger"></i>
                                            @endif
                                            {{ $scheduling->status == 'Completed' ? 'Completo' : ($scheduling->status == 'Pending' ? 'Em espera' : ($scheduling->status == 'In Progress' ? 'Em andamento' : 'Cancelado')) }}
                                        </h3>
                                        <small class="text-muted">
                                            {{ $scheduling->scheduled_at->format('d/m/Y') }}
                                        </small>
                                    </div>
                                    <div class="d-flex ms-auto" style="flex-direction: column">
                                        <small>
                                            @foreach ($users as $user)
                                                @if ($user->id == $scheduling->doctor->user_id)
                                                    Médico: {{ $user->name }}
                                                @endif
                                            @endforeach
                                        </small>
                                        <small>
                                            Paciente: {{ $scheduling->patient->name }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <small class="mt-5">Sem Agendamentos agora!</small>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
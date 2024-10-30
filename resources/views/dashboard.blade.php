@extends('layouts.app')

@section('title', 'Dasboard')

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
    <h1 class="m-5">Bem-vindo, {{Auth::user()->type}} {{ Auth::user()->name }}!</h1>

    <div class="row">
        <!-- Campo da esquerda (maior) -->
        <div class="col-lg-8 col-md-7 col-sm-12 mb-3">
            <div class="d-flex-inline mb-4">
                <div class="d-flex mb-4">
                    <h2>Agendamentos</h2>
                    @if (Auth::user()->type != 'doctor')
                        <a href="{{url('/scheduling')}}" class="btn btn-success me-2 ms-auto btn-lg">Create</a>
                    @else
                        <a href="{{url('')}}" class="btn btn-success me-2 ms-auto btn-lg">List</a>
                    @endif
                </div>
                @foreach($schedulings as $scheduling)
                    <div class="user-card card mb-3">
                        <div class="card-body d-flex align-items-center">
                            <div class="user-info">
                                <h3 class="mb-1">{{ $scheduling->status }}</h3>
                                <small class="text-muted">{{ $scheduling->scheduled_at }}</small>
                            </div>
                            {{-- <div class="d-flex ms-auto">
                                <a href="{{url('/admin/show/'.$receptionist->id)}}" class="btn btn-sm btn-info me-2">Show</a>
                                <a href="{{url('/admin/edit/'.$receptionist->id)}}" class="btn btn-sm btn-warning me-2">Edit</a>
                                <form action="{{ route('profile.destroy', ['user' => $receptionist->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            </div> --}}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Campo da direita (menor) -->
        <div class="col-lg-4 col-md-5 col-sm-12">

            <h5 class="mb-3">Espaços Reservados</h5>
            <div class="card mb-3">
                <div class="card-body">
                    <p>Espaço reservado 1</p>
                    <a href="{{url('/admin/create/patient')}}" class="btn btn-success me-2 ms-auto btn-lg">Create</a>
                </div>
            </div>

            <div class="p-3 border bg-light">
                <h5>Vazio</h5>
            </div>
        </div>
    </div>
@endsection
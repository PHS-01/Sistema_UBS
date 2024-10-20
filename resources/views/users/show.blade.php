@extends('layouts.app')

@section('title', 'Show')

@section('container')
    <div class="card w-100">
        <div class="card-header text-center d-flex align-items-center">
            <a href="{{ url('/admin') }}" class="btn btn-outline-primary me-auto">Voltar</a>
            <h2 class="mx-auto mb-0">Show</h2>
        </div>        
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center">
                    <h3>{{ $user->name }}</h3>
                    <p>{{ $user->type }}</p>
                </div>
                <div class="col-md-8">
                    <h5>Informações Pessoais</h5>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Email:</strong> {{ $user->email }}</li>
                        @switch($user->type)
                            @case('admin')
                                {{-- @foreach ([] as $field => $label)
                                    <li class="list-group-item"><strong>{{$label}}:</strong> {{ Auth::user()->profile->$field }}</li>
                                @endforeach --}}
                                @break
                            @case('receptionist')
                                {{-- Informações da recepcionista --}}
                                @break
                            @case('doctor')
                                @foreach (['cm' => 'CM', 'birth_date' => 'Data de Nascimento', 'address' => 'Endereço', 'status' => 'Status', 'education' => 'Educação', 'hiring_date' => 'Data de Contratação', 'opening_time' => 'Horario de Atendimento','closing_time' => 'Horario de Encerramento'] as $field => $label)
                                    <li class="list-group-item"><strong>{{$label}}:</strong> {{ $user->profile->$field }}</li>
                                @endforeach
                                @break
                            @default
                        @endswitch
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

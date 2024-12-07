@extends('layouts.app')

@section('title', 'Show')

@section('container')
    <div class="card w-100 mb-5">
        <div class="card-header text-center d-flex align-items-center">
            <a href="{{ url('/dashboard') }}" class="btn btn-outline-primary me-auto">Voltar</a>
            <h2 class="mx-auto mb-0">Agendamento</h2>
        </div>        
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center my-auto">
                    <h3>{{ $scheduling->status == 'Completed' ? 'Completo' : ($scheduling->status == 'Pending' ? 'Em espera' : ($scheduling->status == 'In Progress' ? ' Em andamento' : 'Cancelado')) }}</h3>
                    <p>{{ $scheduling->scheduled_at->format('d/m/Y') }}</p>
                </div>
                <div class="col-md-8">
                    <h5>Informações do Agendamento {{ $scheduling->id}}</h5>
                    <ul class="list-group">
                        <li class="list-group-item"><pre>{{ $scheduling->description }}</pre></li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                  <div class="card">
                                    <div class="card-body">
                                      <h5 class="card-title">{{ $doctor->name }}</h5>
                                      <p>Doutor</p>
                                      <p class="card-text">{{ $scheduling->doctor->cm }}</p>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-sm-6">
                                  <div class="card">
                                    <div class="card-body">
                                      <h5 class="card-title">{{$scheduling->patient->name }}</h5>
                                      <p>Paciente</p>
                                      <p class="card-text">{{ $scheduling->patient->sus_number }}</p>
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @if ($scheduling->status == "Completed")
      <div class="card w-100">
        <div class="card-header text-center d-flex align-items-center">
            <h2 class="mx-auto mb-0">Anamnese</h2>
        </div>        
        <div class="card-body">
            <div class="row">
                <div class="col-md">
                    <h5 class="mb-5">Informações da Anamnese</h5>
                    <ul class="list-group">
                        <h6>Queixa Principal</h6>
                        <li class="list-group-item mb-3"><pre>{{ $anamnese->chief_complaint }}</pre></li>
                        <h6>Histórico Médico</h6>
                        <li class="list-group-item mb-3"><pre>{{ $anamnese->medical_history }}</pre></li>
                        <h6>Histórico Familiar</h6>
                        <li class="list-group-item mb-3"><pre>{{ $anamnese->family_history }}</pre></li>
                        <h6>Hábitos de Vida</h6>
                        <li class="list-group-item mb-3"><pre>{{ $anamnese->lifestyle_habits }}</pre></li>
                        <h6>Sintomas</h6>
                        <li class="list-group-item mb-3"><pre>{{ $anamnese->symptoms }}</pre></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection
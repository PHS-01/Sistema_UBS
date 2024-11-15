@extends('layouts.app')

@section('title', 'Show')

@section('container')
    <div class="card w-100">
        <div class="card-header text-center d-flex align-items-center">
            <a href="{{ url('/dashboard') }}" class="btn btn-outline-primary me-auto">Voltar</a>
            <h2 class="mx-auto mb-0">Show</h2>
        </div>        
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center my-auto">
                    <h3>{{ $scheduling->status }}</h3>
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
                                      <p class="card-text">{{ $scheduling->doctor->cm }}</p>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-sm-6">
                                  <div class="card">
                                    <div class="card-body">
                                      <h5 class="card-title">{{$scheduling->patient->name }}</h5>
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
@endsection
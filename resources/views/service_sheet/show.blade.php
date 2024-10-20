@extends('layouts.form')

@section('title', 'Sheet')

@section('style')
    <style>
        #container_form { height: 100vh; }
    </style>
@endsection

@section('content_form')
    <div class="card w-100">
        <div class="card-header text-center">
            <h2>Ficha</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center my-auto">
                    <h1>{{ $service_sheet->number }}</h1>
                    <p>{{ $service_sheet->name }}</p>
                </div>
                <div class="col-md-8">
                    <h5>Service Sheet</h5>
                    <ul class="list-group">
                        @foreach ([
                            'Email' => $service_sheet->email, 
                            'Telefone' => $service_sheet->phone_number, 
                            'Cartão do SUS' => $service_sheet->sus_card, 
                            'Tempo limite' => $service_sheet->timeout 
                        ] as $label => $field)
                            <li class="list-group-item"><strong>{{ $label }}:</strong> {{ $field }}</li>
                        @endforeach
                    </ul>
                    @auth
                        <div class="d-flex mt-3">
                            <form action="{{ url('/sheet/'. $service_sheet->id ) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-lg ms-auto">Deletar Ficha</button>
                            </form>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
@endsection
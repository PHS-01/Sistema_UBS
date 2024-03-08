@extends('layouts.app')

@section('title')
    Pagina de Controler
@endsection

@section('navbar')
    
@endsection

@section('container')
    <div style="display: flex; flex-direction: row; width: 75vh;">
        <div>
            <h2>Usuarios/Pacientes</h2>
            <br>
            @foreach ($users as $item)
                <p><b>{{$item->name}}</b></p>
            @endforeach
        </div>
        <br>
        <div style="margin-right: 10%; margin-left: 10%;">
            <h2>Medicos</h2>
            <br>
            @foreach ($medicos as $item)
                <p><b>{{$item->name}}</b></p>
            @endforeach
        </div>
        <br>
        <div>
            <h2>Atendentes</h2>
            <br>
            @foreach ($atendentes as $item)
                <p><b>{{$item->name}}</b></p>
            @endforeach
        </div>
    </div>
@endsection
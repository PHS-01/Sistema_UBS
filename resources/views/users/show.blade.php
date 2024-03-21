@extends('layouts.app')

@section('title')
    Informação 
@endsection

@section('navbar')
    <a href="{{url('/dashboard')}}">Voltar</a>
@endsection

@section('container')
    <h2>Nome: {{$user->name}}</h2>
    <p><i>Email: {{$user->email}}</i></p>
    <br>
    <form action="{{url('/users/{user}', ['user' => $user])}}" method="POST">
        @method('DELETE')
        @csrf
        <button type="submit">Excluir conta</button>
    </form>
@endsection
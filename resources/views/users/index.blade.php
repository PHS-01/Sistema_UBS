@extends('layouts.app')

@section('title')
    Perfil 
@endsection

@section('navbar')
    <a href="{{url('/dashboard')}}">Voltar</a>
@endsection

@section('container')
    <h2>Nome: {{Auth::user()->name}}</h2>
    <p><i>Email: {{Auth::user()->email}}</i></p>
    <a href="{{url('/logout')}}"><b>Logout</b></a>
    <br>
    <br>
    <form action="{{url('/users/{user}', ['user' => Auth::user()])}}" method="POST">
        @method('DELETE')
        @csrf
        <button type="submit">Excluir conta</button>
    </form>
@endsection
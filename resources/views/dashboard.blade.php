@extends('layouts.app')

@section('title', 'Dasboard')

@section('container')
    <h1>Bem-vindo {{Auth::user()->name}}!</h1>
    <p class="lead">Seu tipo é {{Auth::user()->type}}!</p>
@endsection
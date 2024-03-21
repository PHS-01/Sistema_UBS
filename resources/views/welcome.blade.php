@extends('layouts.app')

@section('title')
    Welcome
@endsection

@section('navbar')
    @guest
        <a href="{{url('/register')}}">Entrar</a>
        <a href="{{url('/login')}}">Login</a>
    @endguest
    @auth
        <a href="{{url('/dashboard')}}">Dashboard</a>
    @endauth
@endsection

@section('container')
    
@endsection
@extends('layouts.form')

@section('title')
    Cadastro
@endsection

@section('url')action="{{url('/register')}}"@endsection

@section('form')
    <label for="nome">Nome</label>
    <input type="text" name="name" placeholder="Nome do Usuario" maxlength="100"  required>
    <label for="email">Email</label>
    <input type="email" name="email" placeholder="Email do Usuario" maxlength="100"  required>
    <label for="password">Senha</label>
    <input type="password" name="password" placeholder="Senha do Usuario" maxlength="50"  required>
    <br>
    <input type="submit" value="Cadastrar">
@endsection
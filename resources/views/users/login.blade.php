@extends('layouts.form')

@section('title')
    Login
@endsection

@section('url')action="{{url('/login')}}"@endsection

@section('form')
    <label for="email">Email</label>
    <input type="email" name="email" placeholder="Email do Usuario" maxlength="100"  required>
    <label for="password">Senha</label>
    <input type="password" name="password" placeholder="Senha do Usuario" maxlength="50"  required>
    <br>
    <select name="type" id="">
        <option value="user">User</option>
        <option value="medico">Medico</option>
        <option value="atendente">Atendente</option>
    </select>
    <br>
    <input type="submit" value="Logar">
@endsection
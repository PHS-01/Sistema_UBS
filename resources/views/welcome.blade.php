@extends('layouts.app')

@section('title', 'Bem-vindo')

@section('style')
    <style>
        .container{
            height: 50vh;
        }

        #div-infor{
            margin-top: 30vh;
        }
    </style>
@endsection

@section('container')
    <div id="div-infor">
        <h1>Bem-vindo ao Meu Projeto!</h1>
        <p class="lead">Esta é uma página de boas-vindas para o projeto Sistema da UBS.</p>
    </div>
@endsection
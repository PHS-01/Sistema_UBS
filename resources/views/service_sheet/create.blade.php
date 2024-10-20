@extends('layouts.form')

@section('title', 'Create Sheet')

@section('style')
    <style>
        #container_form { height: 100vh;}
    </style>
@endsection

@section('content_form')
    <div class="card text-center mx-auto" id="form_card" style="width: 50%;">
        <div class="card-body">
            <div id="Admin" class="form-section">
                <h2>Create de Sheet</h2>
                <form action="{{url('/sheet')}}" method="POST">
                    @csrf
                    @foreach(['name' => 'Nome', 'sus_card' => 'Cartão do SUS', 'email' => 'Email', 'phone_number' => 'Telefone'] as $field => $label)
                        <div class="mb-3">
                            <label for="register-{{ $field }}" class="form-label">{{ $label }}</label>
                            <input type="{{  $field == 'email' ? 'email' : ($field == 'password' ? 'password' : 'text') }}" name="{{ $field }}" class="form-control" id="register-{{ $field }}" placeholder="Digite o seu {{ strtolower($label) }}" required value="{{ old($field) }}">
                            @error($field)
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    @endforeach
                    <button type="submit" class="btn btn-primary">Entrar</button>
                </form>
            </div>  
        </div>
    </div>
@endsection
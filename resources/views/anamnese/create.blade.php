@extends('layouts.form')

@section('title', 'Criar Anamnese')

@section('style')
    <style>
        #container_form { height: 140vh; }
    </style>
@endsection

@section('content_form')
    <div class="card text-center mx-auto" style="width: 50%;">
        <div class="card-body">
            <h2>Criar Anamnese</h2>
            <form action="{{ url('/anamnese/create') }}" method="POST">
                @csrf
                <input type="hidden" name="schedulings_id" value="{{$id}}">
                <div class="mb-3">
                    <label for="chiefComplaint" class="form-label">Queixa Principal</label>
                    <textarea class="form-control" id="chiefComplaint" name="chief_complaint" rows="3" placeholder="Descreva a queixa principal" required></textarea>
                </div>
    
                <!-- Histórico Médico -->
                <div class="mb-3">
                    <label for="medicalHistory" class="form-label">Histórico Médico</label>
                    <textarea class="form-control" id="medicalHistory" name="medical_history" rows="3" placeholder="Informe o histórico médico do paciente"></textarea>
                </div>
    
                <!-- Histórico Familiar -->
                <div class="mb-3">
                    <label for="familyHistory" class="form-label">Histórico Familiar</label>
                    <textarea class="form-control" id="familyHistory" name="family_history" rows="3" placeholder="Informe o histórico familiar do paciente"></textarea>
                </div>
    
                <!-- Hábitos de Vida -->
                <div class="mb-3">
                    <label for="lifestyleHabits" class="form-label">Hábitos de Vida</label>
                    <textarea class="form-control" id="lifestyleHabits" name="lifestyle_habits" rows="3" placeholder="Descreva os hábitos de vida (ex.: dieta, sono, atividade física)"></textarea>
                </div>
    
                <!-- Sintomas -->
                <div class="mb-3">
                    <label for="symptoms" class="form-label">Sintomas</label>
                    <textarea class="form-control" id="symptoms" name="symptoms" rows="3" placeholder="Liste quaisquer sintomas relatados pelo paciente"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Criar</button>
            </form>
        </div>
    </div>
@endsection
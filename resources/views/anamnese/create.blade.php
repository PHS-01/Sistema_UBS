@extends('layouts.form')

@section('title', 'Create Anamnese')

@section('style')
    <style>
        #container_form { height: 140vh; }
    </style>
@endsection

@section('content_form')
    <div class="card text-center mx-auto" style="width: 50%;">
        <div class="card-body">
            <h2>Criando Anamnese referente a agendamento {{$id}}</h2>
            <form action="{{ url('/anamnese/create') }}" method="POST">
                @csrf
                <input type="hidden" name="schedulings_id" value="{{$id}}">
                <div class="mb-3">
                    <label for="chiefComplaint" class="form-label">Chief Complaint</label>
                    <textarea class="form-control" id="chiefComplaint" name="chief_complaint" rows="3" placeholder="Describe the chief complaint" required></textarea>
                </div>
    
                <!-- Medical History -->
                <div class="mb-3">
                    <label for="medicalHistory" class="form-label">Historico Medico</label>
                    <textarea class="form-control" id="medicalHistory" name="medical_history" rows="3" placeholder="Provide the patient's medical history"></textarea>
                </div>
    
                <!-- Family History -->
                <div class="mb-3">
                    <label for="familyHistory" class="form-label">Historico Familiar</label>
                    <textarea class="form-control" id="familyHistory" name="family_history" rows="3" placeholder="Provide the patient's family history"></textarea>
                </div>
    
                <!-- Lifestyle Habits -->
                <div class="mb-3">
                    <label for="lifestyleHabits" class="form-label">Lifestyle Habits</label>
                    <textarea class="form-control" id="lifestyleHabits" name="lifestyle_habits" rows="3" placeholder="Describe lifestyle habits (e.g., diet, sleep, physical activity)"></textarea>
                </div>
    
                <!-- Symptoms -->
                <div class="mb-3">
                    <label for="symptoms" class="form-label">Symptoms</label>
                    <textarea class="form-control" id="symptoms" name="symptoms" rows="3" placeholder="List any symptoms reported by the patient"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
@endsection
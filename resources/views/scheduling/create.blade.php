@extends('layouts.form')

@section('title', 'Create scheduling')

@section('style')
    <style>
        #container_form { height: 100vh; }

        .user-card { display: none; }

        .d-none { display: none !important; }

        .list-group-item {
            cursor: pointer;
            transition: background-color 0.2s ease-in-out;
        }

        .list-group-item:hover {
            background-color: #f0f0f0;
        }
    </style>
@endsection

@section('content_form')
    <div class="card w-75 mx-auto mt-5">
        <div class="card-header text-center">
            <h1>Cadastro de Agendamento</h1>
        </div>

        <div class="card-body">
            <form action="{{url('/scheduling') }}" method="POST">
                @csrf

                @foreach(['scheduled_at' => 'Data do Agendamento', 'description' => 'Observações'] as $field => $label)
                    <div class="mb-3">
                        <label for="{{ $field }}" class="form-label">{{ $label }}</label>
                        @if ($field != 'description')
                            <input 
                                type="{{ $field == 'scheduled_at' ? 'date' : 'text' }}" 
                                name="{{ $field }}" 
                                class="form-control" 
                                id="register-{{ $field }}" 
                                placeholder="Digite o seu {{ strtolower($label) }}" 
                                required 
                                value="{{ old($field) }}"
                            >
                        @else
                            <textarea 
                                class="form-control" 
                                id="{{ $field }}" 
                                name="{{ $field }}" 
                                rows="3" 
                                placeholder="Observações adicionais"
                            >{{ old($field) }}</textarea>
                        @endif
                        @error($field)
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                @endforeach

                <div class="row">
                    @foreach(['patient' => 'Paciente', 'doctor' => 'Doutor'] as $field => $label)
                        <div class="col-md-6 mb-3">
                            <label for="{{ $field }}" class="form-label">{{ $label }}</label>

                            <input type="hidden" id="{{ $field }}_id" name="{{ $field }}_id" value="{{ old($field.'_id') }}">

                            <div id="card-{{ $field }}" class="user-card card w-100">
                                <div class="card-body d-flex align-items-center">
                                    <div class="user-info">
                                        <h3 class="mb-1" id="{{ $field }}_name"></h3>
                                        <small class="text-muted">Selecionado</small>
                                    </div>
                                    <button type="button" class="btn-close ms-auto" 
                                        onclick="clearSelection('{{ $field }}')"></button>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center search-btn-container">
                                <button type="button" 
                                        class="btn btn-primary w-50" 
                                        onclick="openSearchModal('{{ $field }}')">
                                    Pesquisar {{ $label }}
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="d-flex justify-content-center mt-4">
                    <button type="submit" class="btn btn-primary w-50 btn-lg">
                        Criar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="searchModalLabel">Pesquisar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" id="searchInput" class="form-control mb-3" placeholder="Digite para pesquisar...">
                    <ul class="list-group" id="searchResults"></ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        let currentField = '';
        const patients = @json($patients);
        const doctors = @json($doctors);

        function openSearchModal(field) {
            currentField = field;
            document.getElementById('searchInput').value = '';
            document.getElementById('searchResults').innerHTML = '';
            new bootstrap.Modal(document.getElementById('searchModal')).show();
        }

        document.getElementById('searchInput').addEventListener('input', function () {
            const query = this.value.toLowerCase();
            const data = currentField === 'patient' ? patients : doctors;
            const results = data.filter(item => item.name.toLowerCase().includes(query));

            const resultList = document.getElementById('searchResults');
            resultList.innerHTML = '';

            results.forEach(item => {
                const li = document.createElement('li');
                li.className = 'list-group-item';
                li.textContent = item.name;
                li.onclick = () => selectSubject(item);
                resultList.appendChild(li);
            });
        });

        function selectSubject(subject) {
            document.getElementById(`${currentField}_id`).value = subject.id;
            document.getElementById(`${currentField}_name`).textContent = subject.name;

            document.getElementById(`card-${currentField}`).style.display = 'block';
            document.querySelector(`[onclick="openSearchModal('${currentField}')"]`)
                .closest('.search-btn-container').classList.add('d-none');

            const modal = bootstrap.Modal.getInstance(document.getElementById('searchModal'));
            if (modal) modal.hide();
        }

        function clearSelection(field) {
            document.getElementById(`${field}_id`).value = '';
            document.getElementById(`${field}_name`).textContent = '';

            document.getElementById(`card-${field}`).style.display = 'none';
            document.querySelector(`[onclick="openSearchModal('${field}')"]`)
                .closest('.search-btn-container').classList.remove('d-none');
        }
    </script>
@endsection
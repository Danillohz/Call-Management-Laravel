@extends('layouts.main')
@section('title', 'Página inicial')
@section('content')

    {{-- View responsável por visualizar as chamadas --}}
    @php
        use Carbon\Carbon;
    @endphp

    <div id="calls-container" class="mt-4">
        <div id="cards-container">
            <h2>Chamados</h2>
            @if ($calls->isEmpty())
                {{-- Mensagem exibida quando não há chamados registrados --}}
                <p class="text-center">Nenhum chamado registrado (;-;)</p>
            @else
                @foreach ($calls as $index => $call)
                    <div id="call-card" class="card mb-3">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="card-title-container">
                                            {{-- Exibe o título e a categoria do chamado --}}
                                            <h5>{{ $call->title }}</h5>
                                            <p>{{ $call->category ? $call->category->name : 'Não definida' }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto d-flex align-items-end">
                                    {{-- Define a cor de status do chamado --}}
                                    @php
                                        $colors = [
                                            'Resolvido' => 'background-color: #9feeb2;',
                                            'Pendente' => 'background-color: #ffff80;',
                                        ];
                                        $ballColor = $colors[$call->situation->name] ?? 'background-color: gray;';
                                    @endphp
                                    <div id="status-demonstration-ball" style="{{ $ballColor }}" class="me-2"></div>
                                    {{-- Mostra a situação do chamado --}}
                                    <p class="mb-0">Status: {{ $call->situation->name }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col mb-1">
                                    {{-- Formata as datas para o padrão brasileiro --}}
                                    @php
                                        $currentDate = $call->created_at
                                            ? Carbon::parse($call->created_at)->format('d/m/Y')
                                            : 'Data não definida';

                                        $futureDate = $call->deadline_date
                                            ? Carbon::parse($call->deadline_date)->format('d/m/Y')
                                            : 'Data não definida';
                                    @endphp
                                    {{-- Mostra a data de criação e de prazo do chamado --}}
                                    <p>Criação: {{ $currentDate }}</p>
                                    <p>Prazo: {{ $futureDate }}</p>

                                    {{-- Caso a situação do chamado seja resolvido, mostra a data de solução --}}
                                    @if ($call->situation_id == 3)
                                        @php
                                            $resolvedAt = $call->resolved_at
                                                ? Carbon::parse($call->resolved_at)->format('d/m/Y')
                                                : 'Data não definida';
                                        @endphp
                                        {{-- Mostra a data de solução do chamado --}}
                                        <p>Data de solução: {{ $resolvedAt }}</p>
                                    @endif
                                </div>
                                <div class="col-auto d-flex align-items-end">
                                    {{-- Botão responsável por deletar o chamado --}}
                                    <form action="/tickets/{{ $call->id }}" method="POST" onsubmit="return confirm('Tem certeza que deseja deletar este chamado?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger delete-btn">
                                            <span class="material-symbols-outlined">delete</span>
                                        </button>
                                    </form>
                                    {{-- Botão para abrir a descrição do chamado --}}
                                    <button type="button" class="btn btn-info ms-1" data-bs-toggle="modal"
                                        data-bs-target="#modal-{{ $index }}">
                                        <span class="material-symbols-outlined">description</span>
                                    </button>
                                    {{-- Formulário para atualizar a situação do chamado --}}
                                    <form action="{{ route('tickets.updateSituation', $call->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <select class="form-select ms-1" name="situation_id" onchange="return confirm('Tem certeza que deseja mudar a situação deste chamado?') ? this.form.submit() : false;">
                                            <option value="0"></option>
                                            <option value="2" {{ $call->situation_id == 2 ? 'selected' : '' }}>Pendente</option>
                                            <option value="3" {{ $call->situation_id == 3 ? 'selected' : '' }}>Resolvido</option>
                                        </select>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Modal da descrição dos chamados --}}
                    <div class="modal fade" id="modal-{{ $index }}" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="modalLabel-{{ $index }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="modalLabel-{{ $index }}">{{ $call->title }}</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    {{ $call->description }}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        {{-- Link para criar um novo chamado --}}
        <div id="link-create-container" class="mt-3">
            <a class="btn btn-dark" href="/tickets/create">
                Criar um novo chamado
            </a>
        </div>

    </div>

@endsection

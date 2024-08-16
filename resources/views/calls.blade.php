@extends('layouts.main')
@section('title', 'Página inicial')
@section('content')

    @php
        use Carbon\Carbon;
    @endphp

    <!-- View responsável por visualizar as chamadas -->
    <div id="calls-container" class="mt-4">
        <div id="cards-container">
            <h2>Chamados</h2>
            @foreach ($calls as $index => $call)
                <div id="call-card" class="card mb-3">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="card-title-container">
                                        <h5>{{ $call->title }}</h5>
                                        <p>{{ $call->category ? $call->category->name : 'Não definida' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto d-flex align-items-end">
                                <p>Status: {{ $call->situation->name }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <!-- Mostra a data de criação e do prazo do chamado -->
                                <p>Criação: {{ $call->current_date }}</p>
                                <p>Prazo: {{ $call->future_date }}</p>

                                <!-- caso a situacão do chamado seja igual a 3(resolvido) mostra a data que foi resolvido o chamado -->
                                @if ($call->situation_id == 3)
                                    <!-- Formata o valor recebido em resolved_at  -->
                                    @php
                                        $resolvedAt = $call->resolved_at
                                            ? Carbon::parse($call->resolved_at)->format('d/m/Y')
                                            : 'Data não definida';
                                    @endphp
                                    <p>Resolvido em: {{ $resolvedAt }}</p>
                                @endif
                            </div>
                            <div class="col-auto d-flex align-items-end">
                                <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                    data-bs-target="#modal-{{ $index }}">
                                    <span class="material-symbols-outlined">
                                        description
                                    </span>
                                </button>
                                <!-- Formulário para atualizar a situação -->
                                <form action="{{ route('tickets.updateSituation', $call->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <select class="form-select ms-1" name="situation_id" onchange="this.form.submit()">
                                        <option value="2" {{ $call->situation_id == 2 ? 'selected' : '' }}>Pendente
                                        </option>
                                        <option value="3" {{ $call->situation_id == 3 ? 'selected' : '' }}>Resolvido
                                        </option>
                                    </select>
                                </form>


                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal da descrição dos chamados -->
                <div class="modal fade" id="modal-{{ $index }}" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="modalLabel-{{ $index }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
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
        </div>

        <!-- Link para criar um novo chamado -->
        <div id="link-create-container">
            <a class="btn btn-dark" href="/tickets/create">Criar um novo chamado</a>
        </div>

    </div>

@endsection

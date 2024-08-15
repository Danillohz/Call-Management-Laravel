@extends('layouts.main')
@section('title', 'Página inicial')
@section('content')

<!-- View responsável por visualizar as chamadas -->
<div id="calls-container">
    <h2>Chamados</h2>
    <div id="cards-container">
        @foreach ($calls as $call)
            <div id="call-card" class="card">
                <h5 class="card-header">{{ $call->title }}</h5>
                <div class="card-body">
              
                </div>
          </div>
            
        @endforeach
    </div>

    <a href="/tickets/create">Criar um novo chamado</a>

</div>

@endsection

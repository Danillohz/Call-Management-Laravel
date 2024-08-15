@extends('layouts.main')

@section('title', 'Criar chamado')

@section('content')

<div id="tickets-create-container" class="col-md-6 offset-md-3">
    <h1>Crie seu chamado</h1>
    <form action="/tickets" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Título:</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Título do chamado">
        </div>
        <div class="form-group">
            <label for="title">Descrição:</label>
            <input type="text" class="form-control" id="description" name="description" placeholder="Descrição do chamado">
        </div>
        <input type="submit" class="btn btn-primary" value="Criar chamado">
        
    </form>
</div>

@endsection
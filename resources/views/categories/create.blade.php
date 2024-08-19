@extends('layouts.main')

@section('title', 'Criar chamado')

@section('content')

{{-- View responsável por criar as categorias --}}

<div class="mt-4 w-100">
    <div class="create-category-container m-auto">
        <h2>Crie uma nova categoria</h2>

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nome da categoria:</label>
            <input type="text" class="form-control" id="name" name="name" maxlength="100" required>
        </div>
        <button type="submit" class="btn btn-success mt-3">Adicionar Categoria</button>
    </form>
    </div>
</div>

@endsection
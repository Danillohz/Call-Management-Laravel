@extends('layouts.main')

@section('title', 'Criar chamado')

@section('content')

    <!-- View para cadastro de um novo chamado -->
    <div id="tickets-create-container" class="col-md-6 offset-md-3 mt-4">
        <h1>Crie seu chamado</h1>
        <form action="/tickets" method="POST">
            @csrf
            <!-- Input Titulo do chamado -->
            <div class="form-group mb-3">
                <label for="title">Título:</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Título do chamado" maxlength="100">
            </div>
            <!-- Campo para selecionar categoria -->
            <div class="form-floating mb-3">
                <select class="form-select" id="category_id" name="category_id" required>
                    <option value="" disabled selected>Selecione uma categoria</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <label for="category_id">Categoria</label>
            </div>
            <!-- Textarea para a descrição do chamado -->
            <div class="form-floating mb-3">
                <label for="title"></label>
                <textarea class="form-control" placeholder="Leave a comment here" maxlength="1000" id="description" name="description"></textarea>
                <label for="floatingTextarea">Descrição do chamado</label>
            </div>
            <input type="submit" class="btn btn-success" value="Criar chamado">

        </form>
    </div>

@endsection

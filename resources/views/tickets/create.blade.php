@extends('layouts.main')

@section('title', 'Criar chamado')

@section('content')

    {{-- View para cadastro de um novo chamado --}}
    <div class="w-100 mt-4">
        <div id="tickets-create-container">
            <h1>Crie seu chamado</h1>
            <form action="/tickets" method="POST">
                @csrf
                {{-- Input Título do chamado --}}
                <div class="form-group mb-3">
                    <label for="title">Título:</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Título do chamado"
                        maxlength="100">
                </div>
                {{-- Linha para a seleção de categoria e o botão de criar nova categoria --}}
                <div class="row mb-3">
                    <div class="col-12 col-md-10">
                        {{-- Campo para selecionar categoria --}}
                        <div class="form-floating w-100">
                            <select class="form-select" id="category_id" name="category_id" required>
                                <option value="" disabled selected>Selecione uma categoria</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="category_id">Categoria</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-2 d-flex flex-column flex-md-row justify-content-md-end align-items-md-center mt-3">
                        <a href="/categories" class="category-buttons btn btn-outline-danger mb-2 mb-md-0 me-md-2">
                            <span class="material-symbols-outlined">delete</span>
                        </a>
                        <a href="{{ route('categories.create') }}" id="category-button-create"
                            class="category-buttons btn btn-outline-dark">
                            <span class="material-symbols-outlined">add</span>
                        </a>
                    </div>
                </div>
                {{-- Textarea para a descrição do chamado --}}
                <div class="form-floating mb-3">
                    <textarea class="form-control" placeholder="Leave a comment here" maxlength="1000" id="description" name="description"></textarea>
                    <label for="description">Descrição do chamado</label>
                </div>
                <input type="submit" class="btn btn-success" value="Criar chamado">
            </form>
        </div>
    </div>

@endsection

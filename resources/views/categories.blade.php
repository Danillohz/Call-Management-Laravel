@extends('layouts.main')
@section('title', 'Categorias')
@section('content')
    
    {{-- View que cria as categorias com botões de delete --}}
    <div class="w-100  mt-4">
        <div id="categories-container" class="m-auto">
            <h1 class="text-center">Categorias</h1>
            @foreach ($categories as $category)
                <div class="categories-card mb-1 ">
                    <div class="d-flex justify-content-between">
                        <p class="text-wrap">{{ $category->name }}</p>
                        <div class="d-flex align-items-end">
                            <form action="/categories/{{ $category->id }}" method="POST"
                                onsubmit="return confirm('Tem certeza que deseja deletar este chamado?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger delete-btn">
                                    <span class="material-symbols-outlined">
                                        delete
                                    </span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection

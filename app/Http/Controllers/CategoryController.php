<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create(){
        return view('categories.create');
    }

    // Deleta a categoria com base no seu id
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect('/tickets/create')->with('msg', 'Categoria apagada com sucesso!');
    }

    public function index(){

        // Pega todos os chamados com suas categorias associadas
        $categories = Category::get();

        // Retorna a view com os dados dos chamados
        return view('categories', ['categories' => $categories]);

    }

    public function store(Request $request){

        $request->validate([
            'name' => 'required|string'
        ]);

        Category::create([
            'name' => $request->name
        ]);

        return redirect('/tickets/create')->with('error', 'Situação "novo" não encontrada. Por favor, adicione essa situação antes de criar um chamado.');
    }
}

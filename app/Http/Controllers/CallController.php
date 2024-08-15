<?php

namespace App\Http\Controllers;

use App\Models\Call;
use Illuminate\Http\Request;

class CallController extends Controller
{
    public function index(){


        $calls = Call::all();

        return view ('calls', ['calls' => $calls]);
     
    }

    public function create(){
        //retorna a view de criação de chamados
        return view('tickets.create');
    }

    public function store(Request $request){

        //Funcionalidade que cria no bd os dados do form 
        $call = new Call;

        $call->title = $request->title;
        $call->description = $request->description;

        //Persiste os dados 
        $call->save();

        //Após isso retorna para a lista de chamados e exibe uma mensagem
        return redirect('/calls')->with('msg', 'Chamado criado com sucesso!');

    }
}

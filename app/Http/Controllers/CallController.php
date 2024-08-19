<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Call;
use App\Models\Category;
use App\Models\Situation;
use Carbon\Carbon;

class CallController extends Controller
{
    //calcula o percentual de chamados terminados dentro do prazo
    public function percentual()
    {
        //Obter o início e fim do mês com carbon
        $currentMonthStart = Carbon::now()->startOfMonth();
        $currentMonthEnd = Carbon::now()->endOfMonth();

        //total de chamados
        $totalCalls = Call::whereBetween('created_at', [$currentMonthStart, $currentMonthEnd])->count();

        $resolvedCallsInTime = Call::whereBetween('created_at', [$currentMonthStart, $currentMonthEnd])
            ->whereNotNull('resolved_at')
            ->whereColumn('resolved_at', '<=', 'deadline_date')
            ->count();

        //Calcula o percentual
        $percentResolvedInTime = ($totalCalls > 0) ? ($resolvedCallsInTime / $totalCalls) * 100 : 0;
        
        return view('welcome', ['percentResolvedInTime' => $percentResolvedInTime]);
    }

    // Método para listar todos os chamados
    public function index()
    {

        // Pega todos os chamados com suas categorias associadas
        $calls = Call::with('category', 'situation')->get();

        // Retorna a view com os dados dos chamados
        return view('calls', ['calls' => $calls]);
    }

    // Método para mostrar o formulário de criação
    public function create()
    {
        
        $categories = Category::all();
        $situations = Situation::all();
        return view('tickets.create', ['categories' => $categories, 'situations' => $situations]);
    }

    //Método para atualizar o status do chamado
    public function updateSituation(Request $request, $id)
    {
        $request->validate([
            'situation_id' => 'required|exists:situations,id'
        ]);

        $call = Call::findOrFail($id);
        $call->situation_id = $request->situation_id;

        //Caso o chamado seja resolvido altera o valor de resolved_at para a data atual caso o chamado seja resolvido
        if ($request->input('situation_id') == 3) {
            $call->resolved_at = Carbon::now();
        } else {
            $call->resolved_at = null;
        }

        $call->save();

        return redirect()->back()->with('msg', 'Situação atualizada com sucesso!');
    }

    //Método para excluir um chamado pelo seu id
    public function destroy($id)
    {
            
        Call::findOrFail($id)->delete();
    
        return redirect('/calls');
    }

    // Método para armazenar um novo chamado
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',

        ]);

        $callData = $request->all();
        // Definir a situação como 'novo'
        if (!$request->has('situation_id')) {
            $newSituation = Situation::where('name', 'novo')->first();
            if ($newSituation) {
                $callData['situation_id'] = $newSituation->id;
            } else {
                return redirect('/tickets/create')->with('error', 'Situação "novo" não encontrada. Por favor, adicione essa situação antes de criar um chamado.');
            }
        }

        Call::create($callData);

        return redirect('/calls')->with('msg', 'Chamado criado com sucesso!');
    }
}

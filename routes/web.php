<?php

use App\Http\Controllers\CallController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Welcome');
});

Route::get('/calls', [CallController::class, 'index']);
Route::get('/tickets/create', [CallController::class, 'create']);

//rota necessaria para o funcionamento da logica da aplicação
Route::post('tickets', [CallController::class, 'store']);





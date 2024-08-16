<?php

use App\Http\Controllers\CallController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CallController::class, 'percentual']);

Route::get('/calls', [CallController::class, 'index']);
Route::get('/tickets/create', [CallController::class, 'create']);
Route::put('/tickets/{id}/update-situation', [CallController::class, 'updateSituation'])->name('tickets.updateSituation');
Route::delete('/tickets/{id}', [CallController::class, 'destroy'] );

//rota necessaria para o funcionamento da logica da aplicação
Route::post('tickets', [CallController::class, 'store']);





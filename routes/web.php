<?php

use App\Http\Controllers\CallController;
use App\Http\Controllers\CategoryControll;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CallController::class, 'percentual']);

Route::get('/calls', [CallController::class, 'index']);
Route::get('/tickets/create', [CallController::class, 'create']);
Route::put('/tickets/{id}/update-situation', [CallController::class, 'updateSituation'])->name('tickets.updateSituation');
Route::post('tickets', [CallController::class, 'store']);
Route::delete('/tickets/{id}', [CallController::class, 'destroy'])->name('tickets.destroy');

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');








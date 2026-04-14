<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LancamentoController;

// rota inicial (login)
Route::get('/', [AuthController::class, 'loginForm']);

// ação de login
Route::post('/login', [AuthController::class, 'login']);

// logout
Route::get('/logout', [AuthController::class, 'logout']);

// listagem protegida
Route::get('/lancamentos', [LancamentoController::class, 'index']);
Route::resource('lancamentos', LancamentoController::class);

// Export para PDF
Route::get('/lancamentos/pdf', [LancamentoController::class, 'exportPdf']);
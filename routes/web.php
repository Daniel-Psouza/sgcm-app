<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\EspecialidadeController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\AgendamentoController;

Route::get('/', function () {
    return Inertia::render('PgEntrada');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('especialidades', EspecialidadeController::class)->except(['create', 'edit', 'show', 'update']);
    Route::resource('medicos', MedicoController::class)->except(['create', 'edit', 'show', 'update']);
    Route::get('/medicos/disponiveis', [MedicoController::class, 'disponiveis'])->name('medicos.disponiveis');

    Route::resource('agendamentos', AgendamentoController::class)->only(['index', 'store']);
    Route::get('/agendamentos/lista', [AgendamentoController::class, 'lista'])->name('agendamentos.lista');
});

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';

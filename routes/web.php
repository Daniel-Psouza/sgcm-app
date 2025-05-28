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
    Route::get('/especialidades', [EspecialidadeController::class, 'index'])->name('especialidades.index');
    Route::post('/especialidades', [EspecialidadeController::class, 'store'])->name('especialidades.store');
    Route::delete('/especialidades/{id}', [EspecialidadeController::class, 'destroy'])->name('especialidades.destroy');

    Route::get('/medicos', [MedicoController::class, 'index'])->name('medicos.index');
    Route::post('/medicos', [MedicoController::class, 'store'])->name('medicos.store');
    Route::delete('/medicos/{id}', [MedicoController::class, 'destroy'])->name('medicos.destroy');
    Route::get('/medicos/disponiveis', [MedicoController::class, 'disponiveis'])->name('medicos.disponiveis');

    Route::post('/agendamentos', [AgendamentoController::class, 'store'])->name('agendamentos.store');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';

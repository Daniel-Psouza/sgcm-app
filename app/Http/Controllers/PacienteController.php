<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class PacienteController extends Controller
{
    public function index()
    {
        $pacientes = DB::table('pacientes')->get();
        return Inertia::render('Pacientes', [
            'pacientes' => $pacientes
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'data_nascimento' => 'required|date',
            'cpf' => 'required|string|max:14|unique:pacientes,cpf',
            'telefone' => 'nullable|string|max:20',
        ]);
        \DB::table('pacientes')->insert([
            'nome' => $request->nome,
            'data_nascimento' => $request->data_nascimento,
            'cpf' => $request->cpf,
            'telefone' => $request->telefone,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return redirect()->route('pacientes.index');
    }

    public function destroy($id)
    {
        \DB::table('pacientes')->where('id', $id)->delete();
        return redirect()->route('pacientes.index');
    }
}

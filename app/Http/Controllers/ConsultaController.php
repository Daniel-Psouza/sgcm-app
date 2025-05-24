<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class ConsultaController extends Controller
{
    public function index()
    {
        $consultas = DB::table('consultas')
            ->join('pacientes', 'consultas.paciente_id', '=', 'pacientes.id')
            ->join('medicos', 'consultas.medico_id', '=', 'medicos.id')
            ->select('consultas.*', 'pacientes.nome as paciente_nome', 'medicos.nome as medico_nome')
            ->get();
        return Inertia::render('Consultas', [
            'consultas' => $consultas
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'medico_id' => 'required|exists:medicos,id',
            'data_hora' => 'required|date',
            'observacoes' => 'nullable|string',
        ]);
        \DB::table('consultas')->insert([
            'paciente_id' => $request->paciente_id,
            'medico_id' => $request->medico_id,
            'data_hora' => $request->data_hora,
            'observacoes' => $request->observacoes,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return redirect()->route('consultas.index');
    }

    public function destroy($id)
    {
        \DB::table('consultas')->where('id', $id)->delete();
        return redirect()->route('consultas.index');
    }
}

<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AgendamentoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'medico_id' => 'required|exists:medicos,id',
            'especialidade_id' => 'required|exists:especialidades,id',
            'data' => 'required|date',
            'hora' => 'required',
            'observacao' => 'nullable|string',
        ]);

        $dataHora = $request->data . ' ' . $request->hora;

        $existe = DB::table('agendamentos')
            ->where('medico_id', $request->medico_id)
            ->where('especialidade_id', $request->especialidade_id)
            ->where('data_hora', $dataHora)
            ->exists();

        if ($existe) {
            return response()->json(['error' => 'Já existe um agendamento para este médico, especialidade, data e hora.'], 422);
        }

        try {
            DB::table('agendamentos')->insert([
                'medico_id' => $request->medico_id,
                'especialidade_id' => $request->especialidade_id,
                'data_hora' => $dataHora,
                'observacao' => $request->observacao,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() === '23000') { // Violação de constraint única
                return response()->json(['error' => 'Já existe um agendamento para este médico, especialidade, data e hora.'], 422);
            }
            throw $e;
        }

        return response()->json(['success' => true]);
    }
}

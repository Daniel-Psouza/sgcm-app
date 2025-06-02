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
            return response()->modal(['error' => 'Já existe um agendamento para este médico, especialidade, data e hora.']);
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
                return response()->modal(['error' => 'Já existe um agendamento para este médico, especialidade, data e hora.']);
            }
            throw $e;
        }
    }

    public function index()
    {
        $agendamentos = \DB::table('agendamentos')
            ->join('medicos', 'agendamentos.medico_id', '=', 'medicos.id')
            ->join('especialidades', 'agendamentos.especialidade_id', '=', 'especialidades.id')
            ->select(
                'agendamentos.id',
                'agendamentos.data_hora',
                'medicos.nome as medico_nome',
                'especialidades.nome as especialidade_nome'
            )
            ->get()
            ->map(function ($ag) {
                $dataHora = explode(' ', $ag->data_hora);
                $ag->data = $dataHora[0] ?? '';
                $ag->hora = $dataHora[1] ?? '';
                return $ag;
            });
    }

    public function show($id)
    {
        $agendamento = \DB::table('agendamentos')
            ->where('agendamentos.id', $id)
            ->join('medicos', 'agendamentos.medico_id', '=', 'medicos.id')
            ->join('especialidades', 'agendamentos.especialidade_id', '=', 'especialidades.id')
            ->select(
                'agendamentos.id',
                'agendamentos.data_hora',
                'medicos.nome as medico_nome',
                'especialidades.nome as especialidade_nome'
            )
            ->first();
        if (!$agendamento) {
        }
        $dataHora = explode(' ', $agendamento->data_hora);
        $agendamento->data = $dataHora[0] ?? '';
        $agendamento->hora = $dataHora[1] ?? '';
        return response()->modal($agendamento);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'medico_id' => 'required|exists:medicos,id',
            'especialidade_id' => 'required|exists:especialidades,id',
            'data' => 'required|date',
            'hora' => 'required',
            'observacao' => 'nullable|string',
        ]);
        $dataHora = $request->data . ' ' . $request->hora;
        $agendamento = \DB::table('agendamentos')->where('id', $id)->first();
        if (!$agendamento) {
            return response()->json(['error' => 'Agendamento não encontrado'], 404);
        }
        \DB::table('agendamentos')->where('id', $id)->update([
            'medico_id' => $request->medico_id,
            'especialidade_id' => $request->especialidade_id,
            'data_hora' => $dataHora,
            'observacao' => $request->observacao,
            'updated_at' => now(),
        ]);
        return response('', 204);
    }

    public function destroy($id)
    {
        $agendamento = \DB::table('agendamentos')->where('id', $id)->first();
        if (!$agendamento) {
            return response()->json(['error' => 'Agendamento não encontrado'], 404);
        }
        \DB::table('agendamentos')->where('id', $id)->delete();
        return response('', 204);
    }

    public function lista()
    {
        $agendamentos = \DB::table('agendamentos')
            ->join('medicos', 'agendamentos.medico_id', '=', 'medicos.id')
            ->join('especialidades', 'agendamentos.especialidade_id', '=', 'especialidades.id')
            ->select(
                'agendamentos.id',
                'agendamentos.data_hora',
                'medicos.nome as medico_nome',
                'especialidades.nome as especialidade_nome'
            )
            ->get()
            ->map(function ($ag) {
                $dataHora = explode(' ', $ag->data_hora);
                $ag->data = $dataHora[0] ?? '';
                $ag->hora = $dataHora[1] ?? '';
                return $ag;
            });
        return inertia('Agendamentos', ['agendamentos' => $agendamentos]);
    }
}

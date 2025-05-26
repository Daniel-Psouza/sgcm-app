<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class MedicoController extends Controller
{
    public function index()
    {
        $medicos = DB::table('medicos')->get();
        return response()->json($medicos);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'crm' => 'required|string|max:20|unique:medicos,crm',
            'especialidade_id' => 'required|exists:especialidades,id',
        ]);
        \DB::table('medicos')->insert([
            'nome' => $request->nome,
            'crm' => $request->crm,
            'especialidade_id' => $request->especialidade_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return redirect()->route('medicos.index');
    }

    public function destroy($id)
    {
        \DB::table('medicos')->where('id', $id)->delete();
        return redirect()->route('medicos.index');
    }

    public function disponiveis(Request $request)
    {
        $request->validate([
            'especialidade_id' => 'required|exists:especialidades,id',
            'data' => 'required|date',
            'hora' => 'required',
        ]);
        $dataHora = $request->data . ' ' . $request->hora;
        // Se não houver data e hora, retorna todos os médicos da especialidade
        if (empty($request->data) || empty($request->hora)) {
            $medicos = DB::table('medicos')
                ->join('medico_especialidade', 'medicos.id', '=', 'medico_especialidade.medico_id')
                ->where('medico_especialidade.especialidade_id', $request->especialidade_id)
                ->select('medicos.id', 'medicos.nome')
                ->get();
            return response()->json($medicos);
        }
        // Se houver data e hora, filtra os ocupados
        $ocupados = DB::table('agendamentos')
            ->where('data_hora', $dataHora)
            ->pluck('medico_id');
        $medicos = DB::table('medicos')
            ->join('medico_especialidade', 'medicos.id', '=', 'medico_especialidade.medico_id')
            ->where('medico_especialidade.especialidade_id', $request->especialidade_id)
            ->whereNotIn('medicos.id', $ocupados)
            ->select('medicos.id', 'medicos.nome')
            ->get();
        return response()->json($medicos);
    }

    public function porEspecialidade($especialidade_id)
    {
        $medicos = \DB::table('medicos')
            ->where('especialidade_id', $especialidade_id)
            ->select('id', 'nome')
            ->get();
        return response()->json($medicos);
    }
}

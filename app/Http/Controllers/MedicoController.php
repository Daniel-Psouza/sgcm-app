<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class MedicoController extends Controller
{
    public function index()
    {
        $medicos = DB::table('medicos')
            ->join('especialidades', 'medicos.especialidade_id', '=', 'especialidades.id')
            ->select('medicos.*', 'especialidades.nome as especialidade_nome')
            ->get();
        return Inertia::render('Medicos', [
            'medicos' => $medicos
        ]);
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
}

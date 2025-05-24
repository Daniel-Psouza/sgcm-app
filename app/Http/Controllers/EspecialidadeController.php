<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class EspecialidadeController extends Controller
{
    public function index()
    {
        $especialidades = DB::table('especialidades')->get();
        return Inertia::render('Especialidades', [
            'especialidades' => $especialidades
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(['nome' => 'required|string|max:255']);
        \DB::table('especialidades')->insert([
            'nome' => $request->nome,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return redirect()->route('especialidades.index');
    }

    public function destroy($id)
    {
        \DB::table('especialidades')->where('id', $id)->delete();
        return redirect()->route('especialidades.index');
    }
}

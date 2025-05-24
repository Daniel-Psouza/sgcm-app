<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConsultaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('consultas')->insert([
            [
                'paciente_id' => 1,
                'medico_id' => 1,
                'data_hora' => now()->addDays(1),
                'observacoes' => 'Primeira consulta de rotina.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'paciente_id' => 2,
                'medico_id' => 2,
                'data_hora' => now()->addDays(2),
                'observacoes' => 'Consulta de retorno.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

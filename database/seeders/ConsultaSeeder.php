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
                'medico_id' => 1,
                'data_hora' => now()->addDays(1)->setTime(8, 0),
                'observacoes' => 'Primeira consulta de rotina.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'medico_id' => 2,
                'data_hora' => now()->addDays(2)->setTime(10, 0),
                'observacoes' => 'Consulta de retorno.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'medico_id' => 3,
                'data_hora' => now()->addDays(3)->setTime(10, 30),
                'observacoes' => 'Consulta de especialidade.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'medico_id' => 4,
                'data_hora' => now()->addDays(4)->setTime(11, 0),
                'observacoes' => 'Consulta de avaliação.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'medico_id' => 5,
                'data_hora' => now()->addDays(5)->setTime(13, 0),
                'observacoes' => 'Consulta de acompanhamento.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

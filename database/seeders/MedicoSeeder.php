<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MedicoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('medicos')->insert([
            [
                'nome' => 'Dr. João Silva',
                'crm' => '123456',
                'especialidade_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Dra. Maria Oliveira',
                'crm' => '654321',
                'especialidade_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

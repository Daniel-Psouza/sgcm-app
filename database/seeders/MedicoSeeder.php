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
            [
                'nome' => 'Dr. Carlos Souza',
                'crm' => '111222',
                'especialidade_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Dra. Ana Paula',
                'crm' => '333444',
                'especialidade_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Dr. Pedro Lima',
                'crm' => '555666',
                'especialidade_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Dra. Fernanda Costa',
                'crm' => '777888',
                'especialidade_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Dr. Lucas Almeida',
                'crm' => '999000',
                'especialidade_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Dra. Juliana Rocha',
                'crm' => '222333',
                'especialidade_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Dr. Rafael Martins',
                'crm' => '444555',
                'especialidade_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Dra. Beatriz Santos',
                'crm' => '666777',
                'especialidade_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

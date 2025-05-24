<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PacienteSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pacientes')->insert([
            [
                'nome' => 'Carlos Souza',
                'data_nascimento' => '1980-05-10',
                'cpf' => '11122233344',
                'telefone' => '11999998888',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Ana Paula',
                'data_nascimento' => '1992-11-23',
                'cpf' => '55566677788',
                'telefone' => '11988887777',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

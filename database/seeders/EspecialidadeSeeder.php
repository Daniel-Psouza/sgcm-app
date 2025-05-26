<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EspecialidadeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('especialidades')->insert([
            ['nome' => 'Cardiologia'],
            ['nome' => 'Dermatologia'],
            ['nome' => 'Pediatria'],
            ['nome' => 'Ortopedia'],
            ['nome' => 'Ginecologia'],
            ['nome' => 'Oftalmologia'],
            ['nome' => 'Psiquiatria'],
            ['nome' => 'Neurologia'],
            ['nome' => 'Endocrinologia'],
            ['nome' => 'Gastroenterologia'],
            ['nome' => 'Urologia'],
            ['nome' => 'Reumatologia'],
            ['nome' => 'Infectologia'],
            ['nome' => 'Hematologia'],
            ['nome' => 'Nefrologia'],
            ['nome' => 'Oncologia'],
            ['nome' => 'Pneumologia'],
            ['nome' => 'Otorrinolaringologia'],
            ['nome' => 'Cirurgia Geral'],
            ['nome' => 'Cirurgia Plástica'],
        ]);
    }
}

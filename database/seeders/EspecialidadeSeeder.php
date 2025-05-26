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
        ]);
    }
}

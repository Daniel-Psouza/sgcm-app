<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MedicoSeeder extends Seeder
{
    public function run(): void
    {
        $medicos = [
            [ 'nome' => 'Dr. João Silva', 'crm' => '123456' ],
            [ 'nome' => 'Dra. Maria Oliveira', 'crm' => '654321' ],
            [ 'nome' => 'Dr. Carlos Souza', 'crm' => '111222' ],
            [ 'nome' => 'Dra. Ana Paula', 'crm' => '333444' ],
            [ 'nome' => 'Dr. Pedro Lima', 'crm' => '555666' ],
        ];
        DB::table('medicos')->insert($medicos);
        // Relaciona especialidades (cada médico pode ter mais de uma)
        $especialidades = [1,2,3,4,5];
        $relacoes = [
            [1, [1,2]], // João: Cardiologia, Dermatologia
            [2, [2,3]], // Maria: Dermatologia, Pediatria
            [3, [3,4]], // Carlos: Pediatria, Ortopedia
            [4, [4,5]], // Ana: Ortopedia, Ginecologia
            [5, [1,5]], // Pedro: Cardiologia, Ginecologia
        ];
        foreach ($relacoes as [$medico, $esps]) {
            foreach ($esps as $esp) {
                DB::table('medico_especialidade')->insert([
                    'medico_id' => $medico,
                    'especialidade_id' => $esp
                ]);
            }
        }
    }
}

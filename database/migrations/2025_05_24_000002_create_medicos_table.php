<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('medicos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('crm')->unique();
            $table->timestamps();
        });
        // Tabela pivô medico_especialidade
        Schema::create('medico_especialidade', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medico_id')->constrained('medicos')->onDelete('cascade');
            $table->foreignId('especialidade_id')->constrained('especialidades')->onDelete('cascade');
            $table->unique(['medico_id', 'especialidade_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('medico_especialidade');
        Schema::dropIfExists('medicos');
    }
};

<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('agendamentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medico_id')->constrained('medicos');
            $table->foreignId('especialidade_id')->constrained('especialidades');
            $table->dateTime('data_hora');
            $table->text('observacao')->nullable();
            $table->timestamps();
            $table->unique(['medico_id', 'especialidade_id', 'data_hora']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('agendamentos');
    }
};

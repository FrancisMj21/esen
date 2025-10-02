<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('cursos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 120);
            $table->tinyInteger('ciclo');
            $table->smallInteger('horas_t');
            $table->smallInteger('horas_p');
            $table->tinyInteger('n_grupos');
            $table->foreignId('t_practica_id')->constrained('t_practicas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cursos');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('tipo_practicas')) {
            Schema::create('tipo_practicas', function (Blueprint $table) {
                $table->id();
                $table->string('slug')->unique();  // clinica, laboratorio, gabinete, campo, aula
                $table->string('nombre');
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('curso_tipo_practica')) {
            Schema::create('curso_tipo_practica', function (Blueprint $table) {
                $table->id();
                $table->foreignId('curso_id')->constrained('cursos')->cascadeOnDelete();
                $table->foreignId('tipo_practica_id')->constrained('tipo_practicas')->cascadeOnDelete();
                $table->unique(['curso_id', 'tipo_practica_id']);
            });
        }
    }
    public function down(): void
    {
        Schema::dropIfExists('curso_tipo_practica');
        Schema::dropIfExists('tipo_practicas');
    }
};
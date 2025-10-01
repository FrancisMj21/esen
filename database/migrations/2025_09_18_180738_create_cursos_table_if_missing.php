<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('cursos')) {
            Schema::create('cursos', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('nombre', 120);
                $table->tinyInteger('ciclo')->unsigned();
                $table->smallInteger('horas_t')->unsigned();
                $table->smallInteger('horas_p')->unsigned();
                $table->smallInteger('n_estudiantes')->unsigned()->default(0);
                $table->tinyInteger('n_grupos')->unsigned()->default(1);
                $table->timestamps(); // created_at / updated_at
            });
        }
    }
    public function down(): void
    {
        // No hacemos drop para no borrar datos por accidente
    }
};
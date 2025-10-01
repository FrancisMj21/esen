<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('cursos', function (Blueprint $table) {
            if (!Schema::hasColumn('cursos', 'turno')) {
                $table->enum('turno', ['M', 'T', 'M/T'])->after('ciclo');
            }
            if (!Schema::hasColumn('cursos', 'seccion')) {
                $table->enum('seccion', ['A', 'B'])->after('turno');
            }
            if (!Schema::hasColumn('cursos', 'periodo_semestral')) {
                $table->enum('periodo_semestral', ['I-S', 'II-S'])->after('seccion');
            }
        });
    }
    public function down(): void
    {
        Schema::table('cursos', function (Blueprint $table) {
            $table->dropColumn(['turno', 'seccion', 'periodo_semestral']);
        });
    }
};
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carga extends Model
{
    protected $table = 'cargas';

    protected $fillable = [
        'docente_id',
        'curso_id',
        'grupos_asignados',
        'horas_t_carga',
        'horas_p_carga',
        'total_horas',
        'observaciones',
    ];

    protected $casts = [
        'docente_id' => 'integer',
        'curso_id' => 'integer',
        'grupos_asignados' => 'integer',
        'horas_t_carga' => 'integer',
        'horas_p_carga' => 'integer',
        'total_horas' => 'integer',
    ];

    public function docente()
    {
        return $this->belongsTo(Docente::class);
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }
}
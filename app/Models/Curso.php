<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'ciclo', 'horas_t', 'horas_p', 'n_estudiantes', 'n_grupos', 't_practica_id'];
    public function cargas()
    {
        return $this->hasMany(Carga::class);
    }

    public function practica()
    {
        return $this->belongsTo(TPractica::class, 't_practica_id');
    }
}


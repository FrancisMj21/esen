<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tpractica extends Model
{
    use HasFactory;

    protected $table = 't_practica';
    protected $fillable = ['nombre'];

    public function cursos()
    {
        return $this->hasMany(Curso::class, 't_practica_id');
    }
}

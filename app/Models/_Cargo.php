<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class _Cargo extends Model
{
    use HasFactory;

    protected $table = 'cargo';
    protected $fillable = ['nombre'];

    public function docentes()
    {
        return $this->hasMany(Docente::class, '_cargo_id');
    }
}

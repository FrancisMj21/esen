<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Docente extends Model
{
    use HasFactory;

    protected $table = 'docentes';
    protected $fillable = [
        '_cargo_id',
        'categoria_id',
        'cargo_id',
        'user_id',
        'nombres',
        'apellidos',
        'dni',
        'celular',
        'fecha_nacimiento'
    ];

    // relaciones
    public function cargo()
    {
        return $this->belongsTo(Cargo::class, 'cargo_id');
    }

    public function _cargo()
    {
        return $this->belongsTo(_Cargo::class, '_cargo_id');
    }
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

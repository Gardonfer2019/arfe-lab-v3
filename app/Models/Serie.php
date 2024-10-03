<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Serie extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',        // Campo nombre
        'descripcion',   // Campo descripción
    ];

    // Relación muchos a muchos con Examen
    public function examenes()
    {
        return $this->belongsToMany(Examen::class, 'examen_serie');
    }

    // Relación uno a muchos con Componentes
    public function componentes()
    {
        return $this->hasMany(Componente::class);
    }
}

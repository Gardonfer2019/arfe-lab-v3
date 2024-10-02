<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ComponenteExamen extends Model
{
    use HasFactory;
    // Especifica la tabla si es necesario
    protected $table = 'componentes_examen';

    protected $fillable = [
        'examen_id',
        'nombre_componente',
        'abreviatura',
        'unidad',
        'valor_referencia_min',
        'valor_referencia_max',
    ];

    // Relación con el modelo Examen
    public function examen()
    {
        return $this->belongsTo(Examen::class, 'examen_id');
    }
}

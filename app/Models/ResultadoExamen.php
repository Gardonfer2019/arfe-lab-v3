<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ResultadoExamen extends Model
{
    use HasFactory;

    protected $table = 'resultados_examen';

    protected $fillable = ['paciente_id', 'componente_id', 'solicitud_id', 'resultado', 'fecha_examen'];

    // Relación con el paciente
    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    // Relación con el componente del examen
    public function componente()
    {
        return $this->belongsTo(ComponenteExamen::class, 'componente_id');
    }
    // Relación con la solicitud de examen
    public function solicitud()
    {
        return $this->belongsTo(SolicitudExamen::class, 'solicitud_id');
    }
}

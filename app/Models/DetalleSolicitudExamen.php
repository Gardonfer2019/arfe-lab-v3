<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetalleSolicitudExamen extends Model
{
    use HasFactory;

    protected $table = 'detalle_solicitudes_examenes';

    protected $fillable = ['solicitud_id', 'examen_id'];

    // Relación con solicitud
    public function solicitud()
    {
        return $this->belongsTo(SolicitudExamen::class, 'solicitud_id');
    }

    // Relación con examen
    public function examen()
    {
        return $this->belongsTo(Examen::class, 'examen_id');
    }
}

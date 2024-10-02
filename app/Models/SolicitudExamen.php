<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SolicitudExamen extends Model
{
    use HasFactory;

    protected $table = 'solicitudes_examenes';

    protected $fillable = ['paciente_id', 'usuario_id', 'fecha_solicitud', 'estado'];

    // Especificar que fecha_solicitud es un atributo de tipo fecha
    protected $casts = [
        'fecha_solicitud' => 'datetime', // Esto asegurará que sea tratado como un objeto Carbon
    ];

      // Relación con paciente
    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

      // Relación con detalle de solicitudes de exámenes
    public function detalles()
    {
        return $this->hasMany(DetalleSolicitudExamen::class, 'solicitud_id');
    }

       // Relación con Usuario
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id'); // Relación con la columna 'usuario_id'
    }
    // Relación con los resultados de exámenes
    public function resultados()
    {
        return $this->hasMany(ResultadoExamen::class, 'solicitud_id'); // Relación con la tabla 'resultados_examen'
    }

    // Hook que se ejecuta después de guardar la solicitud
    protected static function booted()
    {
        static::saved(function ($solicitudExamen) {
            foreach ($solicitudExamen->detalles as $detalle) {
                $componentes = $detalle->examen->componentes;
    
                foreach ($componentes as $componente) {
                    // Verificar si ya existe un resultado para este componente
                    $existe = ResultadoExamen::where('paciente_id', $solicitudExamen->paciente_id)
                        ->where('componente_id', $componente->id)
                        ->where('solicitud_id', $solicitudExamen->id)
                        ->exists();
    
                    // Si no existe, creamos el registro
                    if (!$existe) {
                        ResultadoExamen::create([
                            'paciente_id' => $solicitudExamen->paciente_id,
                            'componente_id' => $componente->id,
                            'solicitud_id' => $solicitudExamen->id,
                            'resultado' => null,
                            'fecha_examen' => now(),
                        ]);
                    }
                }
            }
        });
    }

    /*public function actualizarEstado()
    {
        // Verificar si todos los resultados están completos
        $resultadosPendientes = $this->resultados()->whereNull('resultado')->count();

        if ($resultadosPendientes == 0) {
            // Si no hay resultados pendientes, actualizar el estado a 'Completada'
            $this->estado = 'Completada';
        } else {
            // Si hay resultados pendientes, actualizar el estado a 'En proceso'
            $this->estado = 'En proceso';
        }

        // Guardar el nuevo estado
        $this->save();
    }*/

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Examen extends Model
{
    use HasFactory, SoftDeletes;

    // Especifica el nombre de la tabla
    protected $table = 'examenes';

    protected $fillable = ['nombre_examen', 'descripcion', 'monto_default'];

    // Relación con los componentes del examen
    public function componentes()
    {
        return $this->hasMany(ComponenteExamen::class, 'examen_id');
    }

    public function detalleFacturas()
    {
        return $this->hasMany(DetalleFactura::class);
    }

    public function detalleSolicitudesExamen()
    {
        return $this->hasMany(DetalleSolicitudExamen::class);
    }
}

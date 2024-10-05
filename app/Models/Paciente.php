<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Paciente extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['nombre', 'apellido', 'fecha_nacimiento', 'genero', 'telefono', 'direccion', 'email', 'identidad'];

    public function resultadosExamen()
    {
        return $this->hasMany(ResultadoExamen::class);
    }

    public function facturas()
    {
        return $this->hasMany(Factura::class);
    }

    public function solicitudesExamen()
    {
        return $this->hasMany(SolicitudExamen::class);
        
    }

    // Accesor para obtener el nombre completo
    public function getNombreCompletoAttribute()
    {
        return "{$this->nombre} {$this->apellido}";
    }
}

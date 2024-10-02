<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SolicitudExamen;

class CambiarEstadoSolicitud extends Component
{
    public $solicitud; // La solicitud actual
    public $estado; // El estado de la solicitud

    // Este método se ejecuta cuando el componente se inicializa
    public function mount(SolicitudExamen $solicitud)
    {
        $this->solicitud = $solicitud;
        $this->estado = $solicitud->estado; // Inicializar con el estado actual de la solicitud desde la base de datos
    }

    public function actualizarEstado()
    {
        dd($this->estado);  // Agrega depuración para ver si se ejecuta la función

        $this->validate([
            'estado' => 'required|in:pendiente,completado,cancelado',
        ]);
    
        // Lógica para guardar el nuevo estado
        $this->solicitud->update(['estado' => $this->estado]);
    
        session()->flash('message', 'El estado ha sido actualizado.');
    }


    public function render()
    {
        return view('livewire.cambiar-estado-solicitud');
    }
}

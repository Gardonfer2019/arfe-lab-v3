<?php

namespace App\Filament\Resources\SolicitudExamenResource\Pages;

use App\Filament\Resources\SolicitudExamenResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateSolicitudExamen extends CreateRecord
{
    protected static string $resource = SolicitudExamenResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Asignar automáticamente el ID del usuario logueado
        $data['usuario_id'] = Auth::id();
        return $data;
    }
}

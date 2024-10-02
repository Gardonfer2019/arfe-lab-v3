<?php

namespace App\Filament\Resources\SolicitudExamenResource\Pages;

use App\Filament\Resources\SolicitudExamenResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSolicitudExamen extends EditRecord
{
    protected static string $resource = SolicitudExamenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

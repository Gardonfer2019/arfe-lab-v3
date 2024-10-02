<?php

namespace App\Filament\Resources\SolicitudExamenResource\Pages;

use App\Filament\Resources\SolicitudExamenResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSolicitudExamens extends ListRecords
{
    protected static string $resource = SolicitudExamenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

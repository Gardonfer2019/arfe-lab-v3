<?php

namespace App\Filament\Resources\ResultadoExamenResource\Pages;

use App\Filament\Resources\ResultadoExamenResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditResultadoExamen extends EditRecord
{
    protected static string $resource = ResultadoExamenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

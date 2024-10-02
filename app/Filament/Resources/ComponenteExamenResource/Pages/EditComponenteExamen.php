<?php

namespace App\Filament\Resources\ComponenteExamenResource\Pages;

use App\Filament\Resources\ComponenteExamenResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditComponenteExamen extends EditRecord
{
    protected static string $resource = ComponenteExamenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

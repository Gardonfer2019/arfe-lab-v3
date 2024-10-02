<?php

namespace App\Filament\Resources\ComponenteExamenResource\Pages;

use App\Filament\Resources\ComponenteExamenResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListComponenteExamens extends ListRecords
{
    protected static string $resource = ComponenteExamenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

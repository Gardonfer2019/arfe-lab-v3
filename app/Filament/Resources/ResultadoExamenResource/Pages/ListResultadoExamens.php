<?php

namespace App\Filament\Resources\ResultadoExamenResource\Pages;

use App\Filament\Resources\ResultadoExamenResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListResultadoExamens extends ListRecords
{
    protected static string $resource = ResultadoExamenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

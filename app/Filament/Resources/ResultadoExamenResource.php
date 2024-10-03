<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ResultadoExamenResource\Pages;
use App\Filament\Resources\ResultadoExamenResource\RelationManagers;
use App\Models\ResultadoExamen;
use App\Models\Paciente;
use App\Models\ComponenteExamen;
use App\Models\SolicitudExamen;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;

class ResultadoExamenResource extends Resource
{
    protected static ?string $model = ResultadoExamen::class;

    protected static ?string $navigationGroup = 'Solicitudes';
    protected static ?int $navigationSort = 2;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Select::make('paciente_id')
                ->label('Paciente')
                ->options(Paciente::all()->pluck('nombre', 'id'))
                ->required()
                ->searchable(),
            Select::make('componente_id')
                ->label('Componente del Examen')
                ->options(ComponenteExamen::all()->pluck('nombre_componente', 'id'))
                ->required()
                ->searchable(),
            Select::make('solicitud_id')
                ->label('Solicitud de Examen')
                ->options(SolicitudExamen::all()->pluck('id', 'id')) // Aquí se puede personalizar la opción de solicitud mostrada
                ->required(),
            TextInput::make('resultado')
                ->label('Resultado')
                ->numeric()
                ->required(),
            DatePicker::make('fecha_examen')
                ->label('Fecha del Resultado')
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('paciente.nombre')
                    ->label('Paciente')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('componente.nombre_componente')
                    ->label('Componente de Examen')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('resultado')
                    ->label('Resultado')
                    ->sortable(),
                TextColumn::make('fecha_examen')
                    ->label('Fecha del Resultado')
                    ->sortable()
                    ->date(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListResultadoExamens::route('/'),
            'create' => Pages\CreateResultadoExamen::route('/create'),
            'edit' => Pages\EditResultadoExamen::route('/{record}/edit'),
        ];
    }
}

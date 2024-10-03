<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExamenResource\Pages;
use App\Filament\Resources\ExamenResource\RelationManagers;
use App\Models\Examen;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;


class ExamenResource extends Resource
{
    protected static ?string $model = Examen::class;

    protected static ?string $navigationGroup = 'Gestión de Exámenes';
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationIcon = 'heroicon-o-document';

    protected static ?string $navigationLabel = 'Exámenes'; // Texto en el menú de navegación
    protected static ?string $pluralModelLabel = 'Exámenes';
    protected static ?string $modelLabel = 'Examen';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                TextInput::make('nombre_examen')
                    ->label('Nombre del Examen')
                    ->required()
                    ->maxLength(100),
                Textarea::make('descripcion')
                    ->label('Descripción')
                    ->maxLength(500),
                TextInput::make('monto_default')
                    ->label('Monto Predeterminado')
                    ->required()
                    ->numeric() // Se asegura de que el campo solo acepte números
                    ->minValue(0) // Valor mínimo de 0
                    ->step(0.01), // Define el paso para valores decimales
                Select::make('series')
                    ->multiple()
                    ->relationship('series', 'nombre')
                    ->searchable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('nombre_examen')
                    ->label('Nombre del Examen')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('descripcion')
                    ->label('Descripción')
                    ->limit(50),
                TextColumn::make('monto_default')
                    ->label('Monto Predeterminado')
                    ->sortable()
                    ->formatStateUsing(fn (string $state): string => 'L. ' . number_format($state, 2)),
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
            'index' => Pages\ListExamens::route('/'),
            'create' => Pages\CreateExamen::route('/create'),
            'edit' => Pages\EditExamen::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ComponenteExamenResource\Pages;
use App\Filament\Resources\ComponenteExamenResource\RelationManagers;
use App\Models\ComponenteExamen;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use App\Models\Serie;

use App\Models\Examen;

class ComponenteExamenResource extends Resource
{
    protected static ?string $model = ComponenteExamen::class;
    protected static ?string $navigationGroup = 'Gestión de Exámenes';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-group';

    protected static ?string $navigationLabel = 'Componentes de Exámenes';
    protected static ?string $pluralModelLabel = 'Componentes de Exámenes';
    protected static ?string $modelLabel = 'Componente de Examen';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            Select::make('examen_id')
                ->label('Examen')
                ->options(Examen::all()->pluck('nombre_examen', 'id'))
                ->required()
                ->searchable(),
            Select::make('serie_id')
                ->label('Serie')
                ->options(Serie::all()->pluck('nombre', 'id'))
                ->searchable()
                ->required(),
            TextInput::make('nombre_componente')
                ->label('Nombre del Componente')
                ->required()
                ->maxLength(100),
            TextInput::make('abreviatura')
                ->label('Abreviatura')
                ->maxLength(50),
            TextInput::make('unidad')
                ->label('Unidad')
                ->maxLength(20),
            TextInput::make('valor_referencia_min')
                ->label('Valor Referencia Mínimo')
                ->numeric()
                ->step(0.01),
            TextInput::make('valor_referencia_max')
                ->label('Valor Referencia Máximo')
                ->numeric()
                ->step(0.01),
            
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('examen.nombre_examen')
                    ->label('Examen')
                    ->sortable(),
                TextColumn::make('nombre_componente')
                    ->label('Nombre del Componente')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('abreviatura')
                    ->label('Abreviatura'),
                TextColumn::make('unidad')
                    ->label('Unidad'),
                TextColumn::make('valor_referencia_min')
                    ->label('Valor Referencia Mínimo'),
                TextColumn::make('valor_referencia_max')
                    ->label('Valor Referencia Máximo'),
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
            'index' => Pages\ListComponenteExamens::route('/'),
            'create' => Pages\CreateComponenteExamen::route('/create'),
            'edit' => Pages\EditComponenteExamen::route('/{record}/edit'),
        ];
    }
}

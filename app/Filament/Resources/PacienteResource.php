<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PacienteResource\Pages;
use App\Filament\Resources\PacienteResource\RelationManagers;
use App\Models\Paciente;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\DateColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;

class PacienteResource extends Resource
{
    protected static ?string $model = Paciente::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                TextInput::make('nombre')
                    ->required()
                    ->maxLength(100),
                TextInput::make('apellido')
                    ->required()
                    ->maxLength(100),
                DatePicker::make('fecha_nacimiento')
                    ->required(),
                Select::make('genero')
                    ->options([
                        'masculino' => 'Masculino',
                        'femenino' => 'Femenino',
                        'otro' => 'Otro',
                    ])
                    ->required()
                    ->label('Género'),
                TextInput::make('telefono')
                    ->maxLength(20),
                TextInput::make('direccion'),
                TextInput::make('email')
                    ->email()
                    ->maxLength(100),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('nombre')->sortable()->searchable(),
                TextColumn::make('apellido')->sortable()->searchable(),
                TextColumn::make('fecha_nacimiento')->sortable(),
                TextColumn::make('genero')->sortable(),
                TextColumn::make('telefono')->sortable(),
                TextColumn::make('direccion'),
                TextColumn::make('email')->sortable(),
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
            'index' => Pages\ListPacientes::route('/'),
            'create' => Pages\CreatePaciente::route('/create'),
            'edit' => Pages\EditPaciente::route('/{record}/edit'),
        ];
    }
}

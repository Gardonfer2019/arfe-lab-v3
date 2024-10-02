<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SolicitudExamenResource\Pages;
//use App\Filament\Resources\SolicitudExamenResource\RelationManagers;
//use App\Filament\Resources\SolicitudExamenResource\RelationManagers\DetallesRelationManager;
use App\Filament\Resources\SolicitudExamenResource\RelationManagers\ResultadosRelationManager;
use App\Models\SolicitudExamen;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\Paciente;
use App\Models\User;
use App\Models\Examen;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\HasManyRepeater;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Actions\Action;

class SolicitudExamenResource extends Resource
{
    protected static ?string $model = SolicitudExamen::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $navigationLabel = 'Solicitudes de Exámenes';
    protected static ?string $pluralModelLabel = 'Solicitudes de Exámenes';
    protected static ?string $modelLabel = 'Solicitud de Examen';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('paciente_id')
                    ->label('Paciente')
                    ->options(Paciente::all()->pluck('nombre_completo', 'id'))
                    ->required()
                    ->searchable(),
                DatePicker::make('fecha_solicitud')
                    ->label('Fecha de Solicitud')
                    ->required(),
                Select::make('estado')
                    ->label('Estado')
                    ->options([
                        'pendiente' => 'Pendiente',
                        'completado' => 'Completado',
                        'cancelado' => 'Cancelado',
                    ])
                    ->default('pendiente')
                    ->required(),
                // El campo 'usuario_id' se asigna automáticamente en el backend, no se muestra en el formulario
                Hidden::make('usuario_id') // Campo oculto para el ID del usuario
                    ->default(Auth::id()),
                // HasManyRepeater para agregar exámenes a la solicitud
                HasManyRepeater::make('detalles')
                    ->relationship('detalles') // Define la relación 'detalles' con la tabla 'detalle_solicitudes_examenes'
                    ->schema([
                        Select::make('examen_id')
                            ->label('Examen')
                            ->options(Examen::all()->pluck('nombre_examen', 'id'))
                            ->required()
                            ->searchable(),
                    ])
                    ->label('Exámenes Solicitados')
                    ->minItems(1), // Puedes requerir al menos un examen
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('paciente.nombre_completo') // Usamos el accesor para el nombre completo
                ->label('Paciente')
                ->sortable()
                ->searchable(),
                TextColumn::make('usuario.name')
                    ->label('Técnico/Encargado')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('fecha_solicitud')
                    ->label('Fecha de Solicitud')
                    ->sortable()
                    ->date(),
                TextColumn::make('estado')
                    ->label('Estado')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                // Añadir la acción personalizada para abrir el modal de detalle
                Action::make('verDetalle')
                    ->label('Ver Detalle')
                    ->icon('heroicon-o-eye')
                    ->modalHeading('Detalles de la Solicitud')
                    ->modalSubheading('Lista de exámenes solicitados')
                    ->action(function (SolicitudExamen $record, Tables\Actions\Action $action) {
                        // Acción que abrirá el modal (dejamos en blanco ya que la acción es solo mostrar)
                    })
                    ->modalContent(function (SolicitudExamen $record) {
                        // Mostrar los exámenes solicitados en el modal
                        return view('filament.modals.detalle-solicitud', [
                            'detalles' => $record->detalles // Los exámenes solicitados
                        ]);
                    })
                    ->button(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->label('Eliminar seleccionados'),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
            //DetallesRelationManager::class,
            ResultadosRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSolicitudExamens::route('/'),
            'create' => Pages\CreateSolicitudExamen::route('/create'),
            'edit' => Pages\EditSolicitudExamen::route('/{record}/edit'),
        ];
    }
}

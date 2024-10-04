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
use Filament\Forms\Components\TextArea;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\HasManyRepeater;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;

class SolicitudExamenResource extends Resource
{
    protected static ?string $model = SolicitudExamen::class;

    protected static ?string $navigationGroup = 'Solicitudes';
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    

    
    protected static ?string $navigationLabel = 'Solicitudes de Exámenes';
    protected static ?string $pluralModelLabel = 'Solicitudes de Exámenes';
    

    // Método para mostrar el número de solicitudes pendientes
    public static function getNavigationBadge(): ?string
    {
        return (string) SolicitudExamen::where('estado', 'pendiente')->count();
    }

    // Método para cambiar el color del badge a 'warning'
    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning'; // Cambiar el color a "warning" (amarillo)
    }

    
    protected static ?string $modelLabel = 'Solicitud de Examen';

    
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Dividimos los primeros tres campos en tres columnas
                Forms\Components\Grid::make(3)
                    ->schema([
                        Select::make('paciente_id')
                            ->label('Paciente')
                            ->options(Paciente::all()->pluck('nombre_completo', 'id'))
                            ->required()
                            ->searchable(),
                        Select::make('estado')
                            ->label('Estado')
                            ->options([
                                'pendiente' => 'Pendiente',
                                'completado' => 'Completado',
                                'cancelado' => 'Cancelado',
                            ])
                            ->default('pendiente')
                            ->required(),
                        DatePicker::make('fecha_solicitud')
                            ->label('Fecha de Solicitud')
                            ->required(),
                    ]),

                // Exámenes solicitados con observación por separado
                HasManyRepeater::make('detalles')
                    ->relationship('detalles')
                    ->schema([
                        Forms\Components\Grid::make(1) // Esto asegura que cada examen ocupe toda la columna
                            ->schema([
                                Select::make('examen_id')
                                    ->label('Examen')
                                    ->options(Examen::all()->pluck('nombre_examen', 'id'))
                                    ->required()
                                    ->searchable()
                                    ->columnSpan('full'), // Ocupa toda la columna
                                Textarea::make('observacion')
                                    ->label('Observación')
                                    ->placeholder('Añadir una observación para este examen')
                                    ->rows(3)
                                    ->maxLength(500)
                                    ->columnSpan('full'), // Ocupa toda la columna
                            ]),
                    ])
                    ->label('Exámenes Solicitados')
                    ->minItems(1)
                    ->required(),// Puedes requerir al menos un examen
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('paciente.nombre') 
                    ->label('Nombre')
                    ->sortable()
                    ->searchable(), // Esto permite buscar solo por 'nombre'

                TextColumn::make('paciente.apellido') 
                    ->label('Apellido')
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
                    ->badge() // Agrega el estilo de badge
                    ->color(fn (string $state): string => match ($state) {
                        'pendiente' => 'warning',   // Estado pendiente en amarillo
                        'completado' => 'success',  // Estado completado en verde
                        'cancelado' => 'danger',    // Estado cancelado en rojo
                        default => 'secondary',     // Otros estados (si existen) en gris
                    })
                    ->sortable(),
            ])
            ->filters([
                //
                SelectFilter::make('estado')
                    ->label('Estado')
                    ->options([
                        'pendiente' => 'Pendiente',
                        'completado' => 'Completado',
                        'cancelado' => 'Cancelado',
                    ]),
                Filter::make('fecha_solicitud')
                    ->label('Fecha de Solicitud')
                    ->form([
                        DatePicker::make('fecha_desde')->label('Desde'),
                        DatePicker::make('fecha_hasta')->label('Hasta'),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query
                            ->when($data['fecha_desde'], fn ($query, $date) => $query->whereDate('fecha_solicitud', '>=', $date))
                            ->when($data['fecha_hasta'], fn ($query, $date) => $query->whereDate('fecha_solicitud', '<=', $date));
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                // Añadir la acción personalizada para abrir el modal de detalle
                Action::make('verDetalle')
                    ->label('Ver Detalle')
                    ->icon('heroicon-o-eye')
                    ->modalHeading('Detalles de la Solicitud')
                    ->modalSubheading('Información completa de la solicitud')
                    ->action(function (SolicitudExamen $record, Action $action) {
                        // Pasar la solicitud al modal usando la acción
                    })
                    ->modalContent(function (SolicitudExamen $record) {
                        // Pasar la solicitud a la vista del modal
                        return view('filament.modals.detalle-solicitud', [
                            'solicitud' => $record // Pasamos la variable solicitud correctamente
                        ]);
                    })
                    ->button(),  
                    Action::make('imprimir')
                ->label('Imprimir')
                ->icon('heroicon-o-printer')
                ->action(function (SolicitudExamen $record) {
                    return redirect()->route('solicitud.imprimir', $record->id);
                })
                ->openUrlInNewTab(), // Esto abrirá la vista en una nueva pestaña              

                
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

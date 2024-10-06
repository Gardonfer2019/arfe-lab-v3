<?php
namespace App\Filament\Resources\SolicitudExamenResource\RelationManagers;


use Filament\Resources\RelationManagers\RelationManager;
use Filament\Forms;
use Filament\Tables; // Importar correctamente Filament\Tables\Table
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use App\Models\ComponenteExamen;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class ResultadosRelationManager extends RelationManager
{
    protected static string $relationship = 'resultados'; // Relación con los resultados de exámenes
    protected static ?string $recordTitleAttribute = 'id'; // Usamos el ID como título para la relación

    // Corregimos el uso del tipo de dato 'Table'
    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                // Mostrar el nombre del examen usando SQL crudo
                TextColumn::make('examen')
                    ->label('Examen')
                    ->getStateUsing(function ($record) {
                        // Ejecutar una consulta SQL cruda para obtener el nombre del examen
                        $examen = DB::table('examenes')
                            ->join('componentes_examen', 'examenes.id', '=', 'componentes_examen.examen_id')
                            ->where('componentes_examen.id', $record->componente_id)
                            ->value('examenes.nombre_examen');
                        
                        return $examen ?: 'Sin examen asociado'; // Manejar el caso de examen nulo
                    }),
                TextColumn::make('componente.nombre_componente') // Mostrar el nombre del componente del examen
                    ->label('Componente')
                    ->sortable(),
                TextColumn::make('resultado') // Mostrar el resultado
                    ->label('Resultado')
                    ->sortable(),
                // Columna personalizada que concatena valores de referencia y unidades usando SQL
                TextColumn::make('componente')
                    ->label('Valores de Referencia (Unidades)')
                    ->getStateUsing(function ($record) {
                        // Ejecutar una consulta SQL para concatenar valores de referencia y unidades
                        $componente = DB::table('componentes_examen')
                            ->where('id', $record->componente_id)
                            ->first();

                        if ($componente) {
                            return "{$componente->valor_referencia_min} - {$componente->valor_referencia_max} {$componente->unidad}";
                        }
                        return 'No definido';
                    }),
                
            ])
            ->filters([
                // Puedes agregar filtros adicionales aquí
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Editar Resultado'),
                Tables\Actions\DeleteAction::make()->label('Eliminar Resultado'),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()->label('Eliminar Resultados Seleccionados'),
            ]);
    }

    public function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Select::make('componente_id')
                    ->label('Componente del Examen')
                    ->options(ComponenteExamen::all()->pluck('nombre_componente', 'id')) // Mostrar los componentes del examen
                    ->required()
                    ->searchable(),
                TextInput::make('resultado')
                    ->label('Resultado')
                    ->required()
                    ->maxLength(255), 
            ]);
    }
}



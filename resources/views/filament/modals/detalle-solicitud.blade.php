<div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
    <h3 class="text-lg font-bold mb-4 text-gray-700 dark:text-gray-200">Detalles de la Solicitud</h3>

    <!-- Información del paciente y técnico -->
    <div class="grid grid-cols-2 gap-4 mb-6">
        <div>
            <p class="text-sm font-semibold text-gray-500 dark:text-gray-400">Paciente:</p>
            <p class="text-md font-bold text-gray-800 dark:text-gray-100">{{ $solicitud->paciente->nombre_completo }}</p>
        </div>
        <div>
            <p class="text-sm font-semibold text-gray-500 dark:text-gray-400">Técnico/Encargado:</p>
            <p class="text-md font-bold text-gray-800 dark:text-gray-100">{{ $solicitud->usuario->name }}</p>
        </div>
        <div>
            <p class="text-sm font-semibold text-gray-500 dark:text-gray-400">Fecha de Solicitud:</p>
            <p class="text-md text-gray-800 dark:text-gray-100">
                {{ $solicitud->fecha_solicitud ? $solicitud->fecha_solicitud->format('d-m-Y') : 'Fecha no disponible' }}
            </p>
        </div>
        <div>
            <!-- Componente Livewire para cambiar el estado -->
            @livewire('cambiar-estado-solicitud', ['solicitud' => $solicitud])
        </div>
    </div>

    <!-- Exámenes Solicitados -->
    <div class="mb-6">
        <h4 class="text-md font-semibold text-gray-700 dark:text-gray-200">Exámenes Solicitados:</h4>
        @if($solicitud->detalles->isEmpty())
            <p class="text-sm text-gray-500 dark:text-gray-400">No hay exámenes solicitados.</p>
        @else
            <ul class="list-disc pl-5 text-gray-800 dark:text-gray-100">
                @foreach ($solicitud->detalles as $detalle)
                    <li>{{ $detalle->examen->nombre_examen }}</li>
                @endforeach
            </ul>
        @endif
    </div>

    <!-- Resultados de los Exámenes agrupados en cards -->
    <div>
        <h4 class="text-md font-semibold text-gray-700 dark:text-gray-200">Resultados de los Exámenes:</h4>
        @if($solicitud->resultados->isEmpty())
            <p class="text-sm text-gray-500 dark:text-gray-400">No hay resultados disponibles.</p>
        @else
            <!-- Agrupar los resultados por examen -->
            @foreach ($solicitud->detalles as $detalle)
                <!-- Card de cada examen -->
                <div class="bg-gray-100 dark:bg-gray-600 p-4 mb-4 rounded-lg shadow-md">
                    <h5 class="text-lg font-semibold text-gray-700 dark:text-gray-100 mb-3">{{ $detalle->examen->nombre_examen }}</h5>
                    
                    <ul class="space-y-2">
                        @foreach ($detalle->examen->componentes as $componente)
                            @php
                                $resultado = $solicitud->resultados->where('componente_id', $componente->id)->first();
                            @endphp
                            <li class="flex justify-between items-center">
                                <div>
                                    <span class="font-bold text-gray-700 dark:text-gray-100">{{ $componente->nombre_componente }}</span>
                                    <span class="text-sm text-gray-500 dark:text-gray-300">({{ $componente->unidad }})</span>
                                    <p class="text-sm text-gray-500 dark:text-gray-300">Valor de referencia: {{ $componente->valor_referencia_min }} - {{ $componente->valor_referencia_max }}</p>
                                </div>
                                <span class="text-gray-800 dark:text-gray-100">
                                    {{ $resultado ? $resultado->resultado : 'Sin resultado' }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        @endif
    </div>
</div>

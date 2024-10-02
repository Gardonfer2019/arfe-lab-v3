<div>
    <h3 class="text-lg font-bold mb-4">Exámenes Solicitados</h3>

    <ul class="list-disc pl-5">
        @foreach ($detalles as $detalle)
            <li>{{ $detalle->examen->nombre_examen }} - {{ $detalle->examen->descripcion }}</li>
        @endforeach
    </ul>
</div>

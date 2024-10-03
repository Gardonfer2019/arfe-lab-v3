<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados del Examen</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            margin: 20px;
            padding: 20px;
            background-color: #f4f4f4;
            color: #333;
        }
        h1, h3 {
            text-align: center;
            color: #2c3e50;
            font-weight: 700;
        }
        p {
            font-size: 14px;
            line-height: 1.5;
            font-weight: 400;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header strong {
            font-size: 16px;
            font-weight: 500;
        }
        .table-container {
            margin: 0 auto;
            width: 100%;
            max-width: 800px;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
            font-weight: 400;
        }
        th {
            background-color: #2c3e50;
            color: white;
            font-weight: 500;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        h3 {
            background-color: #3498db;
            color: white;
            padding: 10px;
            border-radius: 5px;
            font-weight: 500;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #777;
            font-weight: 300;
        }
    </style>
</head>
<body>

<div class="header">
    <h1>Resultados del Examen</h1>
    <p><strong>Paciente:</strong> {{ $solicitud[0]->nombre_paciente }}</p>
    <p><strong>Fecha de Solicitud:</strong> {{ $solicitud[0]->fecha_solicitud }}</p>
</div>

<div class="table-container">
    @php
        $examenActual = null;
    @endphp

    @foreach($solicitud as $resultado)
        @if($examenActual !== $resultado->nombre_examen)
            @if($examenActual !== null)
                </tbody>
                </table>
            @endif
            <h3>{{ $resultado->nombre_examen }} <span style="font-size: 14px;">(Fecha Resultado: {{ $resultado->fecha_examen }})</span></h3>
            <table>
                <thead>
                    <tr>
                        <th>Componente</th>
                        <th>Resultado</th>
                        <th>Referencia</th>
                    </tr>
                </thead>
                <tbody>
            @php
                $examenActual = $resultado->nombre_examen;
            @endphp
        @endif
        <tr>
            <td>{{ $resultado->nombre_componente }}</td>
            <td>{{ $resultado->resultado }}</td>
            <td>{{ $resultado->referencia }}</td>
        </tr>
    @endforeach

    @if($examenActual !== null)
        </tbody>
        </table>
    @endif
</div>

<div class="footer">
    <p>Laboratorio Clínico ARFE Lab - Resultados Generados Automáticamente</p>
</div>

</body>
</html>

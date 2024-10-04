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
            color: #4b0082; /* Púrpura del logo */
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

        .logo {
            text-align: center;
            margin-bottom: 10px;
        }

        .logo img {
            width: 100px;
            height: auto;
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
            background-color: #4b0082; /* Púrpura del logo */
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
            background-color: #f1c40f; /* Amarillo del logo */
            color: rgb(44, 44, 44);
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

        .series-title {
            background-color: #4b0082; /* Púrpura */
            color: white;
            font-weight: 600;
            padding: 5px;
            border-radius: 4px;
            text-align: left;
            margin-bottom: 10px;
        }

        .observacion {
            margin-top: 10px;
            font-size: 14px;
            font-weight: 500;
            color: #2c3e50;
            background-color: #f8f9fa;
            padding: 10px;
            border-radius: 8px;
        }

        .firma {
            margin-top: 40px;
            text-align: center;
            font-size: 14px;
            font-weight: 500;
        }

        .firma .nombre-medico {
            font-weight: 700;
            margin-top: 5px;
        }

        /* Nueva sección de información del paciente en una sola fila */
        .info-paciente {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding: 10px;
            background-color: #ecf0f1;
            border-radius: 8px;
        }

        .info-paciente div {
            flex: 1;
            text-align: center;
        }

        /* Ajustes para la impresión */
        @media print {
            body {
                margin: 0;
                padding: 0;
            }

            .table-container {
                max-width: 100%;
                box-shadow: none;
                border: none;
            }

            .header {
                margin-bottom: 10px;
            }

            button {
                display: none; /* Ocultar el botón de impresión al imprimir */
            }
        }
    </style>
</head>
<body>

<div class="header">
    <div class="logo">
        <img src="{{ asset('images/Logo2 sin fondo.png') }}" alt="Logo del Laboratorio">
    </div>
    <h1>Resultados del Examen</h1>

    <!-- Información del Paciente en una sola fila -->
    <div class="info-paciente">
        <div><strong>Paciente:</strong> {{ $solicitud[0]->nombre_paciente }}</div>
        <div><strong>Edad:</strong> {{ $solicitud[0]->edad }} años</div>
        <div><strong>Sexo:</strong> {{ $solicitud[0]->sexo }}</div>
        <div><strong>Fecha de Solicitud:</strong> {{ $solicitud[0]->fecha_solicitud }}</div>
    </div>
</div>

<div class="table-container">
    @php
        $examenActual = null;
        $serieActual = null;
    @endphp

    @foreach($solicitud as $resultado)
        @if($examenActual !== $resultado->nombre_examen)
            @if($examenActual !== null)
                </tbody>
                </table>
                <!-- Mostrar observación para el examen anterior -->
                <div class="observacion">
                    <strong>Observación:</strong>
                    <p>{{ $resultado->observacion }}</p>
                </div>
            @endif
            <h3>{{ $resultado->nombre_examen }} <span style="font-size: 14px;">(Fecha Resultado: {{ $resultado->fecha_examen }})</span></h3>

            @php
                $examenActual = $resultado->nombre_examen;
                $serieActual = null;
            @endphp
        @endif

        @if(!empty($resultado->nombre_serie) && $serieActual !== $resultado->nombre_serie)
            @if($serieActual !== null)
                </tbody>
                </table>
            @endif
            <div class="series-title">{{ $resultado->nombre_serie }}</div>
            <table>
                <thead>
                    <tr>
                        <th>Componente/Examen</th>
                        <th>Resultado</th>
                        <th>Referencia</th>
                    </tr>
                </thead>
                <tbody>

            @php
                $serieActual = $resultado->nombre_serie;
            @endphp
        @elseif(empty($resultado->nombre_serie) && $serieActual !== 'sin-serie')
            @if($serieActual !== null)
                </tbody>
                </table>
            @endif
            <table>
                <thead>
                    <tr>
                        <th>Componente/Examen</th>
                        <th>Resultado</th>
                        <th>Referencia</th>
                    </tr>
                </thead>
                <tbody>
            @php
                $serieActual = 'sin-serie';
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
        <!-- Mostrar observación para el último examen -->
        <div class="observacion">
            <strong>Observación:</strong>
            <p>{{ $resultado->observacion }}</p>
        </div>
    @endif
</div>

<div class="firma">
    <p>_____________________________</p>
    <p class="nombre-medico">Dra. Fabiola Ardón</p>
    <p>Microbióloga Clínica</p>
</div>

<div class="footer">
    <p>Laboratorio Clínico ARFE Lab - Resultados Generados Automáticamente</p>
</div>

<!-- Botón para imprimir -->
<script>
    function imprimirPagina() {
        window.print();
    }
</script>

<button onclick="imprimirPagina()">Imprimir</button>

</body>
</html>

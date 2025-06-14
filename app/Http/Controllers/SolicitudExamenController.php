<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SolicitudExamen;
use DB;

class SolicitudExamenController extends Controller
{
    //
    public function imprimir($id)
    {
        // Consulta SQL cruda para obtener los detalles de la solicitud de examen con series
        $solicitud = DB::select("
            SELECT 
                s.id as solicitud_id, 
                concat(p.nombre, ' ', p.apellido) as nombre_paciente, 
                EXTRACT(YEAR FROM AGE(p.fecha_nacimiento)) AS edad,
                p.genero as sexo,
                e.nombre_examen as nombre_examen, 
                se.nombre as nombre_serie, -- Agregar el nombre de la serie
                c.nombre_componente as nombre_componente, 
                r.resultado as resultado, 
                concat(c.valor_referencia_min, ' - ', c.valor_referencia_max, ' ', c.unidad) as referencia, 
                s.fecha_solicitud,
                r.fecha_examen,
                d.observacion
            FROM 
                solicitudes_examenes s
            INNER JOIN 
                pacientes p ON s.paciente_id = p.id
            INNER JOIN 
                resultados_examen r ON r.solicitud_id = s.id
            INNER JOIN 
                componentes_examen c ON r.componente_id = c.id
            INNER JOIN 
                examenes e ON c.examen_id = e.id
            LEFT JOIN 
                series se ON se.id = c.serie_id -- Left join para series
            LEFT JOIN 
                detalle_solicitudes_examenes d ON d.solicitud_id = s.id AND d.examen_id = e.id
            WHERE 
                s.id = :id
            ORDER BY 
                e.nombre_examen, se.nombre desc, c.id asc
        ", ['id' => $id]);

        // Verificar si la solicitud tiene datos
        if (empty($solicitud)) {
            // Si no se encuentra la solicitud, devolver un error o redirigir
            return redirect()->back()->withErrors('Solicitud no encontrada');
        }

    // Retornar la vista con los datos de la solicitud
        return view('solicitudes.imprimir', compact('solicitud'));
    }
}

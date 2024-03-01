<?php

namespace App\Http\Controllers;

use App\Imports\IncidenciaOSIImport;
use App\Models\IncidenciaOSI;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class IncidenciaOSIController extends Controller
{
    public function index()
    {
        $incidencias = IncidenciaOSI::all();
        return view('incidenciasosi', compact('incidencias'));
    }

    public function show($id)
    {
        $incidencia = IncidenciaOSI::find($id);
        return json_encode($incidencia);
    }

    public function revisar($id)
    {
        $incidencia = IncidenciaOSI::find($id);
        $incidencia['revisado'] = 1;
        $incidencia['fecharevisado'] = Carbon::now();
        if ($incidencia->save()) {
            return 1;
        }
    }

    public function pendiente($id)
    {
        $incidencia = IncidenciaOSI::find($id);
        $incidencia['revisado'] = 2;
        if ($incidencia->save()) {
            return 1;
        }
    }

    public function importar(Request $request)
    {
        $archivo = $request->archivo;
        $rutaArchivo = $archivo->move(public_path('uploads'), $archivo->getClientOriginalName());

        $fechaBaseExcel = mktime(0, 0, 0, 1, 1, 1900);

        $datosArchivo = Excel::toArray(new IncidenciaOSIImport, $rutaArchivo);
        array_shift($datosArchivo[0]);

        foreach ($datosArchivo[0] as $row) {
            if (isset($row[2])) {
                $fechaSerialExcel = intval($row[2]);
                $fecha = date('Y-m-d', ($fechaBaseExcel + ($fechaSerialExcel - 1) * 86400));
            } else {
                $fecha = null;
            }

            if (isset($row[8])) {
                $valordigerido = $row[8];
                $coderror = $row[9] ?? null;
                $descripcion = $row[14] ?? null;

                $incidencia = IncidenciaOSI::where('valordigerido', $valordigerido)->first();

                if (!$incidencia) {
                    IncidenciaOSI::create([
                        'revisado'      => strlen($row[0]) > 0 ? 1 : 0,
                        'ruc'           => $row[1]  ?? null,
                        'fecha'         => $fecha ? Carbon::parse($fecha)->subDay() : null,
                        'razonsocial'   => $row[3]  ?? null,
                        'documento'     => $row[4]  ?? null,
                        'tipodocumento' => $row[5]  ?? null,
                        'serie'         => $row[6]  ?? null,
                        'correlativo'   => $row[7]  ?? null,
                        'valordigerido' => $row[8]  ?? null,
                        'coderror'      => $row[9]  ?? null,
                        'descripcion'   => $row[14] ?? null,
                    ]);
                } else {
                    if ($incidencia['revisado'] != 1) {
                        $incidencia->update([
                            'coderror'      => $coderror,
                            'descripcion'   => $descripcion,
                        ]);
                    }
                }
            }
        }

        return redirect('/incidenciasosi');
    }
}

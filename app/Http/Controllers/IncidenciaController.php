<?php

namespace App\Http\Controllers;

use App\Imports\IncidenciaImport;
use App\Models\Incidencia;
use App\Models\Usuario;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class IncidenciaController extends Controller
{

    public function index()
    {
        $query = Incidencia::query();

        if (request()->ajax()) {
            return datatables()->eloquent($query->orderByRaw("FIELD(revisado, 0, 2, 1)"))
                ->addColumn('option', function ($incidencia) {
                    return view('incidencias.option', compact('incidencia'));
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('incidencias.index');
    }

    public function show(Request $request)
    {
        $where = array('id' => $request->id);
        $incidencia  = Incidencia::where($where)->first();

        return Response()->json($incidencia);
    }

    public function revisar(Request $request)
    {
        $where = array('id' => $request->id);
        $incidencia  = Incidencia::where($where)->first();
        $incidencia['revisado'] = 1;
        $incidencia['fecharevisado'] = Carbon::now();
        $incidencia['detalle'] = $request->detalle;
        $incidencia->save();

        return Response()->json($incidencia);
    }

    public function pendiente(Request $request)
    {
        $where = array('id' => $request->id);
        $incidencia  = Incidencia::where($where)->first();
        $incidencia['revisado'] = 2;
        $incidencia->save();

        return Response()->json($incidencia);
    }

    public function importar(Request $request)
    {
        $archivo = $request->archivo;
        $rutaArchivo = $archivo->move(public_path('uploads'), $archivo->getClientOriginalName());

        //$fechaBaseExcel = mktime(0, 0, 0, 1, 1, 1900);

        $datosArchivo = Excel::toArray(new IncidenciaImport, $rutaArchivo);
        array_shift($datosArchivo[0]);

        //echo json_encode($datosArchivo);die;

        foreach ($datosArchivo[0] as $row) {
            if (isset($row[2])) {
                $fecha = Carbon::createFromFormat('Y-m-d H:i:s', $row[2])->toDateString();
            } else {
                $fecha = null;
            }

            $valordigerido = $row[8];
            $coderror = $row[9] ?? "NULL";
            $descripcion = $row[14] ?? "NULL";

            $incidencia  = Incidencia::where('valordigerido', $valordigerido)->first();

            if (!$incidencia) {
                Incidencia::create([
                    'revisado'      => 0,
                    'ruc'           => $row[1]  ?? null,
                    'fecha'         => $fecha,
                    'razonsocial'   => $row[3]  ?? null,
                    'documento'     => $row[4]  ?? null,
                    'tipodocumento' => $row[5]  ?? null,
                    'serie'         => $row[6]  ?? "NULL",
                    'correlativo'   => $row[7]  ?? "NULL",
                    'valordigerido' => $row[8]  ?? null,
                    'coderror'      => $row[9]  ?? "NULL",
                    'descripcion'   => $row[14] ?? "NULL",
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

        return redirect('/incidencias');
    }
}

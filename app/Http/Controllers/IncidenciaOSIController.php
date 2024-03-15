<?php

namespace App\Http\Controllers;

use App\Imports\IncidenciaOSIImport;
use App\Models\Cliente;
use App\Models\IncidenciaOSI;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class IncidenciaOSIController extends Controller
{
    public function index()
    {
        $query = IncidenciaOSI::query();

        if (request()->ajax()) {
            if (!Session::has('usuario')) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }
            return datatables()->eloquent($query->orderByRaw("FIELD(revisado, 0, 2, 1)"))
                ->addColumn('option', function ($incidencia) {
                    return view('incidenciasose.option', compact('incidencia'));
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('incidenciasose.index');
    }

    public function show(Request $request)
    {
        $where = array('id' => $request->id);
        $incidencia  = IncidenciaOSI::where($where)->first();

        return Response()->json($incidencia);
    }

    public function revisar(Request $request)
    {
        $where = array('id' => $request->id);
        $incidencia  = IncidenciaOSI::where($where)->first();
        $incidencia['revisado'] = 1;
        $incidencia['fecharevisado'] = Carbon::now();
        $incidencia['detalle'] = $request->detalle;
        $incidencia->save();

        return Response()->json($incidencia);
    }

    public function pendiente(Request $request)
    {
        $where = array('id' => $request->id);
        $incidencia  = IncidenciaOSI::where($where)->first();
        $incidencia['revisado'] = 2;
        $incidencia->save();

        return Response()->json($incidencia);
    }

    public function importar(Request $request)
    {
        $archivo = $request->archivo;
        $rutaArchivo = $archivo->move(public_path('uploads'), $archivo->getClientOriginalName());

        //$fechaBaseExcel = mktime(0, 0, 0, 1, 1, 1900);

        $datosArchivo = Excel::toArray(new IncidenciaOSIImport, $rutaArchivo);
        array_shift($datosArchivo[0]);

        foreach ($datosArchivo[0] as $row) {
            /*if (isset($row[2])) {
                $fechaSerialExcel = intval($row[2]);
                $fecha = date('Y-m-d', ($fechaBaseExcel + ($fechaSerialExcel - 1) * 86400));
            } else {
                $fecha = null;
            }*/
            if (isset($row[2])) {
                $fecha = Carbon::createFromFormat('Y-m-d H:i:s', $row[2])->toDateString();
            } else {
                $fecha = null;
            }

            if (isset($row[8])) {
                $valordigerido = $row[8];
                $coderror = $row[9] ?? "NULL";
                $descripcion = $row[14] ?? "NULL";

                $incidencia = IncidenciaOSI::where('valordigerido', $valordigerido)->first();

                if (!$incidencia) {
                    $cliente = Cliente::where('ruc', $row[1])->first();
                    if ($cliente->partner) {
                        $partner = $cliente->partner;
                    } else {
                        $partner = null;
                    }

                    IncidenciaOSI::create([
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
                        'partner'       => $partner,
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

        return redirect('/incidenciasose');
    }
}

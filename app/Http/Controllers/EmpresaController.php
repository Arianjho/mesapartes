<?php

namespace App\Http\Controllers;

use App\Imports\EmpresaImport;
use App\Models\Empresa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Empresa::query();

        if (request()->ajax()) {
            if (!Session::has('usuario')) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }
            return datatables()->eloquent($query)
                ->addColumn('option', function ($cliente) {
                    return view('clientes.option', compact('cliente'));
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('clientes.index');
    }

    public function cambiar(Request $request)
    {
        $where = array('id' => $request->id);
        $cliente  = Empresa::where($where)->first();
        $cliente['modlocal'] = "Si";
        $cliente->save();

        return Response()->json($cliente);
    }

    public function revisar(Request $request)
    {
        $where = array('id' => $request->id);
        $cliente  = Empresa::where($where)->first();
        $cliente['ultmodificacion'] = Carbon::now();
        $cliente->save();

        return Response()->json($cliente);
    }

    public function importar(Request $request)
    {
        $archivo = $request->archivo;
        $rutaArchivo = $archivo->move(public_path('uploads'), $archivo->getClientOriginalName());

        $datosArchivo = Excel::toArray(new EmpresaImport, $rutaArchivo);
        array_shift($datosArchivo[0]);

        //echo json_encode($datosArchivo);
        //die;

        foreach ($datosArchivo[0] as $row) {
            Empresa::create([
                'ruc'           => $row[0]  ?? null,
                'razonsocial'   => $row[1]  ?? null,
                'partner'       => $row[2]  ?? null,
                'estado'        => $row[3]  ?? null,
                'modalidad'     => $row[4]  ?? null,
            ]);
        }

        return redirect('/clientes');
    }
}

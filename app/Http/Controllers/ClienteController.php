<?php

namespace App\Http\Controllers;

use App\Imports\ClienteImport;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Cliente::query();

        if (request()->ajax()) {
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

    public function importar(Request $request)
    {
        $archivo = $request->archivo;
        $rutaArchivo = $archivo->move(public_path('uploads'), $archivo->getClientOriginalName());

        $datosArchivo = Excel::toArray(new ClienteImport, $rutaArchivo);
        array_shift($datosArchivo[0]);

        //echo json_encode($datosArchivo);
        //die;

        foreach ($datosArchivo[0] as $row) {
            Cliente::create([
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

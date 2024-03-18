<?php

namespace App\Http\Controllers;

use App\Models\Diccionario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DiccionarioController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            if (!Session::has('usuario')) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }
            return datatables()->of(Diccionario::orderByRaw('CAST(coderror AS UNSIGNED) ASC')->get())
                ->addColumn('option', function ($diccionario) {
                    return view('diccionario.option', compact('diccionario'));
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('diccionario.index');
    }

    public function store(Request $request)
    {
        $detalleId = $request->id;

        $datosUsuario = [
            'coderror' => $request->coderror,
            'descripcion' => $request->descripcion,
            'detalle' => $request->detalle,
        ];

        $detalle = Diccionario::updateOrCreate(
            ['id' => $detalleId],
            $datosUsuario
        );

        return Response()->json($detalle);
    }

    public function edit(Request $request)
    {
        $where = array('id' => $request->id);
        $detalle  = Diccionario::where($where)->first();

        return Response()->json($detalle);
    }

    public function destroy(Request $request)
    {
        $detalle = Diccionario::where('id', $request->id)->delete();

        return Response()->json($detalle);
    }
}

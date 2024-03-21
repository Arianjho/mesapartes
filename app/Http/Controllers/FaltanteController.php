<?php

namespace App\Http\Controllers;

use App\Imports\FaltanteImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class FaltanteController extends Controller
{
    public function index()
    {
        $datosArchivo = Excel::toArray(new FaltanteImport, public_path('faltantes/reporte_diario (1).xls'));
        array_shift($datosArchivo[0]);

        echo json_encode($datosArchivo);die;
    }
}

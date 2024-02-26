<?php

namespace App\Imports;

use App\Models\IncidenciaOSI;
use Maatwebsite\Excel\Concerns\ToModel;

class IncidenciaOSIImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $fechaBaseExcel = mktime(0, 0, 0, 1, 1, 1900);

        if (isset($row[2])) {
            $fechaSerialExcel = intval($row[2]);
            $fecha = date('Y-m-d', ($fechaBaseExcel + ($fechaSerialExcel - 1) * 86400));
        } else {
            $fecha = null;
        }

        return new IncidenciaOSI([
            'ruc'           => $row[1] ?? null,
            'fecha'         => $fecha,
            'razonsocial'   => $row[3] ?? null,
            'documento'     => $row[4] ?? null,
            'tipodocumento' => $row[5] ?? null,
            'serie'         => $row[6] ?? null,
            'correlativo'   => $row[7] ?? null,
            'valordigerido' => $row[8] ?? null,
            'coderror'      => $row[9] ?? null,
            'descripcion'   => $row[14] ?? null,
        ]);
    }
}

<?php

namespace App\Imports;

use App\Models\Empresa;
use Maatwebsite\Excel\Concerns\ToModel;

class EmpresaImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Empresa([
            'ruc'           => $row[0] ?? null,
            'razonsocial'   => $row[1] ?? null,
            'partner'         => $row[2] ?? null,
            'estado'   => $row[3] ?? null,
            'modalidad' => $row[4] ?? null
        ]);
    }
}

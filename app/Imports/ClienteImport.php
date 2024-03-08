<?php

namespace App\Imports;

use App\Models\Cliente;
use Maatwebsite\Excel\Concerns\ToModel;

class ClienteImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Cliente([
            'ruc'           => $row[0] ?? null,
            'razonsocial'   => $row[1] ?? null,
            'partner'         => $row[2] ?? null,
            'estado'   => $row[3] ?? null,
            'modalidad' => $row[4] ?? null
        ]);
    }
}

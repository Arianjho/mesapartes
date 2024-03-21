<?php

namespace App\Imports;

use App\Models\Faltante;
use Maatwebsite\Excel\Concerns\ToModel;

class FaltanteImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Faltante([
            'ruc' => $row[0],
            'razonsocial' => $row[1],
            'serie' => $row[5],
            'faltante' => $row[9]
        ]);
    }
}

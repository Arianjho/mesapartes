<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncidenciaOSI extends Model
{
    use HasFactory;

    protected $table = "incidenciaosi";
    protected $fillable = [
        'ruc',
        'fecha',
        'razonsocial',
        'documento',
        'tipodocumento',
        'serie',
        'correlativo',
        'valordigerido',
        'coderror',
        'descripcion',
        'detalle',
        'partner'
    ];
}

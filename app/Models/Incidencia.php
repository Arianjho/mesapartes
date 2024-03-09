<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incidencia extends Model
{
    use HasFactory;

    protected $table = 'incidencias';
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
        'fecharevisado',
        'detalle',
        'partner'
    ];
}

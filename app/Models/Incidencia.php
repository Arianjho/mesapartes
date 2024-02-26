<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incidencia extends Model
{
    use HasFactory;

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
        'descripcion'
    ];
}

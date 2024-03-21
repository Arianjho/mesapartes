<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faltante extends Model
{
    use HasFactory;
    protected $table = 'faltantes';
    protected $fillable = [
        'ruc',
        'razonsocial',
        'serie',
        'faltante',
        'estado',
        'detalle'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diccionario extends Model
{
    use HasFactory;

    protected $table = 'diccionario';
    protected $fillable = ['coderror', 'descripcion', 'detalle'];
}

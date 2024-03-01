<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuarios';
    protected $fillable = [
        'dni',
        'nombres',
        'apellidos',
        'correo',
        'celular',
        'password',
        'estado',
        'perfil_id'
    ];

    public function perfil()
    {
        return $this->belongsTo(Perfil::class);
    }
}

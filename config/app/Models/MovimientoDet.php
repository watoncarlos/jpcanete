<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovimientoDet extends Model
{
    use HasFactory;

    protected $table = 'movimientos_det';
    
    protected $fillable = [
        'id_movimiento',
        'id_activo',
        'cantidad',
        'valor',
        'total',
        // Agrega aquí otros campos si es necesario
    ];
}

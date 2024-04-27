<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    use HasFactory;

    protected $table = 'movimientos';

    public function detalles()
    {
        return $this->hasMany(MovimientoDet::class, 'id_movimiento');
    }
}

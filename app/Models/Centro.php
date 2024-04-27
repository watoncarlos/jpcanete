<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Centro extends Model
{
    use HasFactory;

    protected $table = 'centros';

    public function movimientos()
    {
        return $this->hasMany(Movimiento::class, 'centroId');
    }
}

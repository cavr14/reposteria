<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tamano extends Model
{
    use HasFactory;

    protected $table = 'tamano';  // Nombre de la tabla
    protected $primaryKey = 'ID_size';  // Clave primaria

    // Definir campos que se pueden asignar masivamente
    protected $fillable = [
        'nombreT',
        'precio_size',
    ];

    // Relación con la tabla DetallePedido
    public function detallePedidos()
    {
        return $this->hasMany(DetallePedido::class, 'ID_size');
    }
}

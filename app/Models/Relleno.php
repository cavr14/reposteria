<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relleno extends Model
{
    use HasFactory;

    protected $table = 'relleno';  // Nombre de la tabla
    protected $primaryKey = 'ID_relleno';  // Clave primaria

    // Definir campos que se pueden asignar masivamente
    protected $fillable = [
        'nombre_r',
        'precio_relleno',
    ];

    // Relación con la tabla DetallePedido
    public function detallePedidos()
    {
        return $this->hasMany(DetallePedido::class, 'ID_relleno');
    }
}

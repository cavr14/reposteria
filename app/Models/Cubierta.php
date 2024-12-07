<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cubierta extends Model
{
    use HasFactory;

    protected $table = 'cubierta';  // Nombre de la tabla
    protected $primaryKey = 'ID_cubierta';  // Clave primaria

    // Definir campos que se pueden asignar masivamente
    protected $fillable = [
        'nombre_c',
        'precio_cub',
    ];

    // Relación con la tabla DetallePedido
    public function detallePedidos()
    {
        return $this->hasMany(DetallePedido::class, 'ID_cubierta');
    }
}

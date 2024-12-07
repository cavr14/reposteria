<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topping extends Model
{
    use HasFactory;

    protected $table = 'topping';  // Nombre de la tabla
    protected $primaryKey = 'ID_top';  // Clave primaria

    // Definir campos que se pueden asignar masivamente
    protected $fillable = [
        'nombre_top',
        'precio_top',
    ];

    // Relación con la tabla DetallePedido
    public function detallePedidos()
    {
        return $this->hasMany(DetallePedido::class, 'ID_top');
    }
}

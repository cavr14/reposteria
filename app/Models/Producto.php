<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'producto';  // Nombre de la tabla
    protected $primaryKey = 'ID';   // Clave primaria

    // Definir campos que se pueden asignar masivamente
    protected $fillable = [
        'descripcion',
        'tipo_producto',
    ];

    // Relación con la tabla DetallePedido
    public function detallePedidos()
    {
        return $this->hasMany(DetallePedido::class, 'ID_producto');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePedido extends Model
{
    use HasFactory;

    protected $table = 'detalle_pedido';  // Nombre de la tabla
    protected $primaryKey = 'ID_detalle';  // Clave primaria

    // Definir campos que se pueden asignar masivamente
    protected $fillable = [
        'ID_pedido',
        'ID_producto',
        'ID_sabor',
        'ID_size',
        'ID_top',
        'ID_cubierta',
        'ID_relleno',
        'cantidad',
        'precio',
    ];

    // Relación con la tabla Pedido
    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'ID_pedido', 'ID_pedido');
    }

    // Relación con la tabla Producto
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'ID_producto');
    }

    // Relación con la tabla Sabor
    public function sabor()
    {
        return $this->belongsTo(Sabor::class, 'ID_sabor');
    }

    // Relación con la tabla Size
    public function tamano()
    {
        return $this->belongsTo(Tamano::class, 'ID_size');
    }

    // Relación con la tabla Topping
    public function topping()
    {
        return $this->belongsTo(Topping::class, 'ID_top');
    }

    // Relación con la tabla Cubierta
    public function cubierta()
    {
        return $this->belongsTo(Cubierta::class, 'ID_cubierta');
    }

    // Relación con la tabla Relleno
    public function relleno()
    {
        return $this->belongsTo(Relleno::class, 'ID_relleno');
    }
}

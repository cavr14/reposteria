<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePedido extends Model
{
    use HasFactory;

    protected $table = 'detalle_pedido'; // Asegúrate de que coincida con el nombre de tu tabla.
    protected $fillable = [
        'ID_pedido',
        'ID_producto',
        'cantidad',
        'ID_size',
        'ID_sabor',
        'ID_top',
        'ID_relleno',
        'ID_cubierta',
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'ID_pedido', 'id');
    }


    // Relación con el modelo Producto
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'ID_producto');
    }

    // Relación con el modelo Tamano
    public function tamano()
    {
        return $this->belongsTo(Tamano::class, 'ID_size');
    }

    // Relación con el modelo Sabor
    public function sabor()
    {
        return $this->belongsTo(Sabor::class, 'ID_sabor');
    }

    // Relación con el modelo Cubierta
    public function cubierta()
    {
        return $this->belongsTo(Cubierta::class, 'ID_cubierta');
    }

    // Relación con el modelo Relleno
    public function relleno()
    {
        return $this->belongsTo(Relleno::class, 'ID_relleno');
    }

    // Relación con el modelo Topping
    public function topping()
    {
        return $this->belongsTo(Topping::class, 'ID_top');
    }
}

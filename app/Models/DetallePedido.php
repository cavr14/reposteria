<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePedido extends Model
{
    use HasFactory;

    protected $table = 'detalle_pedido';

    public $timestamps = false; // Deshabilitar timestamps

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
        return $this->belongsTo(Pedido::class, 'ID_pedido');
    }
}

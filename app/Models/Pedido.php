<?php
// app/Models/Pedido.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    // Si la tabla no sigue la convención plural de Laravel, puedes especificar el nombre de la tabla
    protected $table = 'pedido';
    protected $primaryKey = 'ID_pedido';

    public $timestamps = false; // Deshabilitar timestamps

    // Especificar los campos que son "fillables" (masivos asignables)
    protected $fillable = [
        'fecha_pedido',
        'fecha_entrega',
        'ID_usuario',
        'total',
        'ID_detalle',
    ];

    // Relación con el modelo DetallePedido
    public function detalles()
    {
        return $this->hasMany(DetallePedido::class, 'ID_pedido');
    }
}

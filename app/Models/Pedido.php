<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'pedido';  // Nombre de la tabla
    protected $primaryKey = 'ID_pedido';  // Clave primaria

    // Definir campos que se pueden asignar masivamente
    protected $fillable = [
        'fecha_pedido',
        'fecha_entrega',
        'ID_cliente',
        'total',
    ];

    // Relación con la tabla Cliente
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    

    // Relación con la tabla DetallePedido
    public function detalles()
    {
        return $this->hasMany(DetallePedido::class, 'ID_pedido', 'ID_pedido');
    }
}

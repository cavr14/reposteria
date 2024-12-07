<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'pedido';

    protected $fillable = [
        'ID_usuario',
        'fecha_entrega',
    ];

    public function detalles()
    {
        return $this->hasMany(DetallePedido::class, 'ID_pedido');
    }

}

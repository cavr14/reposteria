<?php
// app/Models/Pedido.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'pedido';  // Nombre de la tabla
    protected $primaryKey = 'ID_pedido';

    protected $fillable = [
        'id',
        'fecha_entrega',
    ];

    // Relación con la tabla Cliente
    public function cliente()
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }
    // Relación con la tabla DetallePedido
    public function detalles()
    {
        return $this->hasMany(DetallePedido::class, 'ID_pedido');
    }
    public function detallePedidos()
    {
        return $this->hasMany(DetallePedido::class, 'ID_pedido', 'id');
    }
    
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id');
    }

}


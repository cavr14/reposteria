<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'cliente';  // Nombre de la tabla
    protected $primaryKey = 'ID_cliente';   // Clave primaria

    // Definir campos que se pueden asignar masivamente
    protected $fillable = [
        'nombre',
        'telefono',
        'direccion',
    ];

    // Relación con la tabla Pedido
    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'ID_cliente');
    }
}

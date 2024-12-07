<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sabor extends Model
{
    use HasFactory;

    protected $table = 'sabor';  // Nombre de la tabla
    protected $primaryKey = 'ID_Sabor';  // Clave primaria

    // Definir campos que se pueden asignar masivamente
    protected $fillable = [
        'nombre_s',
    ];

    // Relación con la tabla DetallePedido
    public function detallePedidos()
    {
        return $this->hasMany(DetallePedido::class, 'ID_sabor');
    }
}

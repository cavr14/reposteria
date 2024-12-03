<?php

// app/Models/Pedido.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    // Si la tabla no sigue la convención plural de Laravel, puedes especificar el nombre de la tabla:
    // protected $table = 'nombre_de_tu_tabla';

    // Si deseas especificar los campos que son "fillables" (masivos asignables)
    protected $fillable = ['cliente_id', 'telefono', 'producto', 'sabor', 'tamano_cantidad', 'relleno', 'status'];
}

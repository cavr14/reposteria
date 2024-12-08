<?php

namespace Database\Factories;

use App\Models\Pedido;
use Illuminate\Database\Eloquent\Factories\Factory;

class PedidoFactory extends Factory
{
    protected $model = Pedido::class;

    public function definition()
    {
        return [
            'fecha_pedido' => $this->faker->dateTimeBetween('now'),
            'fecha_entrega' => $this->faker->dateTimeBetween('now', '+1 month'),
            'ID_usuario' => $this->faker->randomNumber(2), // Suponiendo que tienes usuarios
            'total' => $this->faker->randomFloat(2, 50, 5000),
            'ID_detalle' => null, // Si este campo no debe ser null, ajusta la lógica
        ];
    }
}

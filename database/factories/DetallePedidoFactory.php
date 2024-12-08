<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Pedido;
use App\Models\Producto;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DetallePedido>
 */
class DetallePedidoFactory extends Factory
{
    protected $model = DetallePedido::class;

    public function definition()
    {
        return [
            'ID_pedido' => Pedido::factory(),
            'ID_producto' => Producto::factory(),
            'cantidad' => $this->faker->numberBetween(1, 2),
            'ID_size' => $this->faker->numberBetween(1, 2), // Ajusta según tu lógica
            'ID_sabor' => $this->faker->numberBetween(1, 2),
            'ID_top' => $this->faker->numberBetween(1, 2),
            'ID_relleno' => $this->faker->numberBetween(1, 2),
            'ID_cubierta' => $this->faker->numberBetween(1, 2),
        ];
    }
}

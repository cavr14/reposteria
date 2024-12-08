<?php

namespace Database\Factories;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductoFactory extends Factory
{
    protected $model = Producto::class;

    public function definition()
    {
        return [
            'descripcion' => $this->faker->words(3, true),
            'tipo_producto' => $this->faker->randomElement(['pastel', 'galleta', 'pan']),
        ];
    }
}

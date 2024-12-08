<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // Contraseña predeterminada
            'telefono' => $this->faker->phoneNumber(),
            'domicilio' => $this->faker->address(),
            'is_admin' => false, // Por defecto, no administrador
            'remember_token' => Str::random(10),
        ];
    }
}

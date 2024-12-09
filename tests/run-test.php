<?php
require __DIR__ . '/vendor/autoload.php';

use App\Models\User;
use App\Models\Pedido;

// Crear usuarios de prueba
User::factory()->create([
    'name' => 'Admin User',
    'email' => 'admin@example.com',
]);

// Crear pedidos de prueba
Pedido::factory()->create([
    'status' => 'pendiente',
]);

echo "Pruebas de base de datos completadas.\n";

<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Producto;
use App\Models\Pedido;
use App\Models\DetallePedido;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;




class PedidoControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Prueba que un pedido se guarda correctamente en la base de datos.
     *
     * @return void
     */
    public function test_store_crea_un_pedido_correctamente()
    {
        // Crear un usuario
        $user = User::factory()->create();

        // Crear productos para el pedido
        $producto = Producto::factory()->create();

        // Datos del pedido
        $data = [
            'ID_usuario' => $user->ID_usuario,
            'fecha_entrega' => '2024-12-15',
            'productos' => [
                [
                    'ID_producto' => $producto->ID_producto,
                    'cantidad' => 2,
                    'ID_size' => 1,  // Suponiendo que hay un tamaño con ID 1
                    'ID_sabor' => 1,  // Suponiendo que hay un sabor con ID 1
                    'ID_top' => 1,
                    'ID_relleno' => 1,
                    'ID_cubierta' => 1,
                ]
            ]
        ];

        // Enviar una solicitud POST para almacenar el pedido
        $response = $this->post(route('client.orders.store'), $data);

        // Verificar que la respuesta sea correcta
        $response->assertRedirect(route('client.orders.index'));
        $response->assertSessionHas('success', 'Pedido creado exitosamente');

        // Verificar que el pedido fue almacenado en la base de datos
        $this->assertDatabaseHas('pedido', [
            'ID_usuario' => $user->ID_usuario,
            'fecha_entrega' => '2024-12-15',
        ]);

        // Verificar que los detalles del pedido fueron almacenados
        $this->assertDatabaseHas('detalle_pedido', [
            'ID_pedido' => Pedido::latest()->first()->ID_pedido,
            'ID_producto' => $producto->ID_producto,
            'cantidad' => 2,
            'ID_size' => 1,
            'ID_sabor' => 1,
        ]);
    }
}
